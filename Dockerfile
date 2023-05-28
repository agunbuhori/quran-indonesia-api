FROM php:8.2-fpm

# Install necessary extensions and dependencies
RUN apt-get update && apt-get install -y \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

# Copy application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Set working directory
WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader