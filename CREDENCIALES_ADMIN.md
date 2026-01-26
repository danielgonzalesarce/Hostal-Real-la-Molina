# 🔐 Credenciales de Acceso - Panel Administrativo

## ⚠️ INFORMACIÓN CONFIDENCIAL

Este documento contiene las credenciales de acceso al panel administrativo del sistema. **Mantén esta información segura y no la compartas públicamente.**

---

## 📋 Datos de Acceso

### Usuario Administrador

- **Email:** `admin@hostalreal.com`
- **Contraseña:** `HostalReal2024!`
- **Rol:** Administrador
- **URL de Acceso:** `http://localhost:8000/admin/login` (o tu dominio)

---

## 🔗 Rutas del Sistema

### Panel Administrativo (Oculto)
- **Login Admin:** `/admin/login`
- **Dashboard:** `/admin/dashboard`
- **Habitaciones:** `/admin/rooms`
- **Reservas:** `/admin/reservations`
- **Reseñas:** `/admin/reviews`
- **Galería:** `/admin/gallery`
- **Configuración:** `/admin/settings`

### Sitio Público
- **Inicio:** `/`
- **Habitaciones:** `/habitaciones`
- **Contacto:** `/contacto`
- **Login Cliente:** `/login`
- **Registro Cliente:** `/register`

---

## 🔒 Seguridad

### Características de Seguridad Implementadas:

1. ✅ **Login Separado:** El login de administrador está completamente separado del login público
2. ✅ **Ruta Oculta:** La ruta `/admin/login` NO aparece en la navegación pública
3. ✅ **Middleware de Protección:** Solo usuarios con rol `admin` pueden acceder al panel
4. ✅ **Redirección Automática:** Usuarios no autorizados son redirigidos al login admin
5. ✅ **Contraseña Hasheada:** La contraseña está almacenada de forma segura usando bcrypt

### Recomendaciones:

- 🔐 **Cambia la contraseña** después del primer acceso
- 🔐 **No compartas** estas credenciales públicamente
- 🔐 **Usa HTTPS** en producción
- 🔐 **Mantén el sistema actualizado** con las últimas versiones de Laravel

---

## 🚀 Comandos Útiles

### Crear/Actualizar Usuario Admin
```bash
php artisan db:seed --class=AdminUserSeeder
```

### Limpiar Caché
```bash
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

### Verificar Rutas
```bash
php artisan route:list --path=admin
```

---

## 📝 Notas Importantes

- El usuario admin se crea automáticamente al ejecutar el seeder
- Si el usuario ya existe, se actualizará con los nuevos datos
- El login admin es independiente del login público de clientes
- Los clientes NO pueden acceder al panel admin, incluso si conocen la URL

---

**Última actualización:** {{ date('Y-m-d H:i:s') }}

