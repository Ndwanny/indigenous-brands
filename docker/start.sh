#!/bin/sh
set -e

# Render injects PORT; default to 10000 if not set
export PORT=${PORT:-10000}

echo "==> Substituting PORT=${PORT} into nginx config..."
envsubst '${PORT}' < /etc/nginx/nginx.conf > /tmp/nginx.conf
cp /tmp/nginx.conf /etc/nginx/nginx.conf

echo "==> Caching config, routes and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding database (first deploy only)..."
php artisan db:seed --force 2>/dev/null || echo "Seeding skipped"

echo "==> Starting services on port ${PORT}..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
