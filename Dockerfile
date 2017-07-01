FROM php:5.6.30-apache
COPY www/ /var/www/html/
RUN apt-get update && apt-get install -y \
        apt-utils \
        libpq-dev \
        php5-pgsql \
    && docker-php-ext-install pgsql
