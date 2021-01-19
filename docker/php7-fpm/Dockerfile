# See https://github.com/docker-library/php/blob/master/7.3/fpm/Dockerfile
FROM php:7.4-fpm
ARG TIMEZONE

ENV DEBIAN_FRONTEND noninteractive

RUN sed -i -e 's/http:\/\/archive/mirror:\/\/mirrors/' -e 's/\/ubuntu\//\/mirrors.txt/' /etc/apt/sources.list

RUN apt-get update -y --fix-missing

RUN apt-get install -y \
    openssl \
    git \
    unzip \
    libxml2-dev \
    zlib1g-dev \
    curl \
    gnupg \
    wget \
    libzip-dev \
    libxslt-dev \
    libpng-dev \
    libonig-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpq-dev \
    apt-transport-https --fix-missing

RUN usermod -u 1000 www-data

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql soap zip xsl opcache iconv gd pgsql

RUN pecl install apcu \
    && pecl install apcu_bc-1.0.3 \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini \
    && docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/php.ini
RUN echo 'max_execution_time  = 360' >> /usr/local/etc/php/php.ini
RUN echo 'upload_max_filesize = 20M' >> /usr/local/etc/php/php.ini

COPY conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/symfony