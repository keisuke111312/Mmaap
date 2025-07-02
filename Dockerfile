FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install PHP dependencies (remove --no-dev temporarily to allow debug routes)
RUN composer install --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 🧹 Clear and recache config only — skip route caching to allow hot reload
RUN php artisan config:clear \
 && php artisan view:clear \
 && php artisan config:cache

# Expose port
EXPOSE 8000

# Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
