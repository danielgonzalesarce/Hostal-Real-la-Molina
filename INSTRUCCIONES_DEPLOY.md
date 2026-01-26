# 📦 Instrucciones de Deploy a Producción

## ✅ Proyecto Listo para Producción

El proyecto ha sido preparado y optimizado para producción. Todos los archivos necesarios están creados.

---

## 📋 Archivos Creados para Producción

### Scripts de Deploy
- ✅ `deploy.sh` - Script de deploy para Linux/Mac
- ✅ `deploy.ps1` - Script de deploy para Windows

### Configuración
- ✅ `.env.production.example` - Plantilla de variables de entorno
- ✅ `.gitignore` actualizado - Excluye archivos sensibles

### Documentación
- ✅ `PREPARACION_PRODUCCION.md` - Guía de preparación
- ✅ `PRODUCCION_CHECKLIST.md` - Checklist final

---

## 🚀 Proceso de Deploy

### Opción 1: Usando Script Automatizado (Recomendado)

#### En Linux/Mac:
```bash
chmod +x deploy.sh
./deploy.sh
```

#### En Windows:
```powershell
.\deploy.ps1
```

### Opción 2: Manual

Sigue los pasos en `PREPARACION_PRODUCCION.md`

---

## ⚙️ Configuración en el Servidor

### 1. Crear archivo .env

```bash
cd /var/www/hostal-real-la-molina
cp .env.production.example .env
nano .env
```

### 2. Configurar valores importantes

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://hostalreallamolina.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real_la_molina
DB_USERNAME=hostal_user
DB_PASSWORD=TU_CONTRASEÑA_AQUI
```

### 3. Generar APP_KEY

```bash
php artisan key:generate
```

---

## 🔧 Comandos Post-Deploy

### Verificar que todo funciona

```bash
# Verificar rutas
php artisan route:list

# Verificar configuración
php artisan config:show

# Verificar cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Verificar permisos

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan storage:link
```

---

## ✅ Verificaciones Finales

- [ ] Sitio accesible vía HTTPS
- [ ] Panel administrativo funciona
- [ ] Sistema de reservas funciona
- [ ] Imágenes cargan correctamente
- [ ] No hay errores en logs
- [ ] Cache funcionando

---

## 🚨 Solución de Problemas

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Class not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Assets no cargan
```bash
npm run build
php artisan storage:link
```

### Permisos incorrectos
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📝 Notas Importantes

1. **NUNCA** subir `.env` a Git
2. **SIEMPRE** usar `APP_DEBUG=false` en producción
3. **SIEMPRE** compilar assets con `npm run build`
4. **SIEMPRE** verificar permisos de storage

---

**Proyecto listo para producción** ✅

