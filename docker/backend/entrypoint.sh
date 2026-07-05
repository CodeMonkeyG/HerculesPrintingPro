#!/bin/sh
set -e

mkdir -p \
  /var/www/storage/framework/cache/data \
  /var/www/storage/framework/sessions \
  /var/www/storage/framework/views \
  /var/www/storage/logs \
  /var/www/bootstrap/cache

chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache || true
chmod -R ug+rwX /var/www/storage /var/www/bootstrap/cache || true

exec "$@"
