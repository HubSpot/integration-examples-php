FROM php:7.4-apache

ENV APACHE_DOCUMENT_ROOT=/app/src/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git unzip zip

RUN mkdir -p /app
ADD composer.json /app

WORKDIR /app
RUN /usr/local/bin/composer install

RUN apt-get install -y supervisor
COPY docker/supervisor/processes.conf /etc/supervisor/conf.d/apache.conf
CMD ["/usr/bin/supervisord"]
