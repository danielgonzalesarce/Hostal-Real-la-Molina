#!/bin/bash

# Script de despliegue para Hostal Real La Molina
# Ejecutar en el servidor de producción

echo "Iniciando despliegue..."

# Instalar dependencias de PHP
composer install --optimize-autoloader --no-dev

# Generar clave de aplicación si no existe
if [ -z "$APP_KEY" ]; then
    php artisan key:generate
fi

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
php artisan migrate --force

# Instalar dependencias de Node.js y construir activos
npm install
npm run build

# Limpiar cachés
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Establecer permisos
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "Despliegue completado exitosamente!"