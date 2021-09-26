FROM php:7.4-fpm

RUN apt-get update && apt-get install -y

COPY . /var/www
WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./composer.* /app/
RUN composer install --no-dev --prefer-dist --optimize-autoloader && \
    composer clear-cache

CMD php index.php
