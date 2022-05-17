FROM php:8.1-fpm-alpine

# Arguments defined in docker-compose.yml
ARG user=laravel
ARG uid=1000

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Create group and user
RUN addgroup -g $uid $user && \
    adduser -u $uid -G $user -h /home/$user -D $user

# Set working directory and user
WORKDIR /var/www
USER $user
