<?php
// Router para el servidor PHP integrado
// Este archivo debe estar en la raíz del proyecto
// Uso: php -S localhost:8000 router.php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Si es un archivo estático, servirlo directamente
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false; // Servir el archivo estático
}

// Todo lo demás va al index.php
require_once __DIR__ . '/public/index.php';
?>

