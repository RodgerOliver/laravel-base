FROM php:8.1-fpm-alpine

# Arguments defined in docker-compose.yml
ARG user=laravel
ARG uid=1000

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

RUN apk add --update $PHPIZE_DEPS
RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install pcntl posix

RUN apk add --update bzip2-dev libzip-dev
RUN docker-php-ext-install bz2 zip

RUN apk add --update oniguruma-dev
RUN docker-php-ext-install mbstring

RUN apk add --update exiftool
RUN docker-php-ext-configure exif
RUN docker-php-ext-install exif
RUN docker-php-ext-enable exif

RUN apk add --update imagemagick-dev
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# Install composer
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

# Create group and user
RUN addgroup -g $uid $user && \
    adduser -u $uid -G $user -h /home/$user -D $user

# Set working directory and user
WORKDIR /var/www
USER $user
