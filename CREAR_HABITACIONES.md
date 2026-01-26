# 🏨 Crear Habitaciones del Hostal

## 📋 Habitaciones que se crearán

El seeder creará **25 habitaciones** en total:

- **5 Habitaciones Matrimoniales** - S/ 90.00 por noche
- **5 Habitaciones Simple** - S/ 70.00 por noche  
- **5 Habitaciones Doble** - S/ 100.00 por noche
- **5 Habitaciones Triple** - S/ 130.00 por noche
- **5 Habitaciones Cuádruple** - S/ 160.00 por noche

## ⚠️ Importante

- **Las habitaciones se crearán SIN imágenes**
- Debes agregar las imágenes manualmente desde el panel de administrador
- Si ya tienes habitaciones existentes, estas NO se eliminarán automáticamente

---

## 🚀 Cómo Ejecutar el Seeder

### Opción 1: Ejecutar solo el seeder de habitaciones

```powershell
php artisan db:seed --class=RoomSeeder
```

### Opción 2: Si quieres eliminar las habitaciones existentes primero

**⚠️ ADVERTENCIA:** Esto eliminará TODAS las habitaciones existentes, incluyendo sus imágenes.

1. Abre el archivo `database/seeders/RoomSeeder.php`
2. Descomenta la línea 6: `Room::truncate();`
3. Ejecuta el seeder:
```powershell
php artisan db:seed --class=RoomSeeder
```
4. Vuelve a comentar la línea `Room::truncate();` para futuras ejecuciones

---

## ✅ Después de Ejecutar el Seeder

1. **Verifica las habitaciones:**
   - Ve al panel de administrador: `http://localhost:8000/admin/login`
   - Navega a **Habitaciones**
   - Deberías ver 25 habitaciones creadas

2. **Agrega las imágenes:**
   - Haz clic en cada habitación → **Editar**
   - En la sección "Agregar Nuevas Imágenes", sube las fotos
   - Establece la primera imagen como "Principal"

3. **Verifica en el sitio web:**
   - Ve a: `http://localhost:8000/rooms`
   - Deberías ver todas las habitaciones listadas
   - Los filtros funcionarán automáticamente

---

## 🔍 Filtros Automáticos

Los filtros en la página de habitaciones ahora funcionan automáticamente:

- **Precio:** Al mover el slider, se filtra automáticamente
- **Tipo de Habitación:** Al seleccionar un tipo, se filtra automáticamente
- **Calificación:** Al seleccionar una calificación mínima, se filtra automáticamente

**No necesitas hacer clic en "Aplicar Filtros"** - todo se actualiza automáticamente.

---

## 📝 Detalles de las Habitaciones

### Habitaciones Matrimoniales (S/ 90.00)
- Capacidad: 2 personas
- Cama king size
- Ideal para parejas

### Habitaciones Simple (S/ 70.00)
- Capacidad: 1 persona
- Cama individual
- Perfecta para viajeros individuales

### Habitaciones Doble (S/ 100.00)
- Capacidad: 2 personas
- Dos camas individuales
- Ideal para amigos o familiares

### Habitaciones Triple (S/ 130.00)
- Capacidad: 3 personas
- Tres camas individuales
- Perfecta para grupos pequeños

### Habitaciones Cuádruple (S/ 160.00)
- Capacidad: 4 personas
- Cuatro camas individuales
- Ideal para grupos grandes o familias

---

## 🔧 Solución de Problemas

### Error: "Room already exists"
- Las habitaciones ya existen en la base de datos
- Si quieres recrearlas, elimina las existentes primero o descomenta `Room::truncate();` en el seeder

### Las habitaciones no aparecen en el sitio web
- Verifica que `is_available` esté en `true` (debería estar por defecto)
- Limpia la caché: `php artisan view:clear`
- Verifica que las rutas estén correctas

### Los filtros no funcionan
- Asegúrate de que Alpine.js esté cargado correctamente
- Verifica la consola del navegador por errores JavaScript
- Limpia la caché del navegador

---

**Última actualización:** {{ date('Y-m-d H:i:s') }}

