<?php
// Front Controller - Punto de entrada único
session_start();

// Configuración básica
// ROOT es el directorio padre (donde está la carpeta app)
define('ROOT', dirname(__DIR__));
define('APP', ROOT . '/app');
define('PUBLIC_DIR', __DIR__);

// Autoloader simple
spl_autoload_register(function ($class) {
    // Convertir namespace a ruta de archivo
    $class = str_replace('App\\', 'app/', $class);
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Cargar autoloader de Composer si existe
if (file_exists(ROOT . '/vendor/autoload.php')) {
    require_once ROOT . '/vendor/autoload.php';
}

// Cargar configuración
require_once APP . '/config/config.php';

// Router simple
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

// Si el request es para un archivo estático (CSS, JS, imágenes), servirlo directamente
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/i', $request)) {
    return false; // Dejar que el servidor PHP sirva el archivo estático
}

// Remover la barra inicial y limpiar
$request = trim($request, '/');

// Si está vacío o es index.php, redirigir a home
if (empty($request) || $request === 'index.php') {
    $request = 'home';
}

// Dividir la ruta y limpiar elementos vacíos
$parts = array_filter(explode('/', $request));
$parts = array_values($parts); // Reindexar el array

// Obtener controlador y acción
$controllerName = !empty($parts[0]) ? $parts[0] : 'home';
$action = isset($parts[1]) ? $parts[1] : 'index';

// Capitalizar la primera letra del controlador
$controller = ucfirst($controllerName) . 'Controller';

// Cargar controlador
$controllerClass = 'App\\Controllers\\' . $controller;
$controllerFile = APP . '/controllers/' . $controller . '.php';

// Verificar que el archivo existe
if (!file_exists($controllerFile)) {
    // Mostrar información de debug en desarrollo
    if (php_sapi_name() === 'cli-server' || $_SERVER['SERVER_NAME'] === 'localhost') {
        die("Error: Controlador no encontrado<br>Archivo buscado: $controllerFile<br>Controlador: $controller<br>Ruta: $request");
    }
    header("HTTP/1.0 404 Not Found");
    require_once APP . '/views/errors/404.php';
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    error_log("Clase no encontrada: $controllerClass");
    header("HTTP/1.0 404 Not Found");
    require_once APP . '/views/errors/404.php';
    exit;
}

$controllerInstance = new $controllerClass();

if (!method_exists($controllerInstance, $action)) {
    error_log("Método no encontrado: $controllerClass::$action");
    header("HTTP/1.0 404 Not Found");
    require_once APP . '/views/errors/404.php';
    exit;
}

$controllerInstance->$action();
?>

