<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Portafolio - Ignacio Villanueva'; ?></title>
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/'; ?>">
                    <span class="brand-text">IV</span>
                    <span class="brand-name">Ignacio Villanueva</span>
                </a>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/'; ?>" class="<?php echo (isset($page) && $page == 'home') ? 'active' : ''; ?>">Inicio</a></li>
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/about'; ?>" class="<?php echo (isset($page) && $page == 'about') ? 'active' : ''; ?>">Sobre Mí</a></li>
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/projects'; ?>" class="<?php echo (isset($page) && $page == 'projects') ? 'active' : ''; ?>">Proyectos</a></li>
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/experience'; ?>" class="<?php echo (isset($page) && $page == 'experience') ? 'active' : ''; ?>">Experiencia</a></li>
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/skills'; ?>" class="<?php echo (isset($page) && $page == 'skills') ? 'active' : ''; ?>">Habilidades</a></li>
                <li><a href="<?php echo (BASE_URL ? BASE_URL : '') . '/contact'; ?>" class="<?php echo (isset($page) && $page == 'contact') ? 'active' : ''; ?>">Contacto</a></li>
            </ul>
            <div class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
    <main class="main-content">

