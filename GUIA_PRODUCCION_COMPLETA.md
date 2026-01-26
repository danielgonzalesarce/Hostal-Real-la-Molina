# 🚀 Guía Completa de Producción - Hostal Real La Molina

## ✅ Estado del Proyecto

El proyecto está **listo para producción** con todas las optimizaciones y configuraciones necesarias.

---

## 📋 Archivos Creados para Producción

### Configuración
- ✅ `env.production.example` - Plantilla de variables de entorno
- ✅ `nginx.conf.example` - Configuración de Nginx
- ✅ `php-production.ini.example` - Configuraciones PHP recomendadas

### Scripts de Deploy
- ✅ `deploy.sh` - Script automatizado para Linux/Mac
- ✅ `deploy.ps1` - Script automatizado para Windows

### Documentación
- ✅ `GUIA_PRODUCCION_COMPLETA.md` - Esta guía
- ✅ `PRODUCCION_CHECKLIST.md` - Checklist final
- ✅ `PREPARACION_PRODUCCION.md` - Guía de preparación

---

## 🔧 Configuración del Servidor

### 1. Requisitos del Servidor

#### Software Necesario
- **PHP**: 8.2 o superior
- **Composer**: Última versión
- **Node.js**: 18.x o superior
- **NPM**: Última versión
- **MySQL**: 8.0 o superior
- **Nginx**: Última versión (o Apache)
- **SSL**: Certificado válido (Let's Encrypt recomendado)

#### Extensiones PHP Requeridas
```bash
php -m | grep -E "(pdo_mysql|mbstring|xml|curl|zip|gd|opcache)"
```

Extensiones necesarias:
- `pdo_mysql`
- `mbstring`
- `xml`
- `curl`
- `zip`
- `gd` o `imagick`
- `opcache` (muy importante para producción)

---

## 📝 Pasos de Instalación en el Servidor

### Paso 1: Preparar el Entorno

```bash
# Crear directorio del proyecto
sudo mkdir -p /var/www/hostal-real-la-molina
sudo chown -R $USER:www-data /var/www/hostal-real-la-molina
cd /var/www/hostal-real-la-molina
```

### Paso 2: Clonar o Subir el Proyecto

```bash
# Si usas Git
git clone https://tu-repositorio.git .

# O subir archivos vía FTP/SFTP
```

### Paso 3: Configurar Variables de Entorno

```bash
# Copiar plantilla
cp env.production.example .env

# Editar archivo
nano .env
```

**Configuraciones importantes:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://hostalreallamolina.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=hostal_user
DB_PASSWORD=TU_CONTRASEÑA_SEGURA

SESSION_SECURE_COOKIE=true
LOG_CHANNEL=daily
LOG_LEVEL=error
```

### Paso 4: Generar APP_KEY

```bash
php artisan key:generate
```

### Paso 5: Instalar Dependencias

```bash
# Composer (sin dependencias de desarrollo)
composer install --optimize-autoloader --no-dev --no-interaction

# NPM (solo producción)
npm ci --production
```

### Paso 6: Compilar Assets

```bash
npm run build
```

### Paso 7: Configurar Base de Datos

```bash
# Crear base de datos MySQL
mysql -u root -p
```

```sql
CREATE DATABASE hostal_real_la_molina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'hostal_user'@'localhost' IDENTIFIED BY 'TU_CONTRASEÑA_SEGURA';
GRANT ALL PRIVILEGES ON hostal_real_la_molina.* TO 'hostal_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Paso 8: Ejecutar Migraciones

```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder
```

### Paso 9: Configurar Permisos

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan storage:link
```

### Paso 10: Optimizar Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 🌐 Configuración de Nginx

### 1. Copiar Configuración

```bash
sudo cp nginx.conf.example /etc/nginx/sites-available/hostal-real-la-molina
sudo ln -s /etc/nginx/sites-available/hostal-real-la-molina /etc/nginx/sites-enabled/
```

### 2. Ajustar Configuración

Editar `/etc/nginx/sites-available/hostal-real-la-molina`:
- Cambiar `server_name` por tu dominio
- Ajustar rutas de certificados SSL
- Verificar ruta del proyecto (`root`)

### 3. Probar y Recargar

```bash
sudo nginx -t
sudo systemctl reload nginx
```

---

## 🔒 Configuración de SSL (Let's Encrypt)

```bash
# Instalar Certbot
sudo apt install certbot python3-certbot-nginx

# Obtener certificado
sudo certbot --nginx -d hostalreallamolina.com -d www.hostalreallamolina.com

# Renovación automática (ya viene configurado)
sudo certbot renew --dry-run
```

---

## ⚙️ Configuración de PHP-FPM

### 1. Aplicar Configuraciones de Producción

```bash
# Copiar configuraciones recomendadas
sudo cp php-production.ini.example /etc/php/8.2/fpm/conf.d/production.ini

# O editar php.ini directamente
sudo nano /etc/php/8.2/fpm/php.ini
```

### 2. Verificar OPcache

```bash
php -i | grep opcache
```

Asegúrate de que esté habilitado:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

### 3. Reiniciar PHP-FPM

```bash
sudo systemctl restart php8.2-fpm
```

---

## 🚀 Deploy Automatizado

### Usando Script de Deploy

```bash
# Dar permisos de ejecución
chmod +x deploy.sh

# Ejecutar deploy
./deploy.sh
```

El script automáticamente:
1. Activa modo mantenimiento
2. Obtiene últimos cambios (si usas Git)
3. Instala dependencias
4. Compila assets
5. Ejecuta migraciones
6. Limpia y optimiza cache
7. Establece permisos
8. Desactiva modo mantenimiento

---

## 🔍 Verificaciones Post-Deploy

### 1. Verificar que el Sitio Funciona

```bash
curl -I https://hostalreallamolina.com
```

Debe retornar `200 OK`.

### 2. Verificar Rutas

```bash
php artisan route:list
```

### 3. Verificar Logs

```bash
tail -f storage/logs/laravel.log
```

### 4. Verificar Permisos

```bash
ls -la storage bootstrap/cache
```

Deben tener permisos `755` y pertenecer a `www-data`.

---

## 🔐 Seguridad

### Checklist de Seguridad

- [x] `APP_DEBUG=false` en producción
- [x] `APP_ENV=production`
- [x] `SESSION_SECURE_COOKIE=true`
- [x] Headers de seguridad configurados (Nginx)
- [x] SSL/HTTPS habilitado
- [x] Permisos de archivos correctos
- [x] `.env` no está en Git
- [x] Credenciales en variables de entorno
- [x] OPcache habilitado
- [x] Logs configurados (daily, nivel error)

### Recomendaciones Adicionales

1. **Firewall**: Configurar UFW o iptables
2. **Fail2ban**: Proteger contra ataques de fuerza bruta
3. **Backups**: Configurar backups automáticos de base de datos
4. **Monitoreo**: Configurar herramientas de monitoreo (Sentry, etc.)
5. **Rate Limiting**: Ya está configurado en Laravel

---

## 📊 Monitoreo y Mantenimiento

### Logs Importantes

```bash
# Logs de Laravel
tail -f storage/logs/laravel.log

# Logs de Nginx
tail -f /var/log/nginx/hostal-real-la-molina-error.log

# Logs de PHP-FPM
tail -f /var/log/php8.2-fpm.log
```

### Comandos Útiles

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Re-optimizar después de cambios
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar estado de migraciones
php artisan migrate:status

# Verificar espacio en disco
df -h

# Verificar uso de memoria
free -h
```

### Backups

```bash
# Backup de base de datos (ejemplo con cron)
0 2 * * * mysqldump -u hostal_user -pTU_CONTRASEÑA hostal_real_la_molina > /backups/hostal_$(date +\%Y\%m\%d).sql
```

---

## 🐛 Solución de Problemas

### Error 500

1. Verificar logs: `tail -f storage/logs/laravel.log`
2. Verificar permisos: `ls -la storage bootstrap/cache`
3. Limpiar cache: `php artisan cache:clear`
4. Verificar `.env`: Asegúrate de que `APP_KEY` esté configurado

### Assets no cargan

1. Compilar assets: `npm run build`
2. Verificar enlace simbólico: `php artisan storage:link`
3. Verificar permisos de `public/build`

### Base de datos no conecta

1. Verificar credenciales en `.env`
2. Verificar que MySQL esté corriendo: `sudo systemctl status mysql`
3. Verificar que el usuario tenga permisos

### Sesiones no funcionan

1. Verificar que la tabla `sessions` exista: `php artisan migrate`
2. Verificar `SESSION_DRIVER` en `.env`
3. Verificar permisos de `storage/framework/sessions`

---

## ✅ Checklist Final

Antes de considerar el proyecto en producción:

- [ ] SSL/HTTPS configurado y funcionando
- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Assets compilados (`npm run build`)
- [ ] Migraciones ejecutadas
- [ ] Permisos correctos
- [ ] Cache optimizado
- [ ] Logs configurados
- [ ] Backups configurados
- [ ] Monitoreo configurado
- [ ] Sitio accesible vía HTTPS
- [ ] Panel admin funciona
- [ ] Sistema de reservas funciona
- [ ] No hay errores en logs

---

## 📞 Soporte

Si encuentras problemas:

1. Revisar logs de Laravel
2. Revisar logs de Nginx
3. Revisar logs de PHP-FPM
4. Verificar configuración de `.env`
5. Verificar permisos de archivos

---

**Última actualización:** 2026-01-25

