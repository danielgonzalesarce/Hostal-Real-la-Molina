# 🛒 FASE 2: Adquisición de Infraestructura

## 🎯 Objetivo
Adquirir y configurar inicialmente el dominio y el servidor VPS necesarios para el proyecto.

---

## 📋 Tareas de esta Fase

### 2.1 Compra y Configuración de Dominio

#### Paso 1: Registrar el Dominio

**Proveedor Recomendado: Namecheap**

1. Ir a: https://www.namecheap.com/
2. Buscar el dominio deseado (ej: `hostalreallamolina.com`)
3. Agregar al carrito
4. Completar el registro:
   - Información de contacto
   - Privacidad WHOIS (recomendado activar)
   - Auto-renovación (recomendado activar)
5. Realizar el pago

**Alternativa: Cloudflare**
- Precios más bajos
- DNS rápido incluido
- Seguridad básica incluida

#### Paso 2: Configuración Inicial del Dominio

**En Namecheap:**
1. Ir a "Domain List"
2. Seleccionar el dominio
3. Ir a "Advanced DNS"
4. **NO configurar aún** - Esperaremos a tener la IP del VPS

**Nota:** Guardar las credenciales de acceso al panel del dominio.

---

### 2.2 Configuración del VPS

#### Paso 1: Crear Cuenta en el Proveedor

**Proveedor Recomendado: DigitalOcean**

1. Ir a: https://www.digitalocean.com/
2. Crear cuenta (usar email profesional)
3. Verificar email
4. Agregar método de pago (tarjeta de crédito)

**Alternativa: Hetzner (mejor precio)**
- Precios más bajos
- Buen rendimiento
- Ubicación en Europa (puede tener más latencia para Perú)

#### Paso 2: Crear Droplet/VPS

**En DigitalOcean:**

1. Ir a "Create" → "Droplets"
2. Configurar:
   - **Image:** Ubuntu 22.04 (LTS)
   - **Plan:** Regular (4GB RAM / 2 vCPU / 80GB SSD) - $24/mes
   - **Datacenter region:** 
     - Si usuarios en Perú: **San Francisco** (más cercano)
     - Alternativa: **New York**
   - **Authentication:** 
     - ✅ **SSH keys** (recomendado) O
     - ✅ **Password** (más fácil para empezar)
   - **Hostname:** `hostal-real-la-molina`
   - **Tags:** `production`, `laravel`, `web`
3. Click en "Create Droplet"
4. **Esperar 1-2 minutos** a que se cree

#### Paso 3: Obtener Información del VPS

Una vez creado, anotar:
- **IP Address:** (ej: 157.230.123.45)
- **Username:** `root` (por defecto)
- **Password:** (si usaste autenticación por contraseña)

**Guardar esta información de forma segura.**

---

### 2.3 Configuración Inicial de DNS

#### Paso 1: Configurar DNS en el Proveedor del Dominio

**En Namecheap (Advanced DNS):**

1. Ir a "Domain List" → Seleccionar dominio → "Advanced DNS"
2. Eliminar registros por defecto (si existen)
3. Agregar registros:

```
Type    Host    Value              TTL
A       @       157.230.123.45      Automatic
A       www     157.230.123.45      Automatic
```

**Reemplazar `157.230.123.45` con la IP real de tu VPS.**

4. Guardar cambios
5. **Esperar propagación:** 5 minutos a 48 horas (generalmente 15-30 minutos)

#### Paso 2: Verificar Propagación DNS

Usar herramientas online:
- https://www.whatsmydns.net/
- https://dnschecker.org/

Buscar:
- `A` record para `@` (dominio principal)
- `A` record para `www`

---

### 2.4 Verificación de Acceso al VPS

#### Paso 1: Conectarse por SSH

**Desde Windows (PowerShell o CMD):**

```powershell
ssh root@157.230.123.45
```

**O desde Windows Terminal/PowerShell con SSH:**

```powershell
ssh -i ruta\a\tu\clave.pem root@157.230.123.45
```

**Si usaste contraseña:**
- Ingresar la contraseña cuando se solicite
- Primera vez: Confirmar fingerprint (escribir `yes`)

**Si usaste SSH keys:**
- La conexión debería ser automática

#### Paso 2: Verificar Sistema

Una vez conectado, verificar:

```bash
# Verificar versión de Ubuntu
lsb_release -a

# Verificar recursos
free -h
df -h

# Verificar conectividad
ping -c 3 google.com
```

---

## ✅ Checklist de Fase 2

- [ ] Dominio registrado y activo
- [ ] Credenciales de dominio guardadas de forma segura
- [ ] VPS creado y funcionando
- [ ] IP del VPS anotada
- [ ] Credenciales de VPS guardadas de forma segura
- [ ] DNS configurado (A records)
- [ ] Propagación DNS verificada (opcional, puede tomar tiempo)
- [ ] Acceso SSH al VPS verificado
- [ ] Sistema operativo verificado (Ubuntu 22.04)

---

## 🔐 Seguridad Inicial

### Cambiar Contraseña del Root (si usaste password)

```bash
passwd
# Ingresar nueva contraseña segura
```

### Crear Usuario No-Root (Recomendado)

```bash
# Crear usuario
adduser deploy

# Agregar a grupo sudo
usermod -aG sudo deploy

# Verificar
groups deploy
```

**Nota:** Usaremos este usuario en fases siguientes.

---

## 📝 Información a Documentar

Crear archivo `CREDENCIALES_SERVIDOR.md` (NO subir a Git):

```
DOMINIO:
- Proveedor: Namecheap
- Dominio: hostalreallamolina.com
- Usuario: [usuario]
- Contraseña: [contraseña]
- Panel: https://ap.www.namecheap.com/

VPS:
- Proveedor: DigitalOcean
- IP: 157.230.123.45
- Usuario: root
- Contraseña: [contraseña]
- SSH Key: [ruta si aplica]
- Panel: https://cloud.digitalocean.com/
```

**⚠️ IMPORTANTE:** Este archivo debe mantenerse privado y seguro.

---

## 🚀 Próximo Paso

Una vez completada esta fase, procederemos a:
- **FASE 3: Configuración del Servidor**
  - Instalación de Nginx
  - Instalación de PHP 8.2+
  - Instalación de MySQL 8.0+
  - Configuración de firewall
  - Configuración de usuarios

---

**Estado:** ⏳ Listo para iniciar cuando el cliente tenga dominio y VPS

