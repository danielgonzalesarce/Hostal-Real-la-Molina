# 📸 Gestión de Imágenes de Habitaciones

## ✅ Cambios Realizados

### 1. Eliminación de Imágenes por Defecto
- ✅ El seeder `RoomImageSeeder` ya no crea imágenes por defecto
- ✅ Las imágenes deben ser agregadas manualmente desde el panel de administrador

### 2. Eliminación de Sección Galería
- ✅ Se eliminó la sección "Galería" del panel administrativo
- ✅ Se eliminaron todas las rutas, controladores y vistas relacionadas con la galería

### 3. Mejoras en Gestión de Imágenes
- ✅ Ahora puedes agregar imágenes desde el panel de administrador al crear o editar habitaciones
- ✅ Puedes eliminar imágenes individuales
- ✅ Puedes establecer cualquier imagen como "Principal"
- ✅ La imagen principal es la que se muestra en el listado de habitaciones

---

## 🗑️ Eliminar Todas las Imágenes Existentes

Si quieres eliminar todas las imágenes de habitaciones que fueron creadas anteriormente (imágenes por defecto), ejecuta el siguiente comando:

```powershell
php artisan rooms:clear-images
```

Este comando:
- Te pedirá confirmación antes de eliminar
- Eliminará todas las imágenes de la base de datos
- Eliminará los archivos físicos del storage
- Te mostrará un resumen de cuántas imágenes se eliminaron

**Para forzar la eliminación sin confirmación:**
```powershell
php artisan rooms:clear-images --force
```

---

## 📤 Agregar Imágenes desde el Panel Admin

### Al Crear una Nueva Habitación

1. Ve a **Habitaciones** → **Crear Nueva Habitación**
2. Completa la información básica de la habitación
3. En la sección **"Imágenes"**:
   - Haz clic en el área de carga
   - Selecciona una o múltiples imágenes
   - **La primera imagen seleccionada será automáticamente la imagen principal**
4. Haz clic en **"Crear Habitación"**

### Al Editar una Habitación Existente

1. Ve a **Habitaciones** → Selecciona una habitación → **Editar**
2. En la sección **"Imágenes Actuales"** verás todas las imágenes actuales
3. Para cada imagen puedes:
   - **Establecer como Principal**: Haz clic en el botón "Principal" (si no es la principal)
   - **Eliminar**: Haz clic en el botón "Eliminar" (se pedirá confirmación)
4. Para agregar nuevas imágenes:
   - Ve a la sección **"Agregar Nuevas Imágenes"**
   - Haz clic en el área de carga
   - Selecciona las imágenes que deseas agregar
5. Haz clic en **"Guardar Cambios"**

---

## 🎯 Imagen Principal

- La **imagen principal** es la que se muestra en:
  - El listado de habitaciones en el sitio web
  - Las tarjetas de habitaciones en la página de inicio
  - Los resultados de búsqueda

- **Cómo establecer una imagen como principal:**
  1. Edita la habitación
  2. Pasa el mouse sobre la imagen que quieres establecer como principal
  3. Haz clic en el botón **"Principal"** que aparece en el overlay
  4. Guarda los cambios

- **Nota:** Si eliminas la imagen principal, automáticamente se establecerá otra imagen como principal (si existe).

---

## 📋 Características de las Imágenes

- **Formatos soportados:** JPG, PNG, GIF, WebP
- **Tamaño recomendado:** Mínimo 800x600px para mejor calidad
- **Múltiples imágenes:** Puedes agregar tantas imágenes como desees por habitación
- **Orden:** Las imágenes se muestran en el orden en que fueron agregadas

---

## ⚠️ Importante

- **Eliminar una imagen es permanente:** Una vez eliminada, no se puede recuperar
- **Backup recomendado:** Antes de eliminar imágenes, asegúrate de tener un backup si es necesario
- **Imagen principal requerida:** Es recomendable tener al menos una imagen principal por habitación para que se muestre correctamente en el sitio web

---

## 🔧 Solución de Problemas

### Las imágenes no se muestran en el sitio web

1. Verifica que la habitación tenga al menos una imagen
2. Verifica que exista una imagen marcada como "Principal"
3. Ejecuta: `php artisan storage:link` (si no lo has hecho)
4. Limpia la caché: `php artisan view:clear`

### Error al subir imágenes

1. Verifica que el directorio `storage/app/public/rooms` tenga permisos de escritura
2. Verifica el tamaño de las imágenes (no deben ser muy grandes)
3. Verifica el formato de las imágenes (debe ser JPG, PNG, GIF o WebP)

---

**Última actualización:** {{ date('Y-m-d H:i:s') }}

