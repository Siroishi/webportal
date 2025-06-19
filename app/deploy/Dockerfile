# ─── build stage ────────────────────────────────────────────────────────────────
FROM composer:2.7 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# ─── runtime stage ──────────────────────────────────────────────────────────────
FROM php:8.3-fpm-alpine

# 1. Пакеты и нужные расширения PHP
RUN apk add --no-cache nginx supervisor bash curl git \
    && docker-php-ext-install pdo pdo_mysql bcmath intl opcache

# 2. Копируем приложение и зависимости
WORKDIR /var/www/html
COPY --from=vendor /app/vendor ./vendor
COPY . .

# 3. Оптимизация Laravel
RUN php artisan storage:link \
 && php artisan config:cache  \
 && php artisan route:cache   \
 && php artisan view:cache

# 4. Конфиги процессов
COPY deploy/nginx.conf        /etc/nginx/nginx.conf
COPY deploy/supervisord.conf  /etc/supervisord.conf
COPY deploy/start.sh          /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

EXPOSE 80
CMD ["/usr/local/bin/start"]
