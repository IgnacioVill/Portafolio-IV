<?php
// Configuración de la aplicación

// Configuración de base de datos (si se necesita en el futuro)
define('DB_HOST', 'localhost');
define('DB_NAME', 'portafolio');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de la aplicación
define('APP_NAME', 'Portafolio - Ignacio Villanueva');
define('APP_URL', 'http://localhost/Portafolio-IV');

// Configuración de rutas
// Detectar el entorno
$isBuiltInServer = (php_sapi_name() === 'cli-server');
$isLocalDev = (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'localhost' && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '8000');
$isVercel = (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']));

if ($isBuiltInServer || $isLocalDev || $isVercel) {
    define('BASE_URL', '');
} else {
    define('BASE_URL', '/Portafolio-IV');
}
define('ASSETS_URL', BASE_URL . '/assets');

// Información de contacto
define('CONTACT_EMAIL', getenv('CONTACT_EMAIL') ?: 'nachovilla306@gmail.com');
define('CONTACT_PHONE', getenv('CONTACT_PHONE') ?: '+549 2612423836');
define('LOCATION', getenv('LOCATION') ?: 'Mendoza, Argentina');

// Configuración SMTP para PHPMailer
// En Vercel, usa variables de entorno. En local, usa los valores por defecto
define('SMTP_ENABLED', true);
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', (int)(getenv('SMTP_PORT') ?: 587));
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'tls');
define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: 'nachovilla306@gmail.com');
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: 'qbgiszrazyzskypu');
define('SMTP_FROM_EMAIL', getenv('SMTP_FROM_EMAIL') ?: 'nachovilla306@gmail.com');
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'Portafolio - Ignacio Villanueva');

// Configuración de debug (solo para desarrollo)
define('SMTP_DEBUG', false); // Cambiar a true para ver errores detallados
?>

