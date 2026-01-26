# Script de Deploy para Producción (PowerShell)
# Hostal Real La Molina

Write-Host "🚀 Iniciando deploy de producción..." -ForegroundColor Cyan

# Verificar que estamos en el directorio correcto
if (-not (Test-Path "artisan")) {
    Write-Host "❌ Error: No se encontró el archivo artisan. Asegúrate de estar en el directorio raíz del proyecto." -ForegroundColor Red
    exit 1
}

# Activar modo mantenimiento
Write-Host "📦 Activando modo mantenimiento..." -ForegroundColor Yellow
php artisan down

# Obtener últimos cambios (si usas Git)
if (Test-Path ".git") {
    Write-Host "📥 Obteniendo últimos cambios de Git..." -ForegroundColor Yellow
    git pull origin main
    if ($LASTEXITCODE -ne 0) {
        git pull origin master
    }
}

# Instalar/actualizar dependencias de Composer
Write-Host "📦 Instalando dependencias de Composer..." -ForegroundColor Yellow
composer install --optimize-autoloader --no-dev --no-interaction

# Instalar/actualizar dependencias de NPM
Write-Host "📦 Instalando dependencias de NPM..." -ForegroundColor Yellow
npm ci --production
if ($LASTEXITCODE -ne 0) {
    npm install --production
}

# Compilar assets para producción
Write-Host "🏗️  Compilando assets para producción..." -ForegroundColor Yellow
npm run build

# Ejecutar migraciones
Write-Host "🗄️  Ejecutando migraciones..." -ForegroundColor Yellow
php artisan migrate --force

# Limpiar cache
Write-Host "🧹 Limpiando cache..." -ForegroundColor Yellow
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimizar para producción
Write-Host "⚡ Optimizando para producción..." -ForegroundColor Yellow
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimizar autoloader de Composer
Write-Host "📦 Optimizando autoloader..." -ForegroundColor Yellow
composer dump-autoload --optimize --classmap-authoritative

# Crear enlace simbólico de storage si no existe
if (-not (Test-Path "public\storage")) {
    Write-Host "🔗 Creando enlace simbólico de storage..." -ForegroundColor Yellow
    php artisan storage:link
}

# Desactivar modo mantenimiento
Write-Host "✅ Desactivando modo mantenimiento..." -ForegroundColor Yellow
php artisan up

Write-Host "✅ Deploy completado exitosamente!" -ForegroundColor Green
Write-Host "🌐 El sitio está disponible en producción" -ForegroundColor Green

