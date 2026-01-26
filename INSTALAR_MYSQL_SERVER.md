# 🚀 Instalar MySQL Server desde MySQL Installer

## 📋 Situación Actual
Tienes MySQL Installer abierto y MySQL Workbench 8.0.46 instalado, pero necesitas instalar **MySQL Server** para poder usar la base de datos.

---

## 🔧 PASOS A SEGUIR

### Paso 1: Agregar MySQL Server

1. En MySQL Installer, haz clic en el botón **"Add..."** (en el panel derecho)

2. Se abrirá una ventana con productos disponibles. Busca:
   - **MySQL Server 8.0.x** (la versión más reciente disponible)
   - Debe aparecer en la lista de productos

3. Selecciona **MySQL Server** y haz clic en **"Next"** o **"→"**

### Paso 2: Configurar la Instalación

1. **Tipo de instalación:**
   - Elige **"Developer Default"** (recomendado) o **"Full"**
   - Esto instalará MySQL Server + herramientas necesarias

2. Haz clic en **"Execute"** o **"Next"**

3. El instalador descargará e instalará MySQL Server (esto puede tardar varios minutos)

### Paso 3: Configurar MySQL Server

Después de la instalación, se abrirá el **Configuration Wizard**:

1. **Type and Networking:**
   - Elige **"Standalone MySQL Server"**
   - Puerto: **3306** (por defecto, déjalo así)
   - Haz clic en **"Next"**

2. **Authentication Method:**
   - Elige **"Use Strong Password Encryption"** (recomendado)
   - Haz clic en **"Next"**

3. **Accounts and Roles:**
   - **Root Password:** Crea una contraseña segura y **ANÓTALA** (la necesitarás)
   - Confirma la contraseña
   - Haz clic en **"Next"**

4. **Windows Service:**
   - ✅ Marca **"Configure MySQL Server as a Windows Service"**
   - ✅ Marca **"Start the MySQL Server at System Startup"**
   - Service Name: **MySQL80** (o el que aparezca)
   - Haz clic en **"Next"**

5. **Apply Configuration:**
   - Haz clic en **"Execute"**
   - Espera a que termine la configuración
   - Haz clic en **"Finish"**

### Paso 4: Verificar la Instalación

1. En MySQL Installer, deberías ver ahora:
   - ✅ **MySQL Server 8.0.x** en la lista de productos instalados
   - ✅ Estado: "Installed" o "Ready to configure"

2. Verifica que el servicio está corriendo:
   - Presiona `Windows + R`
   - Escribe: `services.msc`
   - Busca **"MySQL80"** o **"MySQL"**
   - Debe decir **"En ejecución"**

---

## ✅ Después de Instalar

Una vez instalado MySQL Server, continúa con la migración:

1. **Abre MySQL Workbench** y crea una conexión (si no la tienes)
2. **Crea la base de datos** `hostal_real_la_molina`
3. **Configura el archivo `.env`** de Laravel
4. **Ejecuta las migraciones**: `php artisan migrate`

---

## 🔧 Si No Aparece "Add..." o Hay Problemas

### Opción A: Usar "Modify..."
1. Si ya tienes MySQL Server parcialmente instalado, haz clic en **"Modify..."**
2. Selecciona **MySQL Server** en la lista
3. Sigue los pasos de configuración

### Opción B: Reinstalar
1. Si hay problemas, haz clic en **"Remove..."** para MySQL Server (si existe)
2. Luego haz clic en **"Add..."** para instalarlo de nuevo

---

## ⚠️ Notas Importantes

- **Anota la contraseña de root** que configures, la necesitarás para:
  - Conectarte desde MySQL Workbench
  - Configurar el archivo `.env` de Laravel

- **Puerto 3306:** Es el puerto estándar, no lo cambies a menos que tengas un conflicto

- **Servicio Windows:** Asegúrate de que esté configurado para iniciar automáticamente

---

## 🎯 Resumen Rápido

1. Haz clic en **"Add..."**
2. Selecciona **MySQL Server 8.0.x**
3. Elige **"Developer Default"**
4. Configura la contraseña de root
5. Marca "Start at System Startup"
6. ¡Listo! MySQL Server estará instalado y corriendo

