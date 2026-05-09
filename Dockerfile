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

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Crear directorios de cache y storage con permisos correctos
RUN mkdir -p /var/www/html/bootstrap/cache
RUN mkdir -p /var/www/html/storage/logs
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage

# Instalar netcat para verificar si MySQL está listo
RUN apt-get install -y netcat-openbsd

# Copiar script de entrada
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Configurar punto de entrada
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

EXPOSE 80

