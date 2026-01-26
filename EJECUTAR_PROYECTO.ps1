# Script de Ejecución para Hostal Real La Molina
# Ejecutar en PowerShell

Write-Host "🚀 Iniciando configuración del proyecto..." -ForegroundColor Cyan

# 1. Instalar dependencias de Composer
Write-Host "`n📦 Instalando dependencias de Composer..." -ForegroundColor Yellow
composer install

# 2. Instalar dependencias de npm
Write-Host "`n📦 Instalando dependencias de npm..." -ForegroundColor Yellow
npm install

# 3. Verificar archivo .env
if (-not (Test-Path .env)) {
    Write-Host "`n⚠️  Archivo .env no encontrado. Creando desde .env.example..." -ForegroundColor Yellow
    if (Test-Path .env.example) {
        Copy-Item .env.example .env
        Write-Host "✅ Archivo .env creado. Por favor, edítalo y configura tu base de datos." -ForegroundColor Green
    } else {
        Write-Host "❌ No se encontró .env.example. Crea el archivo .env manualmente." -ForegroundColor Red
    }
}

# 4. Generar key de aplicación
Write-Host "`n🔑 Generando key de aplicación..." -ForegroundColor Yellow
php artisan key:generate

# 5. Ejecutar migraciones
Write-Host "`n🗄️  Ejecutando migraciones..." -ForegroundColor Yellow
php artisan migrate

Write-Host "`n✅ Configuración completada!" -ForegroundColor Green
Write-Host "`n📝 Próximos pasos:" -ForegroundColor Cyan
Write-Host "   1. Abre una nueva terminal y ejecuta: npm run dev" -ForegroundColor White
Write-Host "   2. Abre otra terminal y ejecuta: php artisan serve" -ForegroundColor White
Write-Host "   3. Accede a: http://localhost:8000" -ForegroundColor White

