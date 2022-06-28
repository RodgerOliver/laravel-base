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

# Install composer
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

# Create group and user
RUN addgroup -g $uid $user && \
    adduser -u $uid -G $user -h /home/$user -D $user

# Set working directory and user
WORKDIR /var/www
USER $user
