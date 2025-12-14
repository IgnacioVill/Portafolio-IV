<?php
// Front Controller - Punto de entrada único
session_start();

// Configuración básica
define('ROOT', __DIR__);
define('APP', ROOT . '/app');
define('PUBLIC_DIR', ROOT . '/public');

// Autoloader simple
spl_autoload_register(function ($class) {
    // Convertir namespace a ruta de archivo
    $class = str_replace('App\\', 'app/', $class);
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Cargar configuración
require_once APP . '/config/config.php';

// Router simple
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/Portafolio-IV', '', $request);
$request = parse_url($request, PHP_URL_PATH);
$request = trim($request, '/');

// Si está vacío, redirigir a home
if (empty($request)) {
    $request = 'home';
}

// Dividir la ruta
$parts = explode('/', $request);
$controller = ucfirst($parts[0]) . 'Controller';
$action = isset($parts[1]) ? $parts[1] : 'index';

// Cargar controlador
$controllerClass = 'App\\Controllers\\' . $controller;
$controllerFile = APP . '/controllers/' . $controller . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            // 404 - Acción no encontrada
            header("HTTP/1.0 404 Not Found");
            require_once APP . '/views/errors/404.php';
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        require_once APP . '/views/errors/404.php';
    }
} else {
    // 404 - Controlador no encontrado
    header("HTTP/1.0 404 Not Found");
    require_once APP . '/views/errors/404.php';
}
?>

