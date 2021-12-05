FROM php:7.4-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

RUN apt-get update \
  && apt-get install -y libzip-dev unzip libicu-dev libonig-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install intl pdo_mysql zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
#CMD composer clear-cache
#CMD composer install


