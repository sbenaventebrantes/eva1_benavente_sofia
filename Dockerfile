FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

RUN a2enmod rewrite
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

RUN cp /var/www/html/.docker/laravel-vhost.conf /etc/apache2/sites-available/000-default.conf && a2ensite 000-default.conf

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
