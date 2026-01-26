# 💻 FASE 4: Desarrollo y Preparación

## 🎯 Objetivo
Preparar el código del sistema para producción: optimizaciones, configuración de entorno y preparación de assets.

---

## 📋 Tareas de esta Fase

### 4.1 Revisión del Código Actual

#### Verificar Estructura del Proyecto

```bash
# En tu máquina local
cd hostal-real-la-molina

# Verificar estructura
ls -la
```

#### Verificar Archivos Críticos

- [ ] `.env.example` existe
- [ ] `composer.json` está actualizado
- [ ] `package.json` está actualizado
- [ ] Migraciones están completas
- [ ] No hay archivos de desarrollo en producción

---

### 4.2 Optimizaciones para Producción

#### 4.2.1 Configurar .env para Producción

Crear archivo `.env.production` basado en `.env.example`:

```env
APP_NAME="Hostal Real La Molina"
APP_ENV=production
APP_KEY=base64:TU_CLAVE_AQUI
APP_DEBUG=false
APP_URL=https://hostalreallamolina.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=hostal_user
DB_PASSWORD=CONTRASEÑA_SEGURA

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@hostalreallamolina.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**⚠️ IMPORTANTE:**
- `APP_DEBUG=false` (nunca true en producción)
- `APP_KEY` debe generarse con `php artisan key:generate`
- Usar credenciales de base de datos del servidor

---

#### 4.2.2 Optimizar Composer

```bash
# En tu máquina local
composer install --optimize-autoloader --no-dev
```

Esto:
- Optimiza el autoloader
- Elimina dependencias de desarrollo
- Reduce tamaño del proyecto

---

#### 4.2.3 Optimizar Assets

```bash
# Compilar assets para producción
npm run build

# Verificar que se crearon los assets
ls -la public/build/
```

---

#### 4.2.4 Limpiar Archivos No Necesarios

Crear archivo `.gitignore` si no existe o verificar que incluya:

```
/node_modules
/vendor
.env
.env.backup
.env.production
.phpunit.result.cache
/storage/*.key
/public/hot
/public/storage
/storage/*.php
/storage/logs/*
!/storage/logs/.gitkeep
```

---

### 4.3 Configuración de Cache

#### 4.3.1 Configurar Cache en Producción

En `.env.production`:

```env
CACHE_DRIVER=file
# O para mejor rendimiento:
# CACHE_DRIVER=redis
```

#### 4.3.2 Configurar Sesiones

```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

### 4.4 Configuración de Logs

#### 4.4.1 Configurar Nivel de Log

En `.env.production`:

```env
LOG_CHANNEL=stack
LOG_LEVEL=error
```

#### 4.4.2 Verificar Permisos de Storage

```bash
# En el servidor (después del deploy)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

### 4.5 Preparar Scripts de Deploy

#### 4.5.1 Script de Deploy (deploy.sh)

Crear archivo `deploy.sh` en la raíz del proyecto:

```bash
#!/bin/bash

echo "🚀 Iniciando deploy..."

# Ir al directorio del proyecto
cd /var/www/hostal-real-la-molina

# Activar modo mantenimiento
php artisan down

# Obtener últimos cambios
git pull origin main

# Instalar dependencias
composer install --optimize-autoloader --no-dev --no-interaction

# Ejecutar migraciones
php artisan migrate --force

# Limpiar y optimizar
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compilar assets (si es necesario)
npm run build

# Establecer permisos
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Desactivar modo mantenimiento
php artisan up

echo "✅ Deploy completado!"
```

Dar permisos de ejecución:

```bash
chmod +x deploy.sh
```

---

### 4.6 Verificar Optimizaciones

#### Checklist de Optimizaciones

- [ ] `.env.production` configurado
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` generado
- [ ] Composer optimizado (`--no-dev`)
- [ ] Assets compilados (`npm run build`)
- [ ] Archivos no necesarios excluidos
- [ ] Cache configurado
- [ ] Logs configurados
- [ ] Script de deploy creado

---

### 4.7 Preparar Base de Datos

#### Verificar Migraciones

```bash
# En tu máquina local
php artisan migrate:status
```

Todas las migraciones deben estar listas.

#### Preparar Seeders (Opcional)

Si necesitas datos iniciales:

```bash
php artisan db:seed
```

---

## ✅ Checklist de Fase 4

- [ ] Código revisado y optimizado
- [ ] `.env.production` configurado
- [ ] Composer optimizado (sin dev dependencies)
- [ ] Assets compilados para producción
- [ ] Archivos no necesarios excluidos
- [ ] Cache configurado
- [ ] Logs configurados
- [ ] Script de deploy preparado
- [ ] Migraciones verificadas
- [ ] Permisos de storage verificados

---

## 📦 Preparar para Deploy

### Archivos a Subir al Servidor

- ✅ Todo el código (excepto `node_modules`, `vendor` se instala en servidor)
- ✅ `.env.production` (renombrar a `.env` en servidor)
- ✅ `deploy.sh` (script de deploy)

### Archivos NO a Subir

- ❌ `node_modules/`
- ❌ `vendor/` (se instala en servidor)
- ❌ `.env` local
- ❌ Archivos de desarrollo

---

## 🚀 Próximo Paso

Una vez completada esta fase, procederemos a:
- **FASE 5: Despliegue a Producción**
  - Subir código al servidor
  - Configurar base de datos
  - Configurar Nginx
  - Instalar SSL

---

**Estado:** ⏳ Listo para ejecutar después de FASE 3

