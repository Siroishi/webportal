################################################################################
# 1)   BUILD-СТАДИЯ: собираем вендоры Composer с нужными PHP-расширениями
################################################################################
FROM composer:2.7 AS vendor

# ─ Install intl, которого нет в образе composer по умолчанию
RUN apt-get update \
 && apt-get install -y --no-install-recommends libicu-dev git \
 && docker-php-ext-install intl \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# ─ Только composer.* → меньше кэша при rebuild
COPY composer.json composer.lock ./

# ─ Ставим прод-зависимости без dev-пакетов и без запуска post-скриптов
RUN composer install \
      --no-dev --prefer-dist \
      --no-interaction --no-scripts

################################################################################
# 2)   RUNTIME-СТАДИЯ: PHP-FPM + Nginx + Supervisor + ваше приложение
################################################################################
FROM php:8.3-fpm-alpine

# ─ Базовые пакеты + nginx & supervisor
RUN apk add --no-cache \
        nginx supervisor bash curl \
        icu libpng libjpeg-turbo freetype libzip oniguruma

# ─ Build-зависимости для сборки ext-ов
RUN apk add --no-cache --virtual .build-deps \
        icu-dev libpng-dev jpeg-dev freetype-dev libzip-dev oniguruma-dev \
        g++ make autoconf

# ─ PHP-расширения, которые чаще всего нужны Laravel
RUN docker-php-ext-install \
        intl pdo pdo_mysql bcmath gd zip opcache \
 && apk del .build-deps                                   # чистим мусор

# ─ Ставим Composer внутрь рантайм-образа (иногда нужен для artisan)
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

################################################################################
# 3)   КОД ПРИЛОЖЕНИЯ + ОПТИМИЗАЦИЯ
################################################################################
WORKDIR /var/www/html

# ─ Vendor-папка приходит из build-стадии → экономим время на install
COPY --from=vendor /app/vendor ./vendor
# ─ Остальной проект
COPY . .

# ─ Laravel оптимизация (можно убрать, если нужно только в CI)
RUN php artisan storage:link           \
 && php artisan config:cache           \
 && php artisan route:cache            \
 && php artisan view:cache

################################################################################
# 4)   КОНФИГИ NGINX / SUPERVISOR И СТАРТ
################################################################################
COPY deploy/nginx.conf       /etc/nginx/nginx.conf
COPY deploy/supervisord.conf /etc/supervisord.conf
COPY deploy/start.sh         /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

EXPOSE 80
CMD ["/usr/local/bin/start"]
