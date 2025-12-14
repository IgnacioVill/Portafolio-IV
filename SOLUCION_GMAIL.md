# Solución al Error de Autenticación Gmail

## Problema Detectado

El error que estás viendo es:
```
534-5.7.9 Application-specific password required
```

Esto significa que Gmail requiere una **contraseña de aplicación** específica, no tu contraseña normal de cuenta.

## Solución Paso a Paso

### Paso 1: Activar Verificación en 2 Pasos

1. Ve a tu cuenta de Google: https://myaccount.google.com
2. Ve a **Seguridad**
3. Busca **Verificación en 2 pasos**
4. Si no está activada, actívala (es obligatorio para generar contraseñas de aplicación)

### Paso 2: Generar Contraseña de Aplicación

1. Una vez activada la verificación en 2 pasos, vuelve a **Seguridad**
2. Busca **Contraseñas de aplicaciones** (puede estar en "Cómo iniciar sesión en Google")
3. Si no la ves, ve directamente a: https://myaccount.google.com/apppasswords
4. Selecciona:
   - **Aplicación**: Correo
   - **Dispositivo**: Otro (nombre personalizado) → Escribe "Portafolio PHP"
5. Haz clic en **Generar**
6. **Copia la contraseña de 16 caracteres** que te muestra (sin espacios)

### Paso 3: Actualizar Configuración

1. Abre `app/config/config.php`
2. Reemplaza `SMTP_PASSWORD` con la nueva contraseña de aplicación:

```php
define('SMTP_PASSWORD', 'xxxx xxxx xxxx xxxx'); // Sin espacios, los 16 caracteres juntos
```

### Paso 4: Probar

Ejecuta el script de prueba:

```bash
php test_email.php
```

O simplemente envía un mensaje desde el formulario de contacto.

## Notas Importantes

⚠️ **La contraseña de aplicación es diferente a tu contraseña de Gmail**

- La contraseña de aplicación tiene 16 caracteres
- Se genera específicamente para aplicaciones externas
- Puedes generar múltiples contraseñas para diferentes aplicaciones
- Si la pierdes, simplemente genera una nueva

## Si Aún No Funciona

1. **Verifica que la verificación en 2 pasos esté activada**
2. **Asegúrate de copiar la contraseña completa** (16 caracteres sin espacios)
3. **Verifica que no haya espacios** antes o después de la contraseña en config.php
4. **Prueba generar una nueva contraseña de aplicación** si la anterior no funciona

## Alternativa: OAuth2

Si prefieres usar OAuth2 (más seguro pero más complejo), puedes configurarlo, pero para desarrollo la contraseña de aplicación es más simple.

