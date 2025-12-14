<?php
// Archivo de ejemplo de configuración
// Copia este archivo a config.php y completa con tus datos

// Configuración de base de datos (si se necesita en el futuro)
define('DB_HOST', 'localhost');
define('DB_NAME', 'portafolio');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de la aplicación
define('APP_NAME', 'Portafolio - Ignacio Villanueva');
define('APP_URL', 'http://localhost/Portafolio-IV');

// Configuración de rutas
// Detectar si estamos usando el servidor PHP integrado
$isBuiltInServer = (php_sapi_name() === 'cli-server');
$isLocalDev = (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'localhost' && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '8000');

if ($isBuiltInServer || $isLocalDev) {
    define('BASE_URL', '');
} else {
    define('BASE_URL', '/Portafolio-IV'); // Cambiar según tu dominio
}
define('ASSETS_URL', BASE_URL . '/assets');

// Información de contacto
define('CONTACT_EMAIL', 'tu-email@gmail.com');
define('CONTACT_PHONE', '+549 2612423836');
define('LOCATION', 'Mendoza, Argentina');

// Configuración SMTP para PHPMailer
define('SMTP_ENABLED', true);
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'tu-email@gmail.com');
define('SMTP_PASSWORD', ''); // Contraseña de aplicación de Gmail
define('SMTP_FROM_EMAIL', 'tu-email@gmail.com');
define('SMTP_FROM_NAME', 'Portafolio - Ignacio Villanueva');

// Configuración de debug (solo para desarrollo)
define('SMTP_DEBUG', false);
?>

