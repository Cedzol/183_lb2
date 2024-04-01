FROM php:8.0-apache

RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl

# COPY ./php/php.ini /usr/local/etc/php/php.ini-development

COPY ./ssl/*.pem /etc/apache2/ssl/
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli
EXPOSE 80
EXPOSE 443
