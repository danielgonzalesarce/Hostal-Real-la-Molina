# Guía de Migración de SQLite a MySQL

## 📋 Requisitos Previos

1. **MySQL instalado y funcionando**
   - Verifica que MySQL esté corriendo en tu sistema
   - Puedes usar MySQL Workbench o la línea de comandos

2. **Credenciales de MySQL**
   - Usuario (generalmente `root`)
   - Contraseña
   - Puerto (generalmente `3306`)

## 🚀 Opción Rápida: Script Automatizado

Si prefieres automatizar el proceso, puedes usar el script de PowerShell incluido:

```powershell
.\migrar_a_mysql.ps1
```

Este script te guiará paso a paso y configurará todo automáticamente.

---

## 🔧 Paso 1: Crear la Base de Datos en MySQL

### Opción A: Usando MySQL Workbench

1. Abre MySQL Workbench
2. Conéctate a tu servidor MySQL
3. Abre el archivo `database/create_database.sql` incluido en el proyecto
4. Ejecuta el script (o copia y pega este comando):

```sql
CREATE DATABASE hostal_real_la_molina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

5. Verifica que se creó correctamente:

```sql
SHOW DATABASES;
```

### Opción B: Usando Línea de Comandos

```bash
mysql -u root -p
```

Luego ejecuta:

```sql
CREATE DATABASE hostal_real_la_molina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

## ⚙️ Paso 2: Configurar el Archivo .env

1. Abre el archivo `.env` en la raíz del proyecto
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

## 🔍 Paso 3: Verificar la Conexión

Ejecuta este comando para verificar que la conexión funciona:

```bash
php artisan db:show
```

O prueba la conexión manualmente:

```bash
php artisan tinker
```

Luego en tinker:

```php
DB::connection()->getPdo();
```

Si no hay errores, la conexión está funcionando. Escribe `exit` para salir.

## 📦 Paso 4: Ejecutar las Migraciones

Ahora ejecuta las migraciones para crear todas las tablas en MySQL:

```bash
php artisan migrate
```

Esto creará todas las tablas con los índices optimizados que agregamos.

## 📊 Paso 5: Migrar Datos Existentes (Opcional)

Si tienes datos importantes en SQLite que quieres migrar:

### 5.1. Exportar datos de SQLite

Primero, cambia temporalmente a SQLite en `.env`:

```env
DB_CONNECTION=sqlite
```

Luego exporta los datos:

```bash
php artisan tinker
```

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

### 5.2. Cambiar a MySQL y restaurar datos

1. Cambia `.env` de vuelta a MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=root
DB_PASSWORD=tu_contraseña_aqui
```

2. Ejecuta las migraciones:

```bash
php artisan migrate
```

3. Importa los datos (en tinker):

```bash
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

## ✅ Paso 6: Verificar que Todo Funciona

1. Limpia el cache:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

2. Prueba la aplicación:

```bash
php artisan serve
```

3. Visita `http://127.0.0.1:8000` y verifica que:
   - La página principal carga correctamente
   - Las habitaciones se muestran
   - Puedes hacer reservas
   - El panel de administración funciona

## 🔒 Paso 7: Optimizar para Producción (Opcional)

Para mejor rendimiento, ejecuta:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## ⚠️ Solución de Problemas

### Error: "Access denied for user"
- Verifica que el usuario y contraseña en `.env` sean correctos
- Asegúrate de que el usuario tenga permisos en la base de datos

### Error: "Unknown database"
- Verifica que la base de datos existe: `SHOW DATABASES;`
- Verifica el nombre en `.env` coincide exactamente

### Error: "Table already exists"
- Si las tablas ya existen, puedes hacer:
  ```bash
  php artisan migrate:fresh
  ```
  ⚠️ **CUIDADO:** Esto eliminará todas las tablas y datos existentes

### Error: "PDOException: could not find driver"
- Instala la extensión PHP MySQL:
  ```bash
  # En Windows con XAMPP/WAMP, habilita en php.ini:
  extension=pdo_mysql
  extension=mysqli
  ```

## 📝 Notas Importantes

1. **Backup:** Siempre haz backup de tu base de datos SQLite antes de migrar:
   ```bash
   copy database\database.sqlite database\database.sqlite.backup
   ```

2. **Imágenes:** Las imágenes en `storage/app/public/rooms/` no necesitan migración, solo los datos de la BD.

3. **Sesiones:** Si tienes usuarios logueados, deberán iniciar sesión nuevamente después de la migración.

4. **Cache:** Después de migrar, limpia todo el cache para evitar problemas.

## 🎉 ¡Listo!

Una vez completados estos pasos, tu aplicación estará usando MySQL y podrá manejar muchos más usuarios concurrentes.

