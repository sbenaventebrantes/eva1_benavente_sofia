#!/bin/bash
set -e

# Esperar a que MySQL esté disponible
echo "Esperando a que MySQL esté listo..."
while ! nc -z db 3306 2>/dev/null; do
  sleep 1
done
echo "MySQL está listo!"

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php /var/www/html/artisan migrate --force || true

# Iniciar Apache
echo "Iniciando Apache..."
apache2-foreground