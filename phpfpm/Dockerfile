FROM php:8.1-fpm
RUN apt-get update \
    && apt-get install -y \
    git \
    unzip \
    libz-dev \
    aptitude \
    libpng-dev \
    mariadb-client \
    libmemcached-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd iconv pdo_mysql \
    && pecl install xdebug-3.2.0 \
    && pecl install memcached \
    && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www
# install vim-gnome
RUN aptitude install -y vim
