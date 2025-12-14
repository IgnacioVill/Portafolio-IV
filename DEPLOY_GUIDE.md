# 🚀 Guía de Despliegue del Portafolio

## Opciones de Hosting para PHP

### ❌ Firebase Hosting
**No soporta PHP directamente**. Firebase Hosting está diseñado para:
- Aplicaciones estáticas (HTML, CSS, JS)
- Aplicaciones Node.js
- No soporta PHP nativo

### ✅ Opciones Recomendadas para PHP

## 1. **Vercel** (Recomendado - Gratis)
Vercel tiene soporte para PHP con su runtime.

**Pasos:**
1. Instala Vercel CLI:
   ```bash
   npm install -g vercel
   ```

2. En la raíz del proyecto:
   ```bash
   vercel
   ```

3. Configura `vercel.json`:
   ```json
   {
     "version": 2,
     "builds": [
       {
         "src": "public/index.php",
         "use": "@vercel/php"
       }
     ],
     "routes": [
       {
         "src": "/(.*)",
         "dest": "/public/$1"
       }
     ]
   }
   ```

**Ventajas:**
- ✅ Gratis para proyectos personales
- ✅ SSL automático
- ✅ CDN global
- ✅ Deploy automático con Git

## 2. **Heroku** (Gratis con limitaciones)

**Pasos:**
1. Instala Heroku CLI
2. Crea `Procfile`:
   ```
   web: vendor/bin/heroku-php-apache2 public/
   ```
3. Deploy:
   ```bash
   heroku create tu-portafolio
   git push heroku main
   ```

## 3. **Railway** (Gratis con créditos)

**Pasos:**
1. Conecta tu repositorio
2. Configura el build:
   - Build Command: `composer install`
   - Start Command: `php -S 0.0.0.0:$PORT -t public`

## 4. **Hosting Tradicional** (Más Compatible)

### Opciones:
- **000webhost** (Gratis)
- **InfinityFree** (Gratis)
- **Hostinger** (Pago, económico)
- **cPanel hosting** (Cualquier proveedor)

**Pasos:**
1. Sube todos los archivos vía FTP/SFTP
2. Asegúrate de que `public/` sea el directorio web
3. Configura la base de datos si es necesario
4. Ajusta `BASE_URL` en `config.php`

## 5. **GitHub Pages + Netlify** (Solo Frontend)

Si quieres convertir a estático, podrías usar:
- Jekyll
- Hugo
- Next.js (SSG)

Pero perderías la funcionalidad PHP del formulario de contacto.

## 📋 Preparación para Deploy

### Archivos a Subir

```
Portafolio-IV/
├── app/
├── public/
├── vendor/          (si usas Composer)
├── composer.json
├── composer.lock
└── .htaccess        (para Apache)
```

### Configuraciones Necesarias

1. **Actualizar `app/config/config.php`**:
   ```php
   // Cambiar BASE_URL según tu dominio
   define('BASE_URL', ''); // Para dominio raíz
   // o
   define('BASE_URL', '/portafolio'); // Para subdirectorio
   ```

2. **Variables de Entorno** (Recomendado):
   - Mover credenciales SMTP a variables de entorno
   - No subir `config.php` con contraseñas a Git

3. **Permisos**:
   ```bash
   chmod 755 storage/messages
   ```

### ⚠️ Seguridad

**NUNCA subas a Git:**
- `app/config/config.php` con contraseñas
- `storage/messages/*.txt` (mensajes de contacto)
- `.env` con credenciales

Usa `.gitignore` para protegerlos.

## 🔧 Comandos Útiles

### Para Vercel:
```bash
npm install -g vercel
vercel
```

### Para Heroku:
```bash
heroku create
git push heroku main
```

### Para FTP tradicional:
```bash
# Usa FileZilla, WinSCP, o similar
# Sube todos los archivos excepto:
# - .git/
# - node_modules/
# - storage/messages/*.txt
```

## 📝 Checklist Pre-Deploy

- [ ] Actualizar `BASE_URL` en `config.php`
- [ ] Verificar que `composer install` funcione
- [ ] Probar el formulario de contacto
- [ ] Verificar rutas y enlaces
- [ ] Configurar variables de entorno para SMTP
- [ ] Revisar permisos de carpetas
- [ ] Probar en el servidor de destino

## 🎯 Recomendación

Para tu portafolio PHP con MVC, recomiendo:

1. **Vercel** - Si quieres algo moderno y fácil
2. **Hosting tradicional** - Si quieres máxima compatibilidad
3. **Railway** - Si quieres algo intermedio

¿Quieres que te ayude a configurar alguna de estas opciones?

