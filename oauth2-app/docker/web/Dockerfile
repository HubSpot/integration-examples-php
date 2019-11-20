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

RUN mkdir -p /usr/share/man/man1
RUN apt install -y default-jdk

RUN wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add -
RUN echo "deb [arch=amd64]  http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list
RUN apt-get -y update
RUN apt-get -y install google-chrome-stable
RUN wget https://chromedriver.storage.googleapis.com/2.41/chromedriver_linux64.zip
RUN unzip chromedriver_linux64.zip
RUN mv chromedriver /usr/bin/chromedriver
RUN chown root:root /usr/bin/chromedriver
RUN chmod +x /usr/bin/chromedriver
RUN chown root:root /usr/bin/chromedriver
RUN rm chromedriver_linux64.zip

RUN wget https://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.4.0.jar
RUN mv selenium-server-standalone-3.4.0.jar selenium-server-standalone.jar

COPY docker/web/processes.conf /etc/supervisor/conf.d/processes.conf
CMD ["/usr/bin/supervisord"]
