FROM php:8.2.12-apache
# Mod Rewrite
RUN a2enmod rewrite
# Install system dependencies and PHP extensions
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev
# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install nodejs npm -y

# PHP Extension
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
USER root
# Copy the tinygram project files to the container
COPY . .
EXPOSE 6001
