# Use an official PHP runtime as a parent image
FROM php:8.1-fpm

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev zip git libxml2-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql && \
    docker-php-ext-enable gd

# Install Composer (the PHP dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application files into the container
COPY . .

# Install PHP dependencies (composer)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Expose the application on port 8080
EXPOSE 8080

# Command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]