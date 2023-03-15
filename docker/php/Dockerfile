####################
#PHP FPM target
####################
FROM php:8.1-fpm-alpine as base

WORKDIR /var/www

RUN apk update && apk add build-base

#configure timezone
RUN apk --no-cache add tzdata
RUN cp /usr/share/zoneinfo/Europe/Athens /etc/localtime
RUN echo "Europe/Athens" > /etc/timezone

#install usermod
RUN apk --no-cache add shadow && usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/cache
RUN chown -R www-data:www-data /var/log

RUN apk update && apk add build-base

RUN apk add --no-cache \
    postgresql \
    postgresql-dev \
    libzip-dev \
    zlib-dev \
    git \
    zip \
    g++ \
    gettext \
    gettext-dev \
    icu-dev\
    libjpeg-turbo-dev \
    jpeg-dev \
    libpng-dev \
    ffmpeg \
    perl-image-exiftool \
    imagemagick \
    optipng \
    jpegoptim \
&& docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    gettext \
    intl \
    opcache \
    zip \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gettext \
&& docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
&& docker-php-ext-enable opcache

COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

####################
#Composer target
####################
FROM base as composer
