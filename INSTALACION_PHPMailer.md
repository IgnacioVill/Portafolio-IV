# Instalación de PHPMailer

## Paso 1: Instalar Composer

Si no tienes Composer instalado:

1. **Windows**: Descarga e instala desde [getcomposer.org](https://getcomposer.org/download/)
2. O usa el instalador directo:
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

## Paso 2: Instalar PHPMailer

En la raíz del proyecto, ejecuta:

```bash
composer install
```

O si Composer está instalado globalmente:

```bash
composer install
```

Esto instalará PHPMailer y todas sus dependencias en la carpeta `vendor/`.

## Paso 3: Configurar SMTP

Edita el archivo `app/config/config.php` y configura tus credenciales SMTP:

```php
// Configuración SMTP para PHPMailer
define('SMTP_ENABLED', true);
define('SMTP_HOST', 'smtp.gmail.com'); // Para Gmail
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); // 'tls' o 'ssl'
define('SMTP_USERNAME', 'tu-email@gmail.com');
define('SMTP_PASSWORD', 'tu-contraseña-de-aplicación'); // Ver abajo
define('SMTP_FROM_EMAIL', 'tu-email@gmail.com');
define('SMTP_FROM_NAME', 'Portafolio - Ignacio Villanueva');
```

## Paso 4: Configurar Gmail (si usas Gmail)

### Opción A: Contraseña de Aplicación (Recomendado)

1. Ve a tu cuenta de Google: [myaccount.google.com](https://myaccount.google.com)
2. Activa la verificación en 2 pasos si no está activada
3. Ve a "Seguridad" → "Contraseñas de aplicaciones"
4. Genera una nueva contraseña de aplicación para "Correo"
5. Usa esa contraseña en `SMTP_PASSWORD`

### Opción B: OAuth2 (Más seguro, más complejo)

Requiere configuración adicional con Google Cloud Console.

## Otros Proveedores SMTP

### Outlook/Hotmail
```php
define('SMTP_HOST', 'smtp-mail.outlook.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

### Yahoo
```php
define('SMTP_HOST', 'smtp.mail.yahoo.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

### SendGrid
```php
define('SMTP_HOST', 'smtp.sendgrid.net');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'apikey');
define('SMTP_PASSWORD', 'tu-api-key-de-sendgrid');
```

### Mailgun
```php
define('SMTP_HOST', 'smtp.mailgun.org');
define('SMTP_PORT', 587);
```

## Paso 5: Probar el Formulario

1. Asegúrate de que el servidor esté corriendo
2. Ve a `http://localhost:8000/contact`
3. Completa y envía el formulario
4. Revisa tu bandeja de entrada

## Solución de Problemas

### Error: "Class 'PHPMailer\PHPMailer\PHPMailer' not found"

**Solución**: Ejecuta `composer install` en la raíz del proyecto.

### Error: "SMTP connect() failed"

**Posibles causas**:
- Credenciales incorrectas
- Firewall bloqueando el puerto
- Gmail requiere contraseña de aplicación, no la contraseña normal

**Solución**: 
- Verifica las credenciales
- Usa contraseña de aplicación para Gmail
- Verifica que el puerto no esté bloqueado

### Error: "Authentication failed"

**Solución**: 
- Verifica usuario y contraseña
- Para Gmail, usa contraseña de aplicación
- Asegúrate de que la verificación en 2 pasos esté activada

### Modo Debug

Para ver más detalles del error, revisa los logs de PHP o agrega:

```php
// En app/core/Mailer.php, después de catch (Exception $e)
error_log("PHPMailer Error: " . $this->mail->ErrorInfo);
```

## Notas de Seguridad

⚠️ **IMPORTANTE**: 
- Nunca subas `app/config/config.php` con credenciales reales a Git
- Usa variables de entorno o un archivo de configuración local
- Considera usar `.env` para credenciales sensibles

## Archivo .env (Opcional pero Recomendado)

Crea un archivo `.env` en la raíz:

```
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USERNAME=tu-email@gmail.com
SMTP_PASSWORD=tu-contraseña
```

Y carga las variables en `config.php`:

```php
// Cargar .env si existe
if (file_exists(ROOT . '/.env')) {
    $lines = file(ROOT . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}
```

