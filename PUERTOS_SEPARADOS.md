# 🔐 Configuración de Puertos Separados - Admin y Usuario

## ✅ Configuración Completada

Se ha configurado el sistema para que el **panel de administrador** funcione en un **puerto diferente** al sitio público, garantizando **sesiones completamente separadas** y **sin cruces** entre admin y usuarios.

---

## 🚀 Puertos Configurados

- **Puerto 8000** → Sitio Público (Usuarios)
- **Puerto 8001** → Panel Administrativo (Admin)

---

## 📋 Scripts de Inicio

Se han creado scripts para facilitar el inicio de los servidores:

### 1. `start-public.bat`
Inicia el servidor del sitio público en el puerto **8000**
- Acceso: `http://localhost:8000`

### 2. `start-admin.bat`
Inicia el servidor del panel administrativo en el puerto **8001**
- Acceso: `http://localhost:8001/admin/login`

### 3. `start-both.bat` ⭐ **RECOMENDADO**
Inicia **ambos servidores simultáneamente** en ventanas separadas
- Sitio Público: `http://localhost:8000`
- Panel Admin: `http://localhost:8001/admin/login`

---

## 🔧 Cómo Usar

### Opción 1: Iniciar Ambos Servidores (Recomendado)
1. Ejecuta `start-both.bat`
2. Se abrirán dos ventanas de terminal:
   - Una para el sitio público (puerto 8000)
   - Una para el panel admin (puerto 8001)
3. Accede a:
   - **Sitio Público:** http://localhost:8000
   - **Panel Admin:** http://localhost:8001/admin/login

### Opción 2: Iniciar Servidores por Separado
1. Ejecuta `start-public.bat` para el sitio público
2. En otra terminal, ejecuta `start-admin.bat` para el panel admin

### Opción 3: Manualmente
```bash
# Terminal 1 - Sitio Público
php artisan serve --port=8000 --host=127.0.0.1

# Terminal 2 - Panel Admin
php artisan serve --port=8001 --host=127.0.0.1
```

---

## 🔒 Seguridad y Protección

### Middleware Implementado

1. **`EnsureAdminPort`** (`admin.port`)
   - Verifica que las rutas admin solo sean accesibles desde el puerto 8001
   - Si se intenta acceder desde otro puerto, redirige automáticamente al puerto correcto

2. **`BlockAdminFromPublicPort`** (`block.admin.public`)
   - Bloquea el acceso a rutas admin desde el puerto público (8000)
   - Muestra error 404 si se intenta acceder a `/admin/*` desde el puerto 8000

### Comportamiento

- ✅ **Puerto 8000 (Público):**
  - Acceso a todas las rutas públicas
  - **Bloqueado** para rutas `/admin/*`
  - Si intentas acceder a `/admin/login` desde el puerto 8000, recibirás un error 404

- ✅ **Puerto 8001 (Admin):**
  - Acceso exclusivo a rutas `/admin/*`
  - Si intentas acceder a rutas admin desde otro puerto, te redirige automáticamente al puerto 8001
  - Las rutas públicas también funcionan en este puerto (por si necesitas probar)

---

## 🎯 Ventajas de Esta Configuración

1. **Sesiones Completamente Separadas**
   - Cada puerto mantiene su propia sesión
   - No hay cruces entre admin y usuarios
   - Cookies de sesión independientes por puerto

2. **Seguridad Mejorada**
   - El panel admin no es accesible desde el puerto público
   - Protección automática contra acceso no autorizado
   - Redirección automática al puerto correcto

3. **Desarrollo y Producción**
   - Fácil de probar ambas interfaces simultáneamente
   - Separación clara entre entorno público y administrativo
   - Scripts automatizados para inicio rápido

4. **Sin Conflictos**
   - Puedes tener ambas sesiones activas al mismo tiempo
   - Admin puede estar logueado en puerto 8001 mientras usuarios navegan en puerto 8000
   - Cada uno mantiene su propia sesión independiente

---

## ⚙️ Configuración de Puertos

Los puertos están configurados mediante variables de entorno. Puedes cambiarlos editando el archivo `.env`:

```env
PUBLIC_PORT=8000
ADMIN_PORT=8001
```

Si no se especifican, los valores por defecto son:
- Puerto Público: **8000**
- Puerto Admin: **8001**

---

## 📝 Notas Importantes

1. **Ambos servidores deben estar corriendo** para que el sistema funcione completamente
2. **El panel admin solo es accesible desde el puerto 8001**
3. **Las rutas públicas funcionan en ambos puertos**, pero el admin solo funciona en 8001
4. **Usa `start-both.bat`** para iniciar ambos servidores fácilmente

---

## 🔍 Verificación

Para verificar que todo funciona correctamente:

1. ✅ Inicia ambos servidores con `start-both.bat`
2. ✅ Accede a `http://localhost:8000` → Debe mostrar el sitio público
3. ✅ Intenta acceder a `http://localhost:8000/admin/login` → Debe mostrar error 404
4. ✅ Accede a `http://localhost:8001/admin/login` → Debe mostrar el login de admin
5. ✅ Inicia sesión como admin en el puerto 8001
6. ✅ Verifica que puedes navegar el sitio público en el puerto 8000 sin estar autenticado como admin

---

**Última actualización:** 2024-12-19

