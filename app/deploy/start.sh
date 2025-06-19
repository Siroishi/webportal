#!/usr/bin/env bash
set -e

# Подтягиваем ENV, если надо: php artisan migrate --force

exec /usr/bin/supervisord -c /etc/supervisord.conf
