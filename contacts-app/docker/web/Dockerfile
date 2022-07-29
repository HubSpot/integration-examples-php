FROM php:8.1.8-apache

ENV APACHE_DOCUMENT_ROOT=/app/src/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git zip unzip

RUN mkdir -p /app
ADD composer.lock /app
ADD composer.json /app

WORKDIR /app
RUN /usr/local/bin/composer install
