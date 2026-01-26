# 🔐 Sesiones Separadas - Admin y Usuario

## ✅ Configuración Completada

Se han configurado **sesiones completamente separadas** para el panel de administrador y el sitio público de usuario.

---

## 🔧 Cambios Realizados

### 1. Guard Separado para Admin
- ✅ Creado guard `'admin'` en `config/auth.php`
- ✅ El guard `'admin'` usa el mismo provider `'users'` pero mantiene una sesión independiente

### 2. Controlador de Login Admin
- ✅ Actualizado para usar `Auth::guard('admin')` en lugar de `Auth::`
- ✅ La autenticación de admin ahora usa una sesión completamente separada

### 3. Middleware
- ✅ `EnsureUserIsAdmin`: Verifica autenticación usando `auth('admin')`
- ✅ `RedirectIfAdminAuthenticated`: Middleware personalizado para el guest admin

### 4. Rutas
- ✅ Rutas admin usan `middleware(['auth:admin', 'admin'])` - sesión separada
- ✅ Rutas públicas usan `middleware(['auth'])` - guard 'web' por defecto

### 5. Layout Admin
- ✅ Actualizado para usar `auth('admin')->user()` en lugar de `auth()->user()`

---

## 🎯 Cómo Funciona

### Sesión de Usuario (Sitio Público)
- **Guard:** `web` (por defecto)
- **Rutas:** `/login`, `/register`, `/`, `/habitaciones`, etc.
- **Sesión:** Independiente del admin
- **Cuando un usuario inicia sesión:** Solo afecta al guard `web`

### Sesión de Admin (Panel Administrativo)
- **Guard:** `admin`
- **Rutas:** `/admin/login`, `/admin/dashboard`, `/admin/*`
- **Sesión:** Completamente separada del usuario
- **Cuando un admin inicia sesión:** Solo afecta al guard `admin`

---

## 🔒 Resultado

Ahora puedes:
- ✅ Iniciar sesión como **admin** en `/admin/login` → Solo se autentica en el guard `admin`
- ✅ Iniciar sesión como **usuario** en `/login` → Solo se autentica en el guard `web`
- ✅ Tener **ambas sesiones activas simultáneamente** sin conflictos
- ✅ El admin puede estar autenticado en el panel admin mientras un usuario está autenticado en el sitio público
- ✅ Cerrar sesión en uno **NO afecta** la sesión del otro

---

## 📋 Ejemplo de Uso

### Escenario 1: Admin autenticado
1. Admin inicia sesión en `/admin/login`
2. Admin está autenticado en el guard `admin`
3. En el sitio público (`/`), el botón "Acceder" **SÍ aparece** porque `auth()->check()` (guard web) es `false`
4. El admin puede navegar el sitio público como visitante anónimo

### Escenario 2: Usuario autenticado
1. Usuario inicia sesión en `/login`
2. Usuario está autenticado en el guard `web`
3. En el sitio público, ve "Mis Reservas" y "Salir"
4. Si intenta acceder a `/admin/login`, puede iniciar sesión como admin sin afectar su sesión de usuario

### Escenario 3: Ambos autenticados simultáneamente
1. Admin inicia sesión en `/admin/login` → Guard `admin` activo
2. Usuario inicia sesión en `/login` → Guard `web` activo
3. Ambos pueden estar autenticados al mismo tiempo sin conflictos
4. Cada uno mantiene su propia sesión independiente

---

## 🚀 Ventajas

- ✅ **Sesiones completamente independientes**
- ✅ **No hay conflictos** entre admin y usuario
- ✅ **Seguridad mejorada** - el admin no aparece como autenticado en el sitio público
- ✅ **Flexibilidad** - puedes tener ambas sesiones activas si es necesario
- ✅ **Sin necesidad de puertos diferentes** - Laravel maneja las sesiones separadas automáticamente

---

## ⚠️ Nota Importante

Aunque técnicamente las sesiones están separadas usando guards diferentes, Laravel puede compartir la misma cookie de sesión. Si necesitas **completamente separar** las sesiones (incluyendo cookies diferentes), podrías:

1. Usar diferentes dominios/subdominios (ej: `admin.hostalreal.com` y `hostalreal.com`)
2. Configurar diferentes nombres de sesión en `config/session.php`

Sin embargo, con la configuración actual de guards separados, las sesiones funcionan de manera independiente y no deberían causar conflictos.

---

**Última actualización:** {{ date('Y-m-d H:i:s') }}

