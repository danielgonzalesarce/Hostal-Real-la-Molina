# 🔒 FASE 6: Seguridad y Optimización

## 🎯 Objetivo
Aplicar medidas de seguridad avanzadas, optimizar el rendimiento y configurar monitoreo básico del sistema.

---

## 📋 Tareas de esta Fase

### 6.1 Hardening del Servidor

#### 6.1.1 Actualizaciones Automáticas

```bash
# Instalar unattended-upgrades
sudo apt install -y unattended-upgrades

# Configurar
sudo dpkg-reconfigure -plow unattended-upgrades

# Verificar
sudo systemctl status unattended-upgrades
```

#### 6.1.2 Configurar Fail2ban

```bash
# Instalar Fail2ban
sudo apt install -y fail2ban

# Crear configuración local
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local

# Editar configuración
sudo nano /etc/fail2ban/jail.local
```

Configurar:

```ini
[DEFAULT]
bantime = 3600
findtime = 600
maxretry = 5

[sshd]
enabled = true
port = 22
```

```bash
# Reiniciar Fail2ban
sudo systemctl restart fail2ban
sudo systemctl enable fail2ban

# Verificar
sudo fail2ban-client status
```

#### 6.1.3 Deshabilitar Root Login por SSH

```bash
# Editar configuración SSH
sudo nano /etc/ssh/sshd_config
```

Cambiar:

```
PermitRootLogin no
PasswordAuthentication no  # Si usas SSH keys
```

```bash
# Reiniciar SSH
sudo systemctl restart sshd
```

**⚠️ IMPORTANTE:** Asegurarse de tener acceso con usuario no-root antes de hacer esto.

---

### 6.2 Optimización de PHP

#### 6.2.1 Configurar OPcache

```bash
# Editar configuración de OPcache
sudo nano /etc/php/8.2/fpm/php.ini
```

Buscar y configurar:

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

```bash
# Reiniciar PHP-FPM
sudo systemctl restart php8.2-fpm
```

#### 6.2.2 Optimizar PHP-FPM

```bash
# Editar pool de PHP-FPM
sudo nano /etc/php/8.2/fpm/pool.d/www.conf
```

Ajustar según recursos del servidor:

```ini
pm = dynamic
pm.max_children = 50
pm.start_servers = 10
pm.min_spare_servers = 5
pm.max_spare_servers = 20
pm.max_requests = 500
```

```bash
# Reiniciar PHP-FPM
sudo systemctl restart php8.2-fpm
```

---

### 6.3 Optimización de MySQL

#### 6.3.1 Configurar MySQL

```bash
# Editar configuración
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf
```

Agregar/Modificar:

```ini
[mysqld]
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
max_connections = 200
query_cache_type = 1
query_cache_size = 64M
tmp_table_size = 64M
max_heap_table_size = 64M
```

```bash
# Reiniciar MySQL
sudo systemctl restart mysql
```

---

### 6.4 Optimización de Nginx

#### 6.4.1 Configurar Nginx para Rendimiento

```bash
# Editar configuración principal
sudo nano /etc/nginx/nginx.conf
```

Agregar dentro de `http {`:

```nginx
# Optimizaciones
client_max_body_size 20M;
client_body_buffer_size 128k;

# Gzip
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/json;

# Cache de archivos estáticos
open_file_cache max=10000 inactive=30s;
open_file_cache_valid 60s;
open_file_cache_min_uses 2;
open_file_cache_errors on;
```

```bash
# Verificar y recargar
sudo nginx -t
sudo systemctl reload nginx
```

---

### 6.5 Configuración de Monitoreo

#### 6.5.1 Uptime Robot (Gratis)

1. Ir a: https://uptimerobot.com/
2. Crear cuenta
3. Agregar monitor:
   - **Type:** HTTP(s)
   - **URL:** https://hostalreallamolina.com
   - **Interval:** 5 minutes
4. Configurar alertas por email

#### 6.5.2 Logs del Sistema

```bash
# Ver logs de Nginx
sudo tail -f /var/log/nginx/access.log
sudo tail -f /var/log/nginx/error.log

# Ver logs de PHP-FPM
sudo tail -f /var/log/php8.2-fpm.log

# Ver logs de Laravel
tail -f /var/www/hostal-real-la-molina/storage/logs/laravel.log
```

#### 6.5.3 Monitoreo de Recursos

```bash
# Instalar herramientas de monitoreo
sudo apt install -y htop iotop

# Ver uso de recursos
htop
```

---

### 6.6 Configuración de Rate Limiting

#### 6.6.1 Rate Limiting en Nginx

Editar configuración del sitio:

```bash
sudo nano /etc/nginx/sites-available/hostal-real-la-molina
```

Agregar dentro de `server {`:

```nginx
# Rate limiting
limit_req_zone $binary_remote_addr zone=api_limit:10m rate=10r/s;
limit_req_zone $binary_remote_addr zone=login_limit:10m rate=5r/m;

# Aplicar a rutas específicas
location /api/ {
    limit_req zone=api_limit burst=20 nodelay;
    try_files $uri $uri/ /index.php?$query_string;
}

location /login {
    limit_req zone=login_limit burst=3 nodelay;
    try_files $uri $uri/ /index.php?$query_string;
}
```

```bash
# Recargar Nginx
sudo nginx -t
sudo systemctl reload nginx
```

---

### 6.7 Configuración de Headers de Seguridad

Editar configuración de Nginx:

```bash
sudo nano /etc/nginx/sites-available/hostal-real-la-molina
```

Agregar headers de seguridad:

```nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
```

```bash
# Recargar Nginx
sudo systemctl reload nginx
```

---

### 6.8 Optimización de Laravel

#### 6.8.1 Configurar Queue (Opcional)

Si necesitas procesar tareas en background:

```bash
# Instalar Supervisor
sudo apt install -y supervisor

# Crear configuración
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```

Contenido:

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/hostal-real-la-molina/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/hostal-real-la-molina/storage/logs/worker.log
```

```bash
# Reiniciar Supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

---

## ✅ Checklist de Fase 6

- [ ] Actualizaciones automáticas configuradas
- [ ] Fail2ban instalado y configurado
- [ ] Root login SSH deshabilitado
- [ ] OPcache configurado
- [ ] PHP-FPM optimizado
- [ ] MySQL optimizado
- [ ] Nginx optimizado (gzip, cache)
- [ ] Monitoreo básico configurado
- [ ] Rate limiting configurado
- [ ] Headers de seguridad configurados
- [ ] Logs configurados y verificados

---

## 🧪 Pruebas de Rendimiento

### Prueba de Carga Básica

```bash
# Instalar Apache Bench
sudo apt install -y apache2-utils

# Prueba de carga
ab -n 1000 -c 10 https://hostalreallamolina.com/
```

### Verificar Optimizaciones

- [ ] Tiempo de carga < 3 segundos
- [ ] Gzip funcionando (verificar en DevTools)
- [ ] Cache funcionando
- [ ] SSL funcionando correctamente

---

## 🚀 Próximo Paso

Una vez completada esta fase, procederemos a:
- **FASE 7: Verificación y Entrega**
  - Pruebas funcionales completas
  - Documentación final
  - Entrega al cliente

---

**Estado:** ⏳ Listo para ejecutar después de FASE 5

