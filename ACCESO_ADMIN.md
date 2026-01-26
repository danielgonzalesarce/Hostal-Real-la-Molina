# 🔐 Acceso al Panel Administrativo

## ⚠️ IMPORTANTE: URL Correcta

**La URL correcta es:**
```
http://localhost:8000/admin/login
```

**NOTA:** No incluyas un punto (.) al final de la URL. Debe ser exactamente:
- ✅ `http://localhost:8000/admin/login`
- ❌ `http://localhost:8000/admin/login.` (con punto al final)

---

## 📋 Credenciales de Acceso

- **Email:** `admin@hostalreal.com`
- **Contraseña:** `HostalReal2024!`
- **URL:** `http://localhost:8000/admin/login`

---

## 🚀 Pasos para Acceder

### 1. Asegúrate de que el servidor esté corriendo

Abre una terminal PowerShell y ejecuta:

```powershell
cd "c:\Users\DANIEL ALEXANDER\hostal-real-la-molina"
php artisan serve
```

Deberías ver:
```
INFO  Server running on [http://127.0.0.1:8000]
```

### 2. Abre tu navegador

Ve a la URL exacta (sin punto al final):
```
http://localhost:8000/admin/login
```

### 3. Ingresa las credenciales

- Email: `admin@hostalreal.com`
- Contraseña: `HostalReal2024!`
- Opcional: Marca "Recordarme" si quieres mantener la sesión

### 4. Haz clic en "Acceder al Panel"

Serás redirigido automáticamente al dashboard administrativo.

---

## 🔧 Solución de Problemas

### Error 404 - Página no encontrada

**Causas posibles:**
1. El servidor no está corriendo
2. URL incorrecta (con punto al final o espacios)
3. Caché de rutas desactualizado

**Solución:**
```powershell
# 1. Limpia la caché
php artisan route:clear
php artisan config:clear
php artisan cache:clear

# 2. Inicia el servidor
php artisan serve

# 3. Accede a la URL correcta (sin punto al final)
http://localhost:8000/admin/login
```

### Error de Credenciales

Si las credenciales no funcionan, recrea el usuario admin:

```powershell
php artisan db:seed --class=AdminUserSeeder
```

---

## 🔒 Seguridad

- El login admin está **oculto** de la navegación pública
- Solo usuarios con rol `admin` pueden acceder
- La URL no aparece en ningún enlace público del sitio
- Solo tú conoces la URL directa

---

## 📝 Notas

- Si ya estás autenticado como admin, serás redirigido automáticamente al dashboard
- El formulario tiene validación completa
- Los mensajes de error son claros y descriptivos
- Puedes usar "Recordarme" para mantener la sesión activa

---

**Última actualización:** {{ date('Y-m-d H:i:s') }}

