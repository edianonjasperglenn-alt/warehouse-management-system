FROM php:8.2-apache

# Install system dependencies & PHP extensions required for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Enable Apache rewrite module for Laravel routing
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set storage and cache permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Point Apache document root to Laravel public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
CMD ["apache2-foreground"]
