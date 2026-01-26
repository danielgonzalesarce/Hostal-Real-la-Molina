#!/bin/bash

# Script de Deploy para Producción
# Hostal Real La Molina

set -e  # Salir si hay algún error

echo "🚀 Iniciando deploy de producción..."

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Verificar que estamos en el directorio correcto
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Error: No se encontró el archivo artisan. Asegúrate de estar en el directorio raíz del proyecto.${NC}"
    exit 1
fi

# Activar modo mantenimiento
echo -e "${YELLOW}📦 Activando modo mantenimiento...${NC}"
php artisan down || true

# Obtener últimos cambios (si usas Git)
if [ -d ".git" ]; then
    echo -e "${YELLOW}📥 Obteniendo últimos cambios de Git...${NC}"
    git pull origin main || git pull origin master || echo "⚠️  No se pudo hacer pull de Git"
fi

# Instalar/actualizar dependencias de Composer
echo -e "${YELLOW}📦 Instalando dependencias de Composer...${NC}"
composer install --optimize-autoloader --no-dev --no-interaction

# Instalar/actualizar dependencias de NPM
echo -e "${YELLOW}📦 Instalando dependencias de NPM...${NC}"
npm ci --production || npm install --production

# Compilar assets para producción
echo -e "${YELLOW}🏗️  Compilando assets para producción...${NC}"
npm run build

# Ejecutar migraciones
echo -e "${YELLOW}🗄️  Ejecutando migraciones...${NC}"
php artisan migrate --force

# Limpiar cache
echo -e "${YELLOW}🧹 Limpiando cache...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimizar para producción
echo -e "${YELLOW}⚡ Optimizando para producción...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimizar autoloader de Composer
echo -e "${YELLOW}📦 Optimizando autoloader...${NC}"
composer dump-autoload --optimize --classmap-authoritative

# Establecer permisos
echo -e "${YELLOW}🔐 Estableciendo permisos...${NC}"
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || echo "⚠️  No se pudieron cambiar permisos (puede requerir sudo)"

# Verificar que el enlace simbólico de storage existe
if [ ! -L "public/storage" ]; then
    echo -e "${YELLOW}🔗 Creando enlace simbólico de storage...${NC}"
    php artisan storage:link
fi

# Limpiar cache de OPcache si está disponible
if command -v php &> /dev/null; then
    echo -e "${YELLOW}🧹 Limpiando OPcache...${NC}"
    php -r "if (function_exists('opcache_reset')) { opcache_reset(); }" || true
fi

# Crear enlace simbólico de storage si no existe
if [ ! -L "public/storage" ]; then
    echo -e "${YELLOW}🔗 Creando enlace simbólico de storage...${NC}"
    php artisan storage:link
fi

# Desactivar modo mantenimiento
echo -e "${YELLOW}✅ Desactivando modo mantenimiento...${NC}"
php artisan up

echo -e "${GREEN}✅ Deploy completado exitosamente!${NC}"
echo -e "${GREEN}🌐 El sitio está disponible en producción${NC}"

