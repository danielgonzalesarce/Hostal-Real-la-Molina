# 🚀 Comandos para Ejecutar el Proyecto - Windows PowerShell

## 📋 Orden de Ejecución (PowerShell)

### **Opción 1: Script Automático**

Ejecuta el script PowerShell que crea todo automáticamente:

```powershell
.\EJECUTAR_PROYECTO.ps1
```

Luego sigue con los pasos 7 y 8 manualmente.

---

### **Opción 2: Comandos Manuales**

#### **1️⃣ Instalar Dependencias de PHP (Composer)**

```powershell
composer install
```

#### **2️⃣ Instalar Dependencias de Node.js (npm)**

```powershell
npm install
```

#### **3️⃣ Configurar Variables de Entorno**

Si no tienes archivo `.env`:

```powershell
Copy-Item .env.example .env
```

Luego edita el archivo `.env` con tu editor favorito y configura:
- `DB_DATABASE=hostal_real`
- `DB_USERNAME=tu_usuario`
- `DB_PASSWORD=tu_contraseña`

#### **4️⃣ Generar Key de Aplicación**

```powershell
php artisan key:generate
```

#### **5️⃣ Ejecutar Migraciones**

```powershell
php artisan migrate
```

#### **6️⃣ Ejecutar Seeders (Datos de Prueba - Opcional)**

```powershell
php artisan db:seed
```

---

## 🎯 **Ejecutar el Proyecto (2 Terminales)**

### **Terminal 1 - Vite (Assets en Desarrollo)**

Abre una nueva terminal PowerShell y ejecuta:

```powershell
cd "c:\Users\DANIEL ALEXANDER\hostal-real-la-molina"
npm run dev
```

**⚠️ IMPORTANTE:** Mantén esta terminal abierta y corriendo mientras desarrollas.

---

### **Terminal 2 - Servidor Laravel**

Abre otra nueva terminal PowerShell y ejecuta:

```powershell
cd "c:\Users\DANIEL ALEXANDER\hostal-real-la-molina"
php artisan serve
```

El servidor estará disponible en: **http://localhost:8000**

---

## 📝 **Comandos Útiles Adicionales**

### Limpiar Cache:
```powershell
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Ver Rutas:
```powershell
php artisan route:list
```

### Ver Logs:
```powershell
php artisan pail
```

### Reiniciar Migraciones (CUIDADO: Borra datos):
```powershell
php artisan migrate:fresh
php artisan db:seed
```

---

## ⚠️ **Solución de Problemas**

### Si `npm install` falla:
```powershell
npm cache clean --force
npm install
```

### Si `composer install` falla:
```powershell
composer clear-cache
composer install
```

### Si los assets no se cargan:
1. Asegúrate de que `npm run dev` esté corriendo en Terminal 1
2. Limpia la cache: `php artisan view:clear`
3. Recarga la página con **Ctrl + F5**

### Si el puerto 8000 está ocupado:
```powershell
php artisan serve --port=8080
```

---

## 🔧 **Configuración de Base de Datos en .env**

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

## ✅ **Checklist de Verificación**

- [ ] Composer instalado (`composer --version`)
- [ ] Node.js y npm instalados (`node --version` y `npm --version`)
- [ ] PHP instalado (`php --version`)
- [ ] Archivo `.env` configurado
- [ ] Migraciones ejecutadas (`php artisan migrate`)
- [ ] `npm run dev` corriendo en Terminal 1
- [ ] `php artisan serve` corriendo en Terminal 2
- [ ] Acceder a `http://localhost:8000` funciona

---

## 🎨 **Notas Importantes**

1. **Siempre mantén `npm run dev` corriendo** mientras desarrollas para ver los cambios en tiempo real
2. El servidor Laravel por defecto corre en el puerto **8000**
3. Si cambias algo en CSS/JS, Vite lo recompilará automáticamente
4. Para producción, usa `npm run build` en lugar de `npm run dev`

---

## 🚀 **Comandos Rápidos (Resumen)**

```powershell
# Instalar todo
composer install
npm install

# Configurar
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate

# Ejecutar (en 2 terminales separadas)
# Terminal 1:
npm run dev

# Terminal 2:
php artisan serve
```

---

## 📱 **Acceso al Proyecto**

Una vez que ambos servidores estén corriendo:

- **Web Pública:** http://localhost:8000
- **Panel Admin:** http://localhost:8000/admin/dashboard (requiere login como admin)

