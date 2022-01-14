FROM php:7.3-apache

ENV APACHE_DOCUMENT_ROOT=/app/src/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y git libzip-dev zip libicu-dev g++ wget gnupg2 supervisor

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN mkdir -p /app
ADD composer.lock /app
ADD composer.json /app

WORKDIR /app
RUN /usr/local/bin/composer install
