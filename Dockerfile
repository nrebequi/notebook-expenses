FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Copy env file and configure for SQLite
COPY .env.example .env
RUN sed -i 's/APP_DEBUG=false/APP_DEBUG=true/' .env && \
    sed -i 's/APP_ENV=production/APP_ENV=local/' .env && \
    sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env && \
    sed -i 's#DB_DATABASE=.*#DB_DATABASE=/app/database/database.sqlite#' .env && \
    sed -i 's/CACHE_DRIVER=file/CACHE_DRIVER=file/' .env && \
    sed -i 's/SESSION_DRIVER=file/SESSION_DRIVER=file/' .env

# Create SQLite database
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod 666 database/database.sqlite

# Configure PHP for development/debugging
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
    echo "display_errors = On" >> "$PHP_INI_DIR/php.ini" && \
    echo "display_startup_errors = On" >> "$PHP_INI_DIR/php.ini" && \
    echo "error_reporting = E_ALL" >> "$PHP_INI_DIR/php.ini" && \
    echo "log_errors = On" >> "$PHP_INI_DIR/php.ini"

# Set permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage \
    && chmod -R 775 /app/bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Create necessary directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && touch storage/logs/laravel.log

# Clear all caches first
RUN php artisan key:generate && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]