################################################################################
# 1) BUILD-СТАДІЯ ─ Composer + ext-intl (Alpine)
################################################################################
FROM composer:2.7 AS vendor

# ─ intl та git в Alpine
RUN apk add --no-cache icu-dev git \
 && docker-php-ext-install intl

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

################################################################################
# 2) RUNTIME ─ PHP-FPM 8.3 + Nginx + Supervisor
################################################################################
FROM php:8.3-fpm-alpine

# ─ системні пакети
RUN apk add --no-cache \
        nginx supervisor bash curl \
        icu libpng libjpeg-turbo freetype libzip oniguruma

# ─ build-deps для PHP-ext
RUN apk add --no-cache --virtual .build-deps \
        icu-dev libpng-dev jpeg-dev freetype-dev libzip-dev oniguruma-dev \
        g++ make autoconf

# ─ потрібні розширення PHP
RUN docker-php-ext-install \
        intl pdo pdo_mysql bcmath gd zip opcache \
 && apk del .build-deps

# ─ Composer усередині рантайм-образу (іноді потрібен для artisan)
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

################################################################################
# 3) КОД + ОПТИМІЗАЦІЯ LARAVEL
################################################################################
WORKDIR /var/www/html
COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN php artisan storage:link           \
 && php artisan config:cache           \
 && php artisan route:cache            \
 && php artisan view:cache

################################################################################
# 4) Nginx / Supervisor / старт
################################################################################
COPY deploy/nginx.conf       /etc/nginx/nginx.conf
COPY deploy/supervisord.conf /etc/supervisord.conf
COPY deploy/start.sh         /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

EXPOSE 80
CMD ["/usr/local/bin/start"]
