FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql intl opcache zip

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /var/www/html