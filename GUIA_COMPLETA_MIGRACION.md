# 🚀 Guía Completa: Migración de SQLite a MySQL

## ⚠️ PROBLEMA ACTUAL
Estás viendo el error: **"Could not connect, server may not be running. Unable to connect to 127.0.0.1:3306"**

Esto significa que MySQL no está corriendo o la conexión está mal configurada.

---

## 📋 PASO 1: Verificar que MySQL está Instalado y Corriendo

### 1.1. Verificar el Servicio MySQL en Windows

1. Presiona `Windows + R`
2. Escribe: `services.msc` y presiona Enter
3. Busca el servicio **"MySQL"** o **"MySQL80"** en la lista
4. Verifica su estado:
   - ✅ **Si dice "En ejecución"** → MySQL está corriendo, ve al Paso 2
   - ❌ **Si dice "Detenido"** → Haz clic derecho → "Iniciar"
   - ❌ **Si NO existe el servicio** → MySQL no está instalado, ve al Paso 0

### 1.2. Si el servicio no existe (MySQL no instalado)

**Opción A: Instalar MySQL 8.0**
1. Descarga MySQL desde: https://dev.mysql.com/downloads/installer/
2. Elige "MySQL Installer for Windows"
3. Selecciona "Full" o "Developer Default"
4. Durante la instalación:
   - Configura contraseña para usuario `root`
   - Puerto: 3306 (por defecto)
   - Marca "Start MySQL Server at System Startup"
5. Completa la instalación

**Opción B: Si tienes XAMPP/WAMP**
- XAMPP: MySQL está en el panel de control de XAMPP
- WAMP: Haz clic en el icono → MySQL → Service → Start/Resume Service

---

## 🔧 PASO 2: Corregir la Conexión en MySQL Workbench

### 2.1. Crear/Editar Conexión Correcta

1. En MySQL Workbench, haz clic en el botón **"+"** junto a "MySQL Connections" (o edita "Conexion_Local")

2. Configura la conexión:
   - **Connection Name:** `Local MySQL` (o el nombre que prefieras)
   - **Hostname:** `127.0.0.1` o `localhost`
   - **Port:** `3306`
   - **Username:** `root` (o tu usuario de MySQL)
   - **Password:** Haz clic en "Store in Keychain" y guarda tu contraseña

3. **IMPORTANTE - Pestaña "System Profile":**
   - **System Type:** Cambia de "FreeBSD" a **"Windows"** (o "Windows (x86, 64-bit)")
   - **Installation Type:** Elige según tu instalación:
     - Si instalaste con MySQL Installer → "Installed as Windows Service"
     - Si usas XAMPP → "Standalone MySQL Server"
     - Si usas WAMP → "Standalone MySQL Server"

4. Haz clic en **"Test Connection"**
   - ✅ Si funciona → Haz clic en "OK" y luego haz doble clic en la conexión
   - ❌ Si falla → Revisa usuario/contraseña y que el servicio esté corriendo

---

## 🗄️ PASO 3: Crear la Base de Datos

### 3.1. Desde MySQL Workbench

1. Una vez conectado, haz clic en el botón **"Create a new schema"** (icono de base de datos con +)
2. O ejecuta este SQL en una nueva pestaña de consulta:

```sql
CREATE DATABASE hostal_real_la_molina 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;
```

3. Verifica que se creó:
```sql
SHOW DATABASES;
```

Deberías ver `hostal_real_la_molina` en la lista.

### 3.2. O usar el script incluido

1. En MySQL Workbench, ve a: **File → Open SQL Script**
2. Navega a: `database/create_database.sql`
3. Ejecuta el script (⚡ icono de rayo)

---

## ⚙️ PASO 4: Configurar Laravel para Usar MySQL

### 4.1. Editar el archivo .env

1. Abre el archivo `.env` en la raíz de tu proyecto
2. Busca la sección de base de datos y cámbiala a:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=root
DB_PASSWORD=tu_contraseña_aqui
```

**⚠️ IMPORTANTE:** Reemplaza `tu_contraseña_aqui` con tu contraseña real de MySQL.

### 4.2. Verificar la Conexión desde Laravel

Abre PowerShell en la raíz del proyecto y ejecuta:

```powershell
php artisan config:clear
php artisan db:show
```

Si ves información de la base de datos, ¡la conexión funciona! ✅

---

## 📦 PASO 5: Ejecutar las Migraciones

Ahora que Laravel está conectado a MySQL, ejecuta las migraciones para crear todas las tablas:

```powershell
php artisan migrate
```

Esto creará todas las tablas con los índices optimizados que agregamos.

**Si hay errores:**
- Verifica que la base de datos existe
- Verifica usuario/contraseña en `.env`
- Asegúrate de que MySQL está corriendo

---

## 📊 PASO 6: Migrar Datos Existentes (Opcional)

Si tienes datos importantes en SQLite que quieres conservar:

### 6.1. Exportar datos de SQLite

1. Temporalmente cambia `.env` a SQLite:
```env
DB_CONNECTION=sqlite
```

2. Exporta los datos:
```powershell
php artisan tinker
```

En tinker, ejecuta:
```php
// Exportar habitaciones
$rooms = \App\Models\Room::all();
file_put_contents('rooms_export.json', json_encode($rooms->toArray(), JSON_PRETTY_PRINT));

// Exportar usuarios
$users = \App\Models\User::all();
file_put_contents('users_export.json', json_encode($users->toArray(), JSON_PRETTY_PRINT));

// Exportar reservas
$reservations = \App\Models\Reservation::all();
file_put_contents('reservations_export.json', json_encode($reservations->toArray(), JSON_PRETTY_PRINT));

// Exportar reseñas
$reviews = \App\Models\Review::all();
file_put_contents('reviews_export.json', json_encode($reviews->toArray(), JSON_PRETTY_PRINT));

exit
```

### 6.2. Cambiar a MySQL y restaurar

1. Cambia `.env` de vuelta a MySQL (como en Paso 4.1)
2. Ejecuta migraciones:
```powershell
php artisan migrate
```

3. Importa los datos:
```powershell
php artisan tinker
```

```php
// Importar habitaciones
$rooms = json_decode(file_get_contents('rooms_export.json'), true);
foreach ($rooms as $roomData) {
    unset($roomData['id']); // Dejar que MySQL asigne nuevos IDs
    \App\Models\Room::create($roomData);
}

// Importar usuarios
$users = json_decode(file_get_contents('users_export.json'), true);
foreach ($users as $userData) {
    unset($userData['id']);
    \App\Models\User::create($userData);
}

// Importar reservas
$reservations = json_decode(file_get_contents('reservations_export.json'), true);
foreach ($reservations as $reservationData) {
    unset($reservationData['id']);
    \App\Models\Reservation::create($reservationData);
}

// Importar reseñas
$reviews = json_decode(file_get_contents('reviews_export.json'), true);
foreach ($reviews as $reviewData) {
    unset($reviewData['id']);
    \App\Models\Review::create($reviewData);
}

exit
```

---

## ✅ PASO 7: Verificar que Todo Funciona

1. Limpia todo el cache:
```powershell
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

2. Inicia el servidor:
```powershell
php artisan serve
```

3. Visita `http://127.0.0.1:8000` y verifica:
   - ✅ La página principal carga
   - ✅ Las habitaciones se muestran
   - ✅ Puedes hacer reservas
   - ✅ El panel de administración funciona

---

## 🚀 OPCIÓN RÁPIDA: Script Automatizado

Si prefieres automatizar todo el proceso, puedes usar el script de PowerShell:

```powershell
.\migrar_a_mysql.ps1
```

Este script te guiará paso a paso y hará la mayoría del trabajo automáticamente.

---

## 🔧 Solución de Problemas Comunes

### Error: "Access denied for user"
- Verifica usuario y contraseña en `.env`
- Verifica que el usuario tenga permisos en la base de datos

### Error: "Unknown database"
- Verifica que la base de datos existe: `SHOW DATABASES;` en MySQL Workbench
- Verifica el nombre en `.env` coincide exactamente

### Error: "Table already exists"
```powershell
php artisan migrate:fresh
```
⚠️ **CUIDADO:** Esto elimina todas las tablas y datos

### Error: "PDOException: could not find driver"
- Las extensiones MySQL ya están instaladas (verificamos antes)
- Si persiste, reinicia el servidor web/PHP

### MySQL Workbench no se conecta
1. Verifica que el servicio MySQL está corriendo (Paso 1.1)
2. Verifica que el puerto 3306 no está bloqueado por firewall
3. Verifica usuario/contraseña
4. Cambia "System Type" a "Windows" en la configuración de conexión

---

## 📝 Checklist Final

- [ ] MySQL está instalado y corriendo
- [ ] Conexión en MySQL Workbench funciona
- [ ] Base de datos `hostal_real_la_molina` creada
- [ ] Archivo `.env` configurado con credenciales MySQL
- [ ] `php artisan db:show` muestra la conexión
- [ ] Migraciones ejecutadas (`php artisan migrate`)
- [ ] Datos migrados (si aplica)
- [ ] Aplicación funciona correctamente

---

## 🎉 ¡Listo!

Una vez completados estos pasos, tu aplicación estará usando MySQL y podrá manejar muchos más usuarios concurrentes.

**Capacidad estimada:**
- Con MySQL básico: 50-100 usuarios concurrentes
- Con MySQL + Redis: 200-500 usuarios concurrentes
- Con MySQL + Redis + Octane: 1,000+ usuarios concurrentes

