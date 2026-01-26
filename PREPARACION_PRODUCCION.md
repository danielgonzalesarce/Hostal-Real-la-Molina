# 🚀 Preparación del Proyecto para Producción

## ✅ Checklist de Preparación

### 1. Archivos de Configuración

- [x] `.env.production.example` creado
- [x] `deploy.sh` creado (Linux/Mac)
- [x] `deploy.ps1` creado (Windows)
- [x] `.gitignore` verificado

### 2. Optimizaciones Aplicadas

- [x] Cache configurado en controladores
- [x] Índices de base de datos optimizados
- [x] Eager loading implementado
- [x] Limpieza automática de cache

### 3. Seguridad

- [x] Variables de entorno para información sensible
- [x] No hay credenciales hardcodeadas
- [x] `.env` en `.gitignore`
- [x] Archivos sensibles excluidos

### 4. Base de Datos

- [x] Migraciones completas
- [x] Índices optimizados
- [x] Compatible con MySQL 8.0+

---

## 📋 Pasos para Preparar Producción

### Paso 1: Configurar Variables de Entorno

En el servidor, crear archivo `.env`:

```bash
cp .env.production.example .env
nano .env
```

Configurar:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://hostalreallamolina.com`
- Credenciales de base de datos
- Generar `APP_KEY` con `php artisan key:generate`

### Paso 2: Instalar Dependencias

```bash
# Composer (sin dependencias de desarrollo)
composer install --optimize-autoloader --no-dev --no-interaction

# NPM (solo producción)
npm ci --production
```

### Paso 3: Compilar Assets

```bash
npm run build
```

### Paso 4: Ejecutar Migraciones

```bash
php artisan migrate --force
```

### Paso 5: Optimizar Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Paso 6: Configurar Permisos

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan storage:link
```

---

## 🔧 Scripts de Deploy

### Linux/Mac

```bash
chmod +x deploy.sh
./deploy.sh
```

### Windows

```powershell
.\deploy.ps1
```

---

## ⚠️ Verificaciones Antes de Producción

### Código
- [ ] No hay `dd()`, `dump()`, `var_dump()` en el código
- [ ] No hay `console.log()` de debug en JavaScript
- [ ] `APP_DEBUG=false` en `.env`
- [ ] Todas las rutas funcionan

### Base de Datos
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados (si aplica)
- [ ] Índices creados
- [ ] Backup configurado

### Assets
- [ ] Assets compilados (`npm run build`)
- [ ] Imágenes optimizadas
- [ ] CSS/JS minificados

### Seguridad
- [ ] Credenciales en variables de entorno
- [ ] Permisos de archivos correctos
- [ ] SSL configurado
- [ ] Firewall activo

---

## 🚨 Problemas Comunes y Soluciones

### Error: "Class not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Error: "Route not found"
```bash
php artisan route:clear
php artisan route:cache
```

### Error: "View not found"
```bash
php artisan view:clear
php artisan view:cache
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

1. **Nunca** subir `.env` a Git
2. **Siempre** usar `APP_DEBUG=false` en producción
3. **Siempre** compilar assets con `npm run build`
4. **Siempre** ejecutar migraciones antes de activar
5. **Siempre** verificar permisos de storage

---

## ✅ Proyecto Listo para Producción

Una vez completados todos los pasos, el proyecto está listo para desplegarse en producción.

