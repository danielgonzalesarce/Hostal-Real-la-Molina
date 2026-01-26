# 🚀 FASE 5: Despliegue a Producción

## 🎯 Objetivo
Desplegar el sistema completo en el servidor de producción, configurar Nginx, instalar SSL y poner el sistema en funcionamiento.

---

## 📋 Tareas de esta Fase

### 5.1 Subir Código al Servidor

#### Opción A: Usando Git (Recomendado)

**En el servidor:**

```bash
# Conectarse como usuario deploy
ssh deploy@TU_IP_DEL_VPS

# Ir a directorio web
cd /var/www

# Clonar repositorio (si usas Git)
git clone https://github.com/tu-usuario/hostal-real-la-molina.git
# O si es privado:
# git clone git@github.com:tu-usuario/hostal-real-la-molina.git

cd hostal-real-la-molina
```

**Si no usas Git, usar SCP o SFTP:**

**Desde tu máquina local (Windows PowerShell):**

```powershell
# Instalar WinSCP o usar SCP
scp -r C:\ruta\al\proyecto\* deploy@TU_IP_DEL_VPS:/var/www/hostal-real-la-molina/
```

#### Opción B: Usando SCP/SFTP

**Desde tu máquina local:**

```powershell
# Comprimir proyecto (excluyendo node_modules, vendor)
# Luego subir:
scp proyecto.zip deploy@TU_IP_DEL_VPS:/tmp/

# En el servidor:
cd /var/www
unzip /tmp/proyecto.zip -d hostal-real-la-molina
```

---

### 5.2 Configurar Variables de Entorno

**En el servidor:**

```bash
cd /var/www/hostal-real-la-molina

# Copiar .env.example a .env
cp .env.example .env

# O si preparaste .env.production:
# cp .env.production .env

# Editar .env
nano .env
```

Configurar valores importantes:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://hostalreallamolina.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=hostal_user
DB_PASSWORD=CONTRASEÑA_DE_BD

# Generar APP_KEY
php artisan key:generate
```

---

### 5.3 Instalar Dependencias

**En el servidor:**

```bash
cd /var/www/hostal-real-la-molina

# Instalar dependencias de Composer
composer install --optimize-autoloader --no-dev --no-interaction

# Instalar dependencias de NPM (si es necesario)
npm install

# Compilar assets
npm run build
```

---

### 5.4 Configurar Base de Datos

**En el servidor:**

```bash
# Ejecutar migraciones
php artisan migrate --force

# Si necesitas datos iniciales (opcional)
php artisan db:seed
```

---

### 5.5 Configurar Permisos

**En el servidor:**

```bash
cd /var/www/hostal-real-la-molina

# Establecer propietario
sudo chown -R www-data:www-data /var/www/hostal-real-la-molina

# Establecer permisos
sudo chmod -R 755 /var/www/hostal-real-la-molina
sudo chmod -R 775 storage bootstrap/cache
```

---

### 5.6 Configurar Nginx

**En el servidor:**

```bash
# Crear configuración de Nginx
sudo nano /etc/nginx/sites-available/hostal-real-la-molina
```

Contenido del archivo:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name hostalreallamolina.com www.hostalreallamolina.com;
    root /var/www/hostal-real-la-molina/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Habilitar sitio:**

```bash
# Crear enlace simbólico
sudo ln -s /etc/nginx/sites-available/hostal-real-la-molina /etc/nginx/sites-enabled/

# Eliminar configuración por defecto (opcional)
sudo rm /etc/nginx/sites-enabled/default

# Verificar configuración
sudo nginx -t

# Recargar Nginx
sudo systemctl reload nginx
```

---

### 5.7 Instalar SSL con Let's Encrypt

**En el servidor:**

```bash
# Instalar Certbot
sudo apt install -y certbot python3-certbot-nginx

# Obtener certificado SSL
sudo certbot --nginx -d hostalreallamolina.com -d www.hostalreallamolina.com

# Seguir las instrucciones:
# - Email: tu_email@ejemplo.com
# - Términos: Aceptar
# - Renovación automática: Sí
```

**Verificar renovación automática:**

```bash
# Probar renovación
sudo certbot renew --dry-run
```

---

### 5.8 Optimizar Laravel para Producción

**En el servidor:**

```bash
cd /var/www/hostal-real-la-molina

# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache

# Limpiar cache anterior
php artisan cache:clear
```

---

### 5.9 Verificar Funcionamiento

#### Verificar Nginx

```bash
sudo systemctl status nginx
curl http://localhost
```

#### Verificar PHP-FPM

```bash
sudo systemctl status php8.2-fpm
```

#### Verificar MySQL

```bash
sudo systemctl status mysql
```

#### Verificar SSL

```bash
# Verificar certificado
sudo certbot certificates
```

#### Probar en Navegador

1. Abrir: `https://hostalreallamolina.com`
2. Verificar que carga correctamente
3. Verificar que el candado SSL aparece

---

### 5.10 Configurar Backups Automáticos

**Crear script de backup:**

```bash
sudo nano /usr/local/bin/backup-hostal.sh
```

Contenido:

```bash
#!/bin/bash

# Configuración
BACKUP_DIR="/var/backups/hostal"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="hostal_real_la_molina"
DB_USER="hostal_user"
DB_PASS="CONTRASEÑA_BD"
APP_DIR="/var/www/hostal-real-la-molina"

# Crear directorio si no existe
mkdir -p $BACKUP_DIR

# Backup de base de datos
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup de archivos (storage, .env)
tar -czf $BACKUP_DIR/files_$DATE.tar.gz -C $APP_DIR storage .env

# Eliminar backups antiguos (más de 7 días)
find $BACKUP_DIR -type f -mtime +7 -delete

echo "Backup completado: $DATE"
```

**Dar permisos:**

```bash
sudo chmod +x /usr/local/bin/backup-hostal.sh
```

**Configurar cron (backup diario a las 2 AM):**

```bash
sudo crontab -e
```

Agregar línea:

```
0 2 * * * /usr/local/bin/backup-hostal.sh >> /var/log/backup-hostal.log 2>&1
```

---

## ✅ Checklist de Fase 5

- [ ] Código subido al servidor
- [ ] Variables de entorno configuradas
- [ ] Dependencias instaladas
- [ ] Base de datos configurada y migraciones ejecutadas
- [ ] Permisos configurados correctamente
- [ ] Nginx configurado y funcionando
- [ ] SSL instalado y funcionando
- [ ] Laravel optimizado (cache)
- [ ] Backups automáticos configurados
- [ ] Sitio accesible vía HTTPS
- [ ] Todas las funcionalidades probadas

---

## 🧪 Pruebas de Funcionalidad

### Pruebas Básicas

- [ ] Página principal carga
- [ ] Listado de habitaciones funciona
- [ ] Detalles de habitación funciona
- [ ] Sistema de reservas funciona
- [ ] Panel administrativo accesible
- [ ] Login de usuarios funciona
- [ ] Sistema de reseñas funciona

### Pruebas de Seguridad

- [ ] HTTPS funciona correctamente
- [ ] Redirección HTTP → HTTPS funciona
- [ ] No se muestran errores de debug
- [ ] Archivos sensibles no accesibles

---

## 🚀 Próximo Paso

Una vez completada esta fase, procederemos a:
- **FASE 6: Seguridad y Optimización**
  - Hardening del servidor
  - Optimización de rendimiento
  - Configuración de monitoreo

---

**Estado:** ⏳ Listo para ejecutar después de FASE 4

