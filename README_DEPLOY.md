# 🚀 Guía de Deploy - Hostal Real La Molina

## ⚠️ IMPORTANTE: Vercel NO es Compatible

**Vercel.com NO soporta aplicaciones PHP/Laravel.**

Este proyecto es **Laravel (PHP)** y necesita un hosting que soporte PHP.

**Ver:** `HOSTING_ALTERNATIVAS.md` para opciones compatibles.

---

## ✅ Opciones Recomendadas

### 1. Railway (Más Fácil) ⭐ Recomendado

**Pasos:**
1. Crear cuenta en [railway.app](https://railway.app)
2. Conectar repositorio de GitHub
3. Railway detecta automáticamente Laravel
4. Configurar variables de entorno desde `env.production.example`
5. ¡Deploy automático!

**Archivo de configuración:** `railway.json` (ya incluido)

---

### 2. Render

**Pasos:**
1. Crear cuenta en [render.com](https://render.com)
2. Conectar repositorio
3. Seleccionar "Web Service" → PHP
4. Usar `render.yaml` (ya incluido)
5. Configurar variables de entorno

**Archivo de configuración:** `render.yaml` (ya incluido)

---

### 3. VPS (Más Control)

**Ya tienes toda la documentación:**
- `GUIA_PRODUCCION_COMPLETA.md` - Guía completa
- `deploy.sh` / `deploy.ps1` - Scripts automatizados
- `nginx.conf.example` - Configuración Nginx
- `php-production.ini.example` - Configuración PHP

**Proveedores recomendados:**
- DigitalOcean ($6/mes)
- Hetzner (€4.75/mes)
- Vultr ($6/mes)

---

## 📋 Checklist Antes de Deploy

### Variables de Entorno Necesarias

Copiar desde `env.production.example` y configurar:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
APP_KEY=  # Generar con: php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_SECURE_COOKIE=true
LOG_CHANNEL=daily
LOG_LEVEL=error
```

### Comandos Post-Deploy

```bash
# Generar APP_KEY
php artisan key:generate

# Ejecutar migraciones
php artisan migrate --force

# Optimizar
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlace de storage
php artisan storage:link
```

---

## 🔒 Seguridad

- ✅ `APP_DEBUG=false` en producción
- ✅ `APP_ENV=production`
- ✅ `SESSION_SECURE_COOKIE=true`
- ✅ SSL/HTTPS habilitado
- ✅ Headers de seguridad configurados

---

## 📚 Documentación Completa

- **`HOSTING_ALTERNATIVAS.md`** - Comparación de opciones de hosting
- **`GUIA_PRODUCCION_COMPLETA.md`** - Guía completa para VPS
- **`RESUMEN_PRODUCCION.md`** - Resumen ejecutivo
- **`PRODUCCION_CHECKLIST.md`** - Checklist de verificación

---

## ❓ ¿Necesitas Ayuda?

1. **Elige una opción de hosting** (Railway, Render, o VPS)
2. **Revisa la documentación** correspondiente
3. **Sigue los pasos** de configuración

**¡El proyecto está 100% listo para producción!** 🎉

