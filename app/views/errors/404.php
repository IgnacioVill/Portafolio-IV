<?php
// Cargar configuración si no está cargada
if (!defined('BASE_URL')) {
    define('ROOT', dirname(dirname(dirname(__DIR__))));
    define('APP', ROOT . '/app');
    define('BASE_URL', '/Portafolio-IV');
    define('ASSETS_URL', BASE_URL . '/public/assets');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
</head>
<body>
    <div class="error-page">
        <div class="container">
            <div class="error-content">
                <h1>404</h1>
                <h2>Página no encontrada</h2>
                <p>Lo sentimos, la página que buscas no existe.</p>
                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-top: 1rem;">
                    URL solicitada: <?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'N/A'); ?>
                </p>
                <div style="margin-top: 2rem;">
                    <a href="<?php echo BASE_URL ? BASE_URL : '/'; ?>" class="btn btn-primary">Volver al inicio</a>
                    <a href="<?php echo BASE_URL ? BASE_URL : '/'; ?>/projects" class="btn btn-secondary" style="margin-left: 1rem;">Ver Proyectos</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

