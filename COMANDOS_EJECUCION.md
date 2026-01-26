# 🚀 Comandos para Ejecutar el Proyecto - Hostal Real La Molina

## 📋 Orden de Ejecución

### 1️⃣ **Instalar Dependencias de PHP (Composer)**

```bash
composer install
```

### 2️⃣ **Instalar Dependencias de Node.js (npm)**

```bash
npm install
```

### 3️⃣ **Configurar Variables de Entorno**

Si no tienes archivo `.env`, copia el ejemplo:

```bash
copy .env.example .env
```

O en Linux/Mac:
```bash
cp .env.example .env
```

Luego edita el archivo `.env` y configura:
- `DB_DATABASE=hostal_real`
- `DB_USERNAME=tu_usuario`
- `DB_PASSWORD=tu_contraseña`

### 4️⃣ **Generar Key de Aplicación**

```bash
php artisan key:generate
```

### 5️⃣ **Ejecutar Migraciones**

```bash
php artisan migrate
```

### 6️⃣ **Ejecutar Seeders (Datos de Prueba - Opcional)**

```bash
php artisan db:seed
```

### 7️⃣ **Compilar Assets para Desarrollo**

En una terminal separada, ejecuta:

```bash
npm run dev
```

Este comando debe mantenerse corriendo mientras desarrollas.

### 8️⃣ **Iniciar el Servidor de Laravel**

En otra terminal separada, ejecuta:

```bash
php artisan serve
```

El servidor estará disponible en: `http://localhost:8000`

---

## 🎯 **Comandos Rápidos (Todo en Uno)**

### Para Desarrollo:

**Terminal 1 - Vite (Assets):**
```bash
npm run dev
```

**Terminal 2 - Laravel Server:**
```bash
php artisan serve
```

### Para Producción:

**Compilar assets para producción:**
```bash
npm run build
```

---

## 📝 **Comandos Útiles Adicionales**

### Limpiar Cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Ver Rutas:
```bash
php artisan route:list
```

### Crear Usuario Admin (si tienes seeder):
```bash
php artisan db:seed --class=AdminUserSeeder
```

### Ver Logs:
```bash
php artisan pail
```

---

## ⚠️ **Solución de Problemas**

### Si npm install falla:
```bash
npm cache clean --force
npm install
```

### Si composer install falla:
```bash
composer clear-cache
composer install
```

### Si hay problemas con las migraciones:
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Si los assets no se cargan:
1. Asegúrate de que `npm run dev` esté corriendo
2. Limpia la cache: `php artisan view:clear`
3. Recarga la página con Ctrl+F5

---

## 🔧 **Configuración de Base de Datos**

Asegúrate de que tu archivo `.env` tenga:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostal_real
DB_USERNAME=root
DB_PASSWORD=
```

---

## ✅ **Verificación Final**

1. ✅ Composer instalado
2. ✅ npm instalado
3. ✅ Archivo `.env` configurado
4. ✅ Migraciones ejecutadas
5. ✅ `npm run dev` corriendo (Terminal 1)
6. ✅ `php artisan serve` corriendo (Terminal 2)
7. ✅ Acceder a `http://localhost:8000`

---

## 🎨 **Notas Importantes**

- **Siempre mantén `npm run dev` corriendo** mientras desarrollas para ver los cambios en tiempo real
- El servidor Laravel por defecto corre en el puerto **8000**
- Si necesitas cambiar el puerto: `php artisan serve --port=8080`
- Para producción, usa `npm run build` en lugar de `npm run dev`

