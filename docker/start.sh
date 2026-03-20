#!/bin/sh
set -e

echo "==> Caching config, routes and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding database (first deploy only)..."
php artisan db:seed --force 2>/dev/null || echo "Seeding skipped (already seeded)"

echo "==> Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
