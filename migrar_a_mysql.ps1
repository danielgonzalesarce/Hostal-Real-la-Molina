# Script de PowerShell para migrar de SQLite a MySQL
# Ejecutar: .\migrar_a_mysql.ps1

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Migración de SQLite a MySQL" -ForegroundColor Cyan
Write-Host "  Hostal Real La Molina" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Verificar que existe el archivo .env
if (-not (Test-Path ".env")) {
    Write-Host "ERROR: No se encontró el archivo .env" -ForegroundColor Red
    Write-Host "Por favor, crea el archivo .env basándote en .env.example" -ForegroundColor Yellow
    exit 1
}

Write-Host "Paso 1: Verificando extensión MySQL en PHP..." -ForegroundColor Yellow
$mysqlCheck = php -m | Select-String -Pattern "pdo_mysql|mysqli"
if ($mysqlCheck) {
    Write-Host "✓ Extensiones MySQL encontradas" -ForegroundColor Green
} else {
    Write-Host "✗ Extensiones MySQL NO encontradas" -ForegroundColor Red
    Write-Host "Por favor, habilita pdo_mysql y mysqli en php.ini" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "Paso 2: Configuración de MySQL" -ForegroundColor Yellow
Write-Host "Por favor, ingresa los siguientes datos:" -ForegroundColor White
$dbHost = Read-Host "Host (Enter para 127.0.0.1)"
if ([string]::IsNullOrWhiteSpace($dbHost)) { $dbHost = "127.0.0.1" }

$dbPort = Read-Host "Puerto (Enter para 3306)"
if ([string]::IsNullOrWhiteSpace($dbPort)) { $dbPort = "3306" }

$dbName = Read-Host "Nombre de la base de datos (Enter para hostal_real_la_molina)"
if ([string]::IsNullOrWhiteSpace($dbName)) { $dbName = "hostal_real_la_molina" }

$dbUser = Read-Host "Usuario MySQL (Enter para root)"
if ([string]::IsNullOrWhiteSpace($dbUser)) { $dbUser = "root" }

$dbPass = Read-Host "Contraseña MySQL" -AsSecureString
$dbPassPlain = [Runtime.InteropServices.Marshal]::PtrToStringAuto([Runtime.InteropServices.Marshal]::SecureStringToBSTR($dbPass))

Write-Host ""
Write-Host "Paso 3: Creando base de datos..." -ForegroundColor Yellow

# Crear script SQL temporal
$sqlScript = @"
CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
"@

$sqlScript | Out-File -FilePath "temp_create_db.sql" -Encoding UTF8

# Intentar crear la base de datos
$mysqlCmd = "mysql -u $dbUser -p$dbPassPlain -e `"CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`""
try {
    $result = Invoke-Expression $mysqlCmd 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Base de datos creada exitosamente" -ForegroundColor Green
    } else {
        Write-Host "⚠ No se pudo crear automáticamente. Por favor, créala manualmente:" -ForegroundColor Yellow
        Write-Host "  mysql -u $dbUser -p" -ForegroundColor White
        Write-Host "  CREATE DATABASE $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" -ForegroundColor White
        Write-Host ""
        $continue = Read-Host "¿Ya creaste la base de datos? (s/n)"
        if ($continue -ne "s" -and $continue -ne "S") {
            Write-Host "Operación cancelada" -ForegroundColor Red
            exit 1
        }
    }
} catch {
    Write-Host "⚠ No se pudo crear automáticamente. Por favor, créala manualmente usando MySQL Workbench" -ForegroundColor Yellow
    Write-Host "  O ejecuta: mysql -u $dbUser -p" -ForegroundColor White
    Write-Host ""
    $continue = Read-Host "¿Ya creaste la base de datos? (s/n)"
    if ($continue -ne "s" -and $continue -ne "S") {
        Write-Host "Operación cancelada" -ForegroundColor Red
        exit 1
    }
}

# Limpiar archivo temporal
Remove-Item "temp_create_db.sql" -ErrorAction SilentlyContinue

Write-Host ""
Write-Host "Paso 4: Actualizando archivo .env..." -ForegroundColor Yellow

# Leer el archivo .env
$envContent = Get-Content ".env" -Raw

# Reemplazar configuración de base de datos
$envContent = $envContent -replace "DB_CONNECTION=.*", "DB_CONNECTION=mysql"
$envContent = $envContent -replace "DB_HOST=.*", "DB_HOST=$dbHost"
$envContent = $envContent -replace "DB_PORT=.*", "DB_PORT=$dbPort"
$envContent = $envContent -replace "DB_DATABASE=.*", "DB_DATABASE=$dbName"
$envContent = $envContent -replace "DB_USERNAME=.*", "DB_USERNAME=$dbUser"
$envContent = $envContent -replace "DB_PASSWORD=.*", "DB_PASSWORD=$dbPassPlain"

# Guardar el archivo .env
$envContent | Set-Content ".env" -Encoding UTF8

Write-Host "✓ Archivo .env actualizado" -ForegroundColor Green

Write-Host ""
Write-Host "Paso 5: Limpiando cache..." -ForegroundColor Yellow
php artisan config:clear
php artisan cache:clear
Write-Host "✓ Cache limpiado" -ForegroundColor Green

Write-Host ""
Write-Host "Paso 6: Verificando conexión..." -ForegroundColor Yellow
php artisan db:show 2>&1 | Out-Null
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Conexión exitosa" -ForegroundColor Green
} else {
    Write-Host "⚠ No se pudo verificar automáticamente. Verifica manualmente:" -ForegroundColor Yellow
    Write-Host "  php artisan db:show" -ForegroundColor White
}

Write-Host ""
Write-Host "Paso 7: Ejecutando migraciones..." -ForegroundColor Yellow
Write-Host "¿Deseas ejecutar las migraciones ahora? (s/n)" -ForegroundColor White
$runMigrations = Read-Host
if ($runMigrations -eq "s" -or $runMigrations -eq "S") {
    php artisan migrate
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Migraciones ejecutadas exitosamente" -ForegroundColor Green
    } else {
        Write-Host "✗ Error al ejecutar migraciones" -ForegroundColor Red
    }
} else {
    Write-Host "⚠ Migraciones no ejecutadas. Ejecuta manualmente:" -ForegroundColor Yellow
    Write-Host "  php artisan migrate" -ForegroundColor White
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Migración completada" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Próximos pasos:" -ForegroundColor Yellow
Write-Host "1. Verifica que todo funciona: php artisan serve" -ForegroundColor White
Write-Host "2. Si tenías datos en SQLite, consulta GUIA_MIGRACION_MYSQL.md" -ForegroundColor White
Write-Host "3. Para optimizar: php artisan config:cache" -ForegroundColor White
Write-Host ""

