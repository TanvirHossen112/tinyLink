FROM php:8.4-fpm

ARG user
ARG uid

# Install system dependencies and PHP build deps
RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
        dpkg \
        fontconfig \
        libfreetype6 \
        libjpeg62-turbo \
        libxrender1 \
        xfonts-75dpi \
        xfonts-base \
        mariadb-client \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
        g++ \
        zip \
        unzip \
    && docker-php-ext-install \
        zip \
        gd \
        pdo_mysql \
        intl \
        mbstring \
        exif \
        pcntl \
        bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www
RUN chown -R www-data:www-data /var/www

USER $user
