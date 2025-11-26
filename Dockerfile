# Use PHP 8.3
FROM php:8.3-cli

# Install system dependencies (including Postgres drivers)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpq-dev

# Install PHP extensions for Laravel & Postgres
RUN docker-php-ext-install pdo pdo_pgsql zip

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy your files to the server
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 10000 (Render's default)
EXPOSE 10000

# Start the server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
