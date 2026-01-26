# ⚙️ FASE 3: Configuración del Servidor

## 🎯 Objetivo
Configurar completamente el servidor Ubuntu con Nginx, PHP 8.2+, MySQL 8.0+ y todas las herramientas necesarias para producción.

---

## 📋 Tareas de esta Fase

### 3.1 Actualización Inicial del Sistema

Conectarse al servidor por SSH:

```bash
ssh root@TU_IP_DEL_VPS
```

Actualizar el sistema:

```bash
# Actualizar lista de paquetes
apt update

# Actualizar sistema
apt upgrade -y

# Instalar herramientas básicas
apt install -y curl wget git unzip software-properties-common
```

---

### 3.2 Configuración de Firewall (UFW)

```bash
# Instalar UFW
apt install -y ufw

# Configurar reglas básicas
ufw default deny incoming
ufw default allow outgoing

# Permitir SSH (IMPORTANTE: hacer esto primero)
ufw allow 22/tcp

# Permitir HTTP y HTTPS
ufw allow 80/tcp
ufw allow 443/tcp

# Activar firewall
ufw enable

# Verificar estado
ufw status
```

**⚠️ IMPORTANTE:** Asegurarse de permitir SSH antes de activar el firewall.

---

### 3.3 Instalación de Nginx

```bash
# Instalar Nginx
apt install -y nginx

# Iniciar y habilitar en el arranque
systemctl start nginx
systemctl enable nginx

# Verificar estado
systemctl status nginx

# Verificar que funciona
curl http://localhost
```

**Verificar:** Abrir en navegador `http://TU_IP_DEL_VPS` - Debe mostrar página de bienvenida de Nginx.

---

### 3.4 Instalación de PHP 8.2+

```bash
# Agregar repositorio de PHP
add-apt-repository ppa:ondrej/php -y
apt update

# Instalar PHP 8.2 y extensiones necesarias
apt install -y php8.2-fpm php8.2-cli php8.2-common php8.2-mysql \
    php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml \
    php8.2-bcmath php8.2-intl php8.2-readline php8.2-opcache

# Verificar instalación
php -v

# Verificar extensiones
php -m | grep -E "mysql|pdo|mbstring|xml|curl|gd|zip"
```

---

### 3.5 Configuración de PHP-FPM

```bash
# Editar configuración de PHP-FPM
nano /etc/php/8.2/fpm/php.ini
```

Cambiar estas líneas:

```ini
upload_max_filesize = 20M
post_max_size = 20M
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
```

Guardar (Ctrl+O, Enter, Ctrl+X)

```bash
# Reiniciar PHP-FPM
systemctl restart php8.2-fpm
systemctl enable php8.2-fpm
```

---

### 3.6 Instalación de MySQL 8.0+

```bash
# Instalar MySQL Server
apt install -y mysql-server

# Iniciar y habilitar MySQL
systemctl start mysql
systemctl enable mysql

# Verificar estado
systemctl status mysql

# Configuración de seguridad inicial
mysql_secure_installation
```

Durante `mysql_secure_installation`:
- Establecer contraseña para root
- Remover usuarios anónimos: **Y**
- Deshabilitar login remoto de root: **Y**
- Remover base de datos de prueba: **Y**
- Recargar privilegios: **Y**

---

### 3.7 Configuración de Base de Datos

```bash
# Conectarse a MySQL
mysql -u root -p
```

Ejecutar estos comandos SQL:

```sql
-- Crear base de datos
CREATE DATABASE hostal_real_la_molina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crear usuario para la aplicación
CREATE USER 'hostal_user'@'localhost' IDENTIFIED BY 'CONTRASEÑA_SEGURA_AQUI';

-- Otorgar privilegios
GRANT ALL PRIVILEGES ON hostal_real_la_molina.* TO 'hostal_user'@'localhost';

-- Aplicar cambios
FLUSH PRIVILEGES;

-- Verificar
SHOW DATABASES;
SELECT user, host FROM mysql.user;

-- Salir
EXIT;
```

**⚠️ IMPORTANTE:** Reemplazar `CONTRASEÑA_SEGURA_AQUI` con una contraseña fuerte.

---

### 3.8 Instalación de Composer

```bash
# Descargar instalador de Composer
cd /tmp
curl -sS https://getcomposer.org/installer | php

# Mover a ubicación global
mv composer.phar /usr/local/bin/composer

# Dar permisos de ejecución
chmod +x /usr/local/bin/composer

# Verificar
composer --version
```

---

### 3.9 Crear Usuario para Deploy

```bash
# Crear usuario
adduser deploy

# Agregar a grupo www-data
usermod -aG www-data deploy

# Agregar a grupo sudo
usermod -aG sudo deploy

# Configurar permisos para /var/www
chown -R www-data:www-data /var/www
chmod -R 755 /var/www

# Cambiar a usuario deploy
su - deploy
```

---

### 3.10 Configuración de SSH Keys (Opcional pero Recomendado)

En tu máquina local (Windows):

```powershell
# Generar clave SSH (si no tienes)
ssh-keygen -t rsa -b 4096 -C "tu_email@ejemplo.com"

# Copiar clave pública al servidor
type $env:USERPROFILE\.ssh\id_rsa.pub | ssh root@TU_IP_DEL_VPS "cat >> ~/.ssh/authorized_keys"
```

En el servidor:

```bash
# Configurar permisos correctos
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
```

---

## ✅ Checklist de Fase 3

- [ ] Sistema actualizado
- [ ] Firewall configurado y activo
- [ ] Nginx instalado y funcionando
- [ ] PHP 8.2+ instalado con todas las extensiones
- [ ] PHP-FPM configurado y funcionando
- [ ] MySQL 8.0+ instalado y configurado
- [ ] Base de datos creada
- [ ] Usuario de base de datos creado
- [ ] Composer instalado
- [ ] Usuario deploy creado
- [ ] Permisos de /var/www configurados
- [ ] SSH keys configuradas (opcional)

---

## 🧪 Verificaciones

### Verificar Nginx
```bash
curl http://localhost
systemctl status nginx
```

### Verificar PHP
```bash
php -v
php -m
```

### Verificar MySQL
```bash
systemctl status mysql
mysql -u root -p -e "SHOW DATABASES;"
```

### Verificar Composer
```bash
composer --version
```

---

## 🚀 Próximo Paso

Una vez completada esta fase, procederemos a:
- **FASE 4: Desarrollo y Preparación**
  - Optimizaciones para producción
  - Configuración de variables de entorno
  - Preparación de assets

---

**Estado:** ⏳ Listo para ejecutar cuando se complete FASE 2

