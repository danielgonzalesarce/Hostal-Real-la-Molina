# 🚀 Inicio Rápido - Servidores

## ⚠️ Error: "localhost rechazó la conexión"

Este error significa que **el servidor no está corriendo** en el puerto 8001.

---

## ✅ Solución: Iniciar el Servidor

### Opción 1: Usar el Script (Recomendado) ⭐

1. **Doble clic en `start-both.bat`**
   - Esto iniciará ambos servidores automáticamente
   - Se abrirán 2 ventanas de terminal

2. **Espera a que aparezcan los mensajes:**
   ```
   Laravel development server started: http://127.0.0.1:8000
   Laravel development server started: http://127.0.0.1:8001
   ```

3. **Accede a:**
   - Sitio Público: http://localhost:8000
   - Panel Admin: http://localhost:8001/admin/login

---

### Opción 2: Iniciar Solo el Servidor Admin

1. **Doble clic en `start-admin.bat`**
   - Esto iniciará solo el servidor admin en el puerto 8001

2. **Espera el mensaje:**
   ```
   Laravel development server started: http://127.0.0.1:8001
   ```

3. **Accede a:** http://localhost:8001/admin/login

---

### Opción 3: Manualmente desde Terminal

Abre una terminal en la carpeta del proyecto y ejecuta:

```bash
php artisan serve --port=8001 --host=127.0.0.1
```

---

## 📋 Verificación

Una vez iniciado el servidor, deberías ver:

```
INFO  Server running on [http://127.0.0.1:8001].
```

Si ves este mensaje, el servidor está corriendo correctamente.

---

## 🔍 Solución de Problemas

### El puerto 8001 está ocupado

Si recibes un error de que el puerto está ocupado:

1. **Cierra todas las ventanas de terminal que tengan servidores corriendo**
2. **O cambia el puerto** editando `start-admin.bat`:
   ```bat
   php artisan serve --port=8002 --host=127.0.0.1
   ```
   Y actualiza la URL a: `http://localhost:8002/admin/login`

---

## ⚡ Inicio Rápido (Comando Único)

Para iniciar ambos servidores rápidamente:

```bash
start-both.bat
```

O desde PowerShell:
```powershell
.\start-both.bat
```

---

**Nota:** Los servidores deben estar corriendo para que las URLs funcionen. Si cierras las ventanas de terminal, los servidores se detendrán.

