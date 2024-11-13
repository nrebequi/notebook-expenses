#!/bin/bash
set -e

# Generate key only if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Use PORT from environment or default to 8080
PORT="${PORT:-8080}"
echo "Starting on port $PORT..."

# Start the application
exec php artisan serve --host=0.0.0.0 --port=$PORT --no-reload