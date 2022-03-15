FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/marketplace

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN echo 'alias composer="XDEBUG_MODE=off composer"' >> ~/.bashrc

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email "s.lopezreyes255@gmail.com" \
    && git config --global user.name "slopez"