FROM php:8.1-fpm

ARG USER_NAME="marketplace"
ARG TIMEZONE="Europe/Madrid"

RUN apt update \
    && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Add user
RUN useradd ${USER_NAME}
RUN mkdir /home/${USER_NAME}
RUN chown ${USER_NAME} /home/${USER_NAME}
USER ${USER_NAME}

WORKDIR /var/www/marketplace

ADD . /var/www/marketplace

USER root
RUN mkdir -p /var/www/marketplace/var
RUN chown -R ${USER_NAME}:${USER_NAME} /var/www/marketplace

USER ${USER_NAME}