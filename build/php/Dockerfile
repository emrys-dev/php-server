FROM php:7.2-fpm-alpine3.6

LABEL maintainer Rodrigo Ribeiro "labdocodigo"

RUN apk update

# bash
RUN apk add --update --no-cache bash

# dependencies
ENV PHPIZE_DEPS \
    build-base \
    autoconf \
    libtool \
    pcre-dev \
    cmake \
    file \
    pkgconf \
    re2c \
    git \
    wget

RUN apk add --update --no-cache $PHPIZE_DEPS

# intl, zip, soap
RUN apk add --update --no-cache libintl icu icu-dev libxml2-dev \
    && docker-php-ext-install intl zip soap

# mysqli, pdo, pdo_mysql, pdo_pgsql
RUN apk add --update --no-cache postgresql-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql

# gd, iconv, libltdl
RUN apk add --update --no-cache \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libltdl \
    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" gd

# gmp
RUN apk add --update --no-cache gmp gmp-dev \
    && docker-php-ext-install gmp

# php-redis
ENV PHPREDIS_VERSION="3.1.4"

RUN docker-php-source extract \
    && curl -L -o /tmp/redis.tar.gz "https://github.com/phpredis/phpredis/archive/${PHPREDIS_VERSION}.tar.gz" \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && docker-php-source delete

# imagick
RUN apk add --update --no-cache imagemagick-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# ssh2
RUN apk add --update --no-cache libssh2 libssh2-dev \
    && pecl install ssh2-1 \
    && docker-php-ext-enable ssh2

# opcache
RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

# bcmath, mbstring
RUN docker-php-ext-install bcmath mbstring

# xdebug
RUN pecl install xdebug-2.6.0RC2 \
    && docker-php-ext-enable xdebug

# oauth
RUN pecl install oauth-2.0.2 \
    && docker-php-ext-enable oauth

# openldap
RUN apk add --update --no-cache openldap-dev \
    && docker-php-ext-configure ldap --with-libdir=lib/ \
    && docker-php-ext-install ldap

# log file
RUN touch /var/log/php-fpm.log \
    && chmod 777 /var/log/php-fpm.log

# app folder
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

# port
EXPOSE 9000

# remove dependencies
RUN apk del $PHPIZE_DEPS

# clear cache
RUN rm -rf /tmp/* /var/cache/apk/*

# start
CMD ["php-fpm"]