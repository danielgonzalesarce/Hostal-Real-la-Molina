# 🏨 Hostal Real La Molina

Sistema completo de gestión de reservas y administración para hostal desarrollado con **Laravel 12**.

## 📋 Tabla de Contenidos

- [Requisitos Previos](#-requisitos-previos)
- [Instalación Rápida](#-instalación-rápida)
- [Configuración](#-configuración)
- [Ejecutar el Proyecto](#-ejecutar-el-proyecto)
- [Acceso al Sistema](#-acceso-al-sistema)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Características](#-características)
- [Documentación Adicional](#-documentación-adicional)

## 🔧 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP 8.2** o superior
- **Composer** (gestor de dependencias PHP)
- **Node.js 18+** y **npm**
- **MySQL 8.0+** o **SQLite**
- **Git**

### Verificar Instalación

```bash
php --version      # Debe ser 8.2 o superior
composer --version
node --version    # Debe ser 18 o superior
npm --version
mysql --version   # Opcional si usas MySQL
```

## 🚀 Instalación Rápida

### Paso 1: Clonar el Repositorio

```bash
git clone <url-del-repositorio>
cd hostal-real-la-molina
```

### Paso 2: Instalar Dependencias

**Dependencias PHP (Composer):**
```bash
composer install
```

**Dependencias Node.js (npm):**
```bash
npm install
```

### Paso 3: Configurar Variables de Entorno

**Copiar archivo de ejemplo:**
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

**Editar el archivo `.env`** y configurar:

```env
APP_NAME="Hostal Real La Molina"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

# Base de Datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Puerto para administración (importante)
ADMIN_PORT=8001
```

### Paso 4: Generar Clave de Aplicación

```bash
php artisan key:generate
```

### Paso 5: Crear Base de Datos

**Opción A: MySQL**
```sql
CREATE DATABASE hostal_real CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Opción B: SQLite** (solo para desarrollo)
```env
# En .env cambiar:
DB_CONNECTION=sqlite
# Y eliminar DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### Paso 6: Ejecutar Migraciones y Seeders

```bash
# Ejecutar migraciones
php artisan migrate

# Cargar datos iniciales (opcional pero recomendado)
php artisan db:seed
```

Esto creará:
- Tablas de la base de datos
- Usuario administrador por defecto
- Datos de ejemplo (habitaciones, imágenes)

### Paso 7: Crear Enlace Simbólico de Storage

```bash
php artisan storage:link
```

Este comando crea un enlace simbólico para que las imágenes subidas sean accesibles públicamente.

### Paso 8: Compilar Assets Frontend

```bash
# Compilar para producción
npm run build

# O para desarrollo con hot-reload
npm run dev
```

## ▶️ Ejecutar el Proyecto

### Opción 1: Scripts Automáticos (Windows) ⭐ Recomendado

El proyecto incluye scripts `.bat` para facilitar el inicio:

**Iniciar ambos servidores (público + admin):**
```bash
start-both.bat
```
Esto abrirá 2 ventanas:
- Servidor público en puerto **8000**
- Servidor admin en puerto **8001**

**Solo servidor público:**
```bash
start-public.bat
```

**Solo servidor admin:**
```bash
start-admin.bat
```

### Opción 2: Comandos Manuales

**Terminal 1 - Servidor Público:**
```bash
php artisan serve --port=8000
```

**Terminal 2 - Servidor Admin:**
```bash
php artisan serve --port=8001
```

### Verificar que Funciona

1. Abre tu navegador en: `http://127.0.0.1:8000`
2. Deberías ver la página principal del hostal
3. Para admin: `http://127.0.0.1:8001/admin/login`

## 🔐 Acceso al Sistema

### Panel Administrativo

- **URL:** `http://127.0.0.1:8001/admin/login`
- **Email:** `admin@hostalreal.com`
- **Contraseña:** `HostalReal2024!`

> ⚠️ **IMPORTANTE:** El panel de administración **solo es accesible desde el puerto 8001** por seguridad. Si intentas acceder desde el puerto 8000, recibirás un error 404.

### Sitio Público

- **URL:** `http://127.0.0.1:8000`
- Acceso libre para usuarios y reservas

### Crear Nuevo Usuario Administrador

Si necesitas crear otro administrador:

```bash
php artisan tinker
```

Luego en tinker:
```php
$user = new App\Models\User();
$user->name = 'Tu Nombre';
$user->email = 'tu@email.com';
$user->password = bcrypt('tu_contraseña');
$user->role = 'admin';
$user->save();
exit
```

## 📁 Estructura del Proyecto

```
hostal-real-la-molina/
├── app/                    # Lógica de la aplicación
│   ├── Console/            # Comandos Artisan
│   ├── Http/
│   │   ├── Controllers/    # Controladores
│   │   │   ├── Admin/      # Controladores del panel admin
│   │   │   └── Auth/       # Autenticación
│   │   └── Middleware/     # Middleware personalizado
│   ├── Models/             # Modelos Eloquent
│   └── Providers/          # Service Providers
├── bootstrap/              # Archivos de arranque
├── config/                 # Archivos de configuración
├── database/
│   ├── migrations/         # Migraciones de BD
│   └── seeders/            # Seeders de datos
├── public/                 # Punto de entrada público
│   ├── storage/            # Enlace simbólico a storage
│   └── build/              # Assets compilados
├── resources/
│   ├── views/              # Vistas Blade
│   │   ├── admin/          # Vistas del panel admin
│   │   └── layouts/        # Layouts base
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── routes/
│   └── web.php             # Rutas web
├── storage/                # Archivos de almacenamiento
│   └── app/
│       └── public/         # Imágenes subidas
└── tests/                  # Tests automatizados
```

## ✨ Características Principales

- ✅ **Sistema de Reservas** - Reservas en línea con verificación de disponibilidad
- ✅ **Gestión de Habitaciones** - CRUD completo con múltiples imágenes por habitación
- ✅ **Panel Administrativo** - Interfaz completa para gestión del hostal
- ✅ **Control de Estado** - Visualización en tiempo real del estado de habitaciones
- ✅ **Sistema de Reseñas** - Reseñas de huéspedes con moderación
- ✅ **Libro de Reclamaciones** - Gestión de quejas y reclamos
- ✅ **Galería de Imágenes** - Galería pública de instalaciones
- ✅ **Autenticación Separada** - Sesiones independientes para admin y usuarios
- ✅ **Seguridad Avanzada** - Middleware de protección, validación, CSRF

## 🛠️ Comandos Útiles

### Limpiar Caché
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Recompilar Assets
```bash
npm run build
```

### Ver Rutas
```bash
php artisan route:list
```

### Acceder a Tinker (Consola Interactiva)
```bash
php artisan tinker
```

### Ejecutar Tests
```bash
php artisan test
```

## 📚 Documentación Adicional

- **[Comandos Windows](COMANDOS_WINDOWS.md)** - Guía completa de comandos para Windows PowerShell
- **[Acceso Admin](ACCESO_ADMIN.md)** - Información detallada del panel administrativo
- **[Crear Habitaciones](CREAR_HABITACIONES.md)** - Guía paso a paso para crear habitaciones
- **[Gestión de Imágenes](GESTION_IMAGENES_HABITACIONES.md)** - Cómo gestionar imágenes de habitaciones
- **[Puertos Separados](PUERTOS_SEPARADOS.md)** - Explicación del sistema de puertos
- **[Sesiones Separadas](SESIONES_SEPARADAS.md)** - Sistema de autenticación separada
- **[Solución de Imágenes](SOLUCION_IMAGENES.md)** - Solución de problemas comunes con imágenes

## 🔒 Seguridad

El proyecto implementa múltiples capas de seguridad:

- 🔐 Autenticación separada para administradores
- 🛡️ Middleware de protección de rutas
- ✅ Validación exhaustiva de datos
- 🚫 Protección CSRF en todos los formularios
- 🧹 Sanitización de inputs
- 🔒 Puertos separados para admin y público

## 🐛 Solución de Problemas

### Error: "Class 'env' does not exist"
```bash
php artisan config:clear
php artisan cache:clear
```

### Error: "Storage link already exists"
El enlace ya existe, está bien. Si quieres recrearlo:
```bash
# Windows
rmdir public\storage
php artisan storage:link

# Linux/Mac
rm public/storage
php artisan storage:link
```

### Error: "Port 8000/8001 already in use"
Cierra otros servidores Laravel o cambia el puerto:
```bash
php artisan serve --port=8002
```

### Las imágenes no se muestran
```bash
php artisan storage:link
php artisan view:clear
```

## 📝 Notas Importantes

- ⚠️ **Puerto 8001 es obligatorio** para acceder al panel admin
- ⚠️ **No subas el archivo `.env`** al repositorio (ya está en `.gitignore`)
- ⚠️ **Cambia las credenciales** del admin en producción
- ⚠️ **Usa `npm run build`** antes de subir a producción

## 🤝 Contribuir

Este es un proyecto privado para Hostal Real La Molina. Para contribuir:

1. Crea una rama desde `main`
2. Realiza tus cambios
3. Prueba exhaustivamente
4. Crea un Pull Request

## 📄 Licencia

Este proyecto es **privado** y de uso exclusivo para **Hostal Real La Molina**.

---

**Desarrollado con ❤️ usando Laravel 12**
