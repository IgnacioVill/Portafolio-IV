# 🚀 Desplegar en Vercel - Guía Paso a Paso

## Requisitos Previos

1. **Cuenta de Vercel**: Crea una en [vercel.com](https://vercel.com) (gratis)
2. **Node.js instalado**: Para usar Vercel CLI (opcional, también puedes usar la web)
3. **Git**: Tu proyecto debe estar en un repositorio Git (GitHub, GitLab, Bitbucket)

## Opción 1: Deploy desde la Web (Más Fácil) ⭐

### Paso 1: Preparar el Repositorio

1. Sube tu proyecto a GitHub/GitLab/Bitbucket
2. **IMPORTANTE**: Asegúrate de que `app/config/config.php` NO esté en Git (debe estar en `.gitignore`)
3. Crea `app/config/config.php` en el servidor después del deploy

### Paso 2: Conectar con Vercel

1. Ve a [vercel.com](https://vercel.com)
2. Haz clic en **"Add New Project"**
3. Conecta tu repositorio de Git
4. Selecciona el proyecto

### Paso 3: Configurar

Vercel detectará automáticamente que es PHP. Solo necesitas:

1. **Root Directory**: Dejar vacío (o `.` si pide algo)
2. **Build Command**: Dejar vacío (o `composer install` si quieres instalar dependencias)
3. **Output Directory**: Dejar vacío
4. **Install Command**: `composer install` (si usas Composer)

### Paso 4: Variables de Entorno

En la configuración del proyecto, agrega estas variables de entorno:

```
SMTP_ENABLED=true
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=tu-email@gmail.com
SMTP_PASSWORD=tu-contraseña-de-aplicación
SMTP_FROM_EMAIL=tu-email@gmail.com
SMTP_FROM_NAME=Portafolio - Ignacio Villanueva
CONTACT_EMAIL=tu-email@gmail.com
```

### Paso 5: Deploy

1. Haz clic en **"Deploy"**
2. Espera a que termine (2-3 minutos)
3. ¡Listo! Tu portafolio estará en línea

## Opción 2: Deploy con CLI (Más Control)

### Paso 1: Instalar Vercel CLI

```bash
npm install -g vercel
```

### Paso 2: Login

```bash
vercel login
```

### Paso 3: Configurar Variables de Entorno

Crea un archivo `.vercelenv` (opcional) o configúralas después:

```bash
vercel env add SMTP_USERNAME
vercel env add SMTP_PASSWORD
# etc...
```

### Paso 4: Deploy

```bash
# Deploy a producción
vercel --prod

# O deploy a preview
vercel
```

## Configuración Post-Deploy

### 1. Actualizar config.php para Vercel

Vercel ya detecta automáticamente el entorno, pero si necesitas ajustar algo:

El código ya está preparado para detectar Vercel automáticamente.

### 2. Verificar Variables de Entorno

1. Ve a tu proyecto en Vercel
2. Settings → Environment Variables
3. Verifica que todas estén configuradas

### 3. Probar el Formulario

1. Ve a tu URL de Vercel
2. Prueba el formulario de contacto
3. Verifica que llegue el email

## Estructura de Archivos en Vercel

Vercel ejecutará tu aplicación desde `public/index.php` como punto de entrada.

La estructura debe ser:
```
/
├── app/
├── public/
│   ├── index.php  ← Punto de entrada
│   └── assets/
├── vendor/        ← Si usas Composer
├── composer.json
└── vercel.json
```

## Solución de Problemas

### Error: "Cannot find module @vercel/php"

**Solución**: Vercel lo instala automáticamente. Si hay problemas, verifica `vercel.json`.

### Error: "Class not found"

**Solución**: Asegúrate de que `composer install` se ejecute. Agrega en Vercel:
- **Install Command**: `composer install`

### Las rutas no funcionan

**Solución**: Verifica que `vercel.json` tenga la configuración correcta de rutas.

### El formulario no envía emails

**Solución**: 
1. Verifica las variables de entorno SMTP
2. Asegúrate de usar contraseña de aplicación de Gmail
3. Revisa los logs en Vercel Dashboard

## Comandos Útiles

```bash
# Ver logs en tiempo real
vercel logs

# Ver información del proyecto
vercel inspect

# Listar deployments
vercel ls

# Abrir dashboard
vercel dashboard
```

## URLs

Después del deploy, tendrás:
- **Producción**: `tu-proyecto.vercel.app`
- **Preview**: `tu-proyecto-git-tu-branch.vercel.app`

Puedes conectar un dominio personalizado desde el dashboard de Vercel.

## Notas Importantes

⚠️ **Seguridad**:
- NUNCA subas `app/config/config.php` con contraseñas a Git
- Usa variables de entorno en Vercel
- El archivo `config.php` se creará automáticamente o puedes usar variables de entorno

✅ **Ventajas de Vercel**:
- SSL automático
- CDN global
- Deploy automático con cada push
- Preview deployments para cada PR
- Gratis para proyectos personales

## Próximos Pasos

1. Sube tu código a GitHub
2. Conecta con Vercel
3. Configura variables de entorno
4. Deploy
5. ¡Disfruta tu portafolio en línea!

¿Necesitas ayuda con algún paso específico?

