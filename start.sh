#!/bin/bash
set -e

# Generate key only if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Clear and cache config
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}