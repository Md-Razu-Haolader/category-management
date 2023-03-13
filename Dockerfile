FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY composer.lock composer.json ./

# RUN composer install
# Run Composer
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader --no-interaction

ENV APP_ENV=development

# COPY . /app
COPY . /var/www/html


RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80
