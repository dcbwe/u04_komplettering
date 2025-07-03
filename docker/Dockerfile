FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    mariadb-client \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# fallback, comment out if not needed
ARG UID=1000
ARG GID=1000

# create and match local user
RUN groupadd -g ${GID} laravel && \
    useradd -u ${UID} -g laravel -m laravel

# set priviliges
WORKDIR /var/www/html
RUN chown -R laravel:laravel /var/www/html

# change user
USER laravel

EXPOSE 9000
EXPOSE 5173
