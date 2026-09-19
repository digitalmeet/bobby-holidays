# Use official PHP image with Nginx
FROM php:8.4-fpm-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libgif-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    libpq-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --enable-gd \
    --with-webp

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd curl zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install imagick for advanced image processing (medialibrary)
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && rm -rf /var/lib/apt/lists/*

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies (without dev dependencies for production)
RUN composer install --no-dev --no-interaction --no-progress --classmap-authoritative

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage/logs \
    && chmod -R 775 /var/www/storage/framework/{cache,sessions,views}

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy Supervisor configuration
COPY docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Copy hardened PHP runtime configuration
COPY docker/php-fpm-custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint
RUN sed -i 's/\r$//' /usr/local/bin/app-entrypoint && chmod +x /usr/local/bin/app-entrypoint

HEALTHCHECK --interval=30s --timeout=5s --start-period=30s --retries=3 \
    CMD curl --fail --silent http://127.0.0.1/health || exit 1

# Expose port 80
EXPOSE 80

# Start Supervisor
ENTRYPOINT ["/usr/local/bin/app-entrypoint"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]
