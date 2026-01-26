# 📊 FASE 1: Análisis y Planificación

## 🎯 Objetivo
Definir la arquitectura técnica, seleccionar proveedores y establecer el plan detallado de implementación.

---

## 📋 Tareas de esta Fase

### 1.1 Análisis de Requisitos Técnicos

#### Requisitos Funcionales (Ya implementados)
- ✅ Gestión de habitaciones (CRUD completo)
- ✅ Sistema de reservas online
- ✅ Panel administrativo
- ✅ Sistema de reseñas y calificaciones
- ✅ Gestión de imágenes
- ✅ Filtros de búsqueda avanzados
- ✅ Autenticación de usuarios

#### Requisitos No Funcionales
- **Rendimiento:** 1,000 solicitudes/minuto
- **Disponibilidad:** 99.5% uptime
- **Seguridad:** HTTPS, backups diarios
- **Escalabilidad:** Arquitectura preparada para crecimiento

---

### 1.2 Selección de Proveedores

#### Dominio (.com, .pe, .net, etc.)
**Recomendaciones:**

| Proveedor | Ventajas | Precio Aprox. |
|-----------|----------|---------------|
| **Namecheap** | Buena relación precio/calidad, DNS gratuito | $10-15/año |
| **GoDaddy** | Popular, fácil de usar | $12-20/año |
| **Google Domains** | Integración con Google Workspace | $12/año |
| **Cloudflare** | DNS rápido, seguridad incluida | $8-10/año |

**Recomendación:** **Namecheap** o **Cloudflare** por precio y características.

#### VPS (Virtual Private Server)
**Recomendaciones:**

| Proveedor | Plan Recomendado | Especificaciones | Precio |
|-----------|------------------|------------------|--------|
| **DigitalOcean** | Droplet 4GB RAM | 2 vCPU, 4GB RAM, 80GB SSD | $24/mes |
| **Linode** | Linode 4GB | 2 vCPU, 4GB RAM, 80GB SSD | $24/mes |
| **Vultr** | Regular Performance | 2 vCPU, 4GB RAM, 80GB SSD | $24/mes |
| **Hetzner** | CPX21 | 3 vCPU, 4GB RAM, 80GB SSD | €4.75/mes |
| **AWS Lightsail** | 4GB RAM | 2 vCPU, 4GB RAM, 80GB SSD | $24/mes |

**Recomendación:** **DigitalOcean** o **Hetzner** (mejor precio/rendimiento).

**Especificaciones Mínimas Recomendadas:**
- **CPU:** 2 vCPU
- **RAM:** 4GB (mínimo 2GB)
- **Almacenamiento:** 40GB SSD (mínimo)
- **Ancho de banda:** 4TB/mes
- **Ubicación:** Más cercana a los usuarios (Lima, Perú recomendado)

---

### 1.3 Arquitectura Técnica Propuesta

```
┌─────────────────────────────────────────────────────────┐
│                    INTERNET                              │
└────────────────────┬────────────────────────────────────┘
                     │
                     ▼
            ┌────────────────┐
            │   Cloudflare    │  (Opcional: CDN + DDoS)
            │   DNS + CDN    │
            └────────┬───────┘
                     │
                     ▼
            ┌────────────────┐
            │   VPS Server   │
            │   (Ubuntu)     │
            └────────┬───────┘
                     │
        ┌────────────┼────────────┐
        ▼            ▼            ▼
   ┌─────────┐  ┌─────────┐  ┌─────────┐
   │ Nginx   │  │  PHP    │  │  MySQL  │
   │ :80/443 │  │  8.2+   │  │  8.0+   │
   └─────────┘  └─────────┘  └─────────┘
        │            │            │
        └────────────┴────────────┘
                     │
                     ▼
            ┌────────────────┐
            │   Laravel App  │
            │   (Production) │
            └────────────────┘
```

#### Stack Tecnológico
- **OS:** Ubuntu 22.04 LTS
- **Web Server:** Nginx 1.24+
- **PHP:** PHP 8.2+ (FPM)
- **Database:** MySQL 8.0+
- **SSL:** Let's Encrypt (Certbot)
- **Backups:** Automáticos (cron + mysqldump)
- **Monitoring:** Uptime Robot (gratis) o similar

---

### 1.4 Plan de Dominio

#### Opciones de Dominio
1. **hostalreallamolina.com** (recomendado)
2. **hostalreallamolina.pe** (si es empresa peruana)
3. **hostalreallamolina.com.pe**
4. **hostalreal-lamolina.com**

#### Configuración DNS Necesaria
- **A Record:** `@` → IP del VPS
- **A Record:** `www` → IP del VPS
- **CNAME:** `www` → dominio principal (alternativa)

---

### 1.5 Plan de Seguridad

#### Nivel Básico (Incluido)
- ✅ Firewall (UFW)
- ✅ SSL/HTTPS (Let's Encrypt)
- ✅ Usuarios con permisos limitados
- ✅ Actualizaciones automáticas de seguridad
- ✅ Backups diarios

#### Nivel Intermedio (Opcional)
- Cloudflare (DDoS protection)
- Fail2ban (protección contra ataques)
- ModSecurity (WAF)

---

### 1.6 Plan de Backups

#### Estrategia
- **Frecuencia:** Diaria (automática)
- **Retención:** 7 días
- **Ubicación:** Servidor local + opcionalmente S3/Backblaze
- **Contenido:**
  - Base de datos MySQL (dump diario)
  - Archivos de la aplicación
  - Configuraciones importantes

#### Herramientas
- `mysqldump` para base de datos
- `rsync` o `tar` para archivos
- Cron jobs para automatización

---

### 1.7 Plan de Monitoreo

#### Básico (Gratis)
- **Uptime Robot:** Monitoreo de disponibilidad
- **Logs del servidor:** Nginx, PHP, MySQL
- **Alertas por email:** Si el servidor cae

#### Intermedio (Opcional)
- **New Relic:** APM (Application Performance Monitoring)
- **Sentry:** Monitoreo de errores
- **Grafana:** Dashboards de métricas

---

## ✅ Checklist de Fase 1

- [ ] Requisitos técnicos documentados
- [ ] Proveedor de dominio seleccionado
- [ ] Proveedor de VPS seleccionado
- [ ] Arquitectura técnica definida
- [ ] Plan de seguridad establecido
- [ ] Plan de backups definido
- [ ] Plan de monitoreo definido
- [ ] **Aprobación del cliente para continuar**

---

## 📝 Decisiones a Tomar con el Cliente

1. **Dominio:** ¿Qué extensión prefiere? (.com, .pe, .com.pe)
2. **Presupuesto:** ¿Cuál es el presupuesto mensual para hosting?
3. **Ubicación del servidor:** ¿Prefiere servidor en Perú o internacional?
4. **Backups:** ¿Necesita backups en ubicación remota (adicional)?
5. **Monitoreo:** ¿Necesita monitoreo avanzado o básico es suficiente?

---

## 🚀 Próximo Paso

Una vez aprobada esta fase, procederemos a:
- **FASE 2: Adquisición de Infraestructura**
  - Compra de dominio
  - Configuración de VPS
  - Configuración inicial de DNS

---

**Estado:** ⏳ Pendiente de aprobación del cliente

