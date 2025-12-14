<?php
if (!isset($project)) {
    header("HTTP/1.0 404 Not Found");
    require_once APP . '/views/errors/404.php';
    exit;
}
?>

<section class="project-detail-section">
    <div class="container">
        <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/projects'; ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Volver a Proyectos
        </a>
        
        <div class="project-detail">
            <div class="project-detail-header">
                <div class="project-detail-category">
                    <?php echo $project['category']; ?>
                </div>
                <div class="project-detail-status <?php echo strtolower($project['status']); ?>">
                    <?php echo $project['status']; ?>
                </div>
            </div>
            
            <h1><?php echo $project['title']; ?></h1>
            
            <div class="project-detail-image">
                <div class="project-image-placeholder-large">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
            
            <div class="project-detail-content">
                <div class="project-detail-main">
                    <div class="project-description-full">
                        <h2>Descripción del Proyecto</h2>
                        <?php if (isset($project['fullDescription'])): ?>
                            <p><?php echo $project['fullDescription']; ?></p>
                        <?php else: ?>
                            <p><?php echo $project['description']; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="project-features-full">
                        <h2>Características Principales</h2>
                        <ul>
                            <?php foreach ($project['features'] as $feature): ?>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span><?php echo $feature; ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="project-detail-sidebar">
                    <div class="project-info-card">
                        <h3>Tecnologías Utilizadas</h3>
                        <div class="technologies-list">
                            <?php foreach ($project['technologies'] as $tech): ?>
                            <span class="tech-badge"><?php echo $tech; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="project-info-card">
                        <h3>Información del Proyecto</h3>
                        <div class="project-info-item">
                            <strong>Categoría:</strong>
                            <span><?php echo $project['category']; ?></span>
                        </div>
                        <div class="project-info-item">
                            <strong>Estado:</strong>
                            <span class="status-badge <?php echo strtolower($project['status']); ?>">
                                <?php echo $project['status']; ?>
                            </span>
                        </div>
                        <?php if (isset($project['date'])): ?>
                        <div class="project-info-item">
                            <strong>Año:</strong>
                            <span><?php echo $project['date']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($project['client'])): ?>
                        <div class="project-info-item">
                            <strong>Cliente:</strong>
                            <span><?php echo $project['client']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($project['duration'])): ?>
                        <div class="project-info-item">
                            <strong>Duración:</strong>
                            <span><?php echo $project['duration']; ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Navegación entre proyectos -->
            <div class="project-navigation">
                <?php if (isset($prevProject)): ?>
                <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/projects/show?id=' . $prevProject['id']; ?>" class="nav-project-link prev">
                    <i class="fas fa-chevron-left"></i>
                    <div class="nav-project-info">
                        <span class="nav-project-label">Proyecto Anterior</span>
                        <span class="nav-project-title"><?php echo $prevProject['title']; ?></span>
                    </div>
                </a>
                <?php else: ?>
                <div class="nav-project-link prev disabled">
                    <i class="fas fa-chevron-left"></i>
                    <div class="nav-project-info">
                        <span class="nav-project-label">Proyecto Anterior</span>
                        <span class="nav-project-title">No hay más proyectos</span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (isset($nextProject)): ?>
                <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/projects/show?id=' . $nextProject['id']; ?>" class="nav-project-link next">
                    <div class="nav-project-info">
                        <span class="nav-project-label">Siguiente Proyecto</span>
                        <span class="nav-project-title"><?php echo $nextProject['title']; ?></span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <?php else: ?>
                <div class="nav-project-link next disabled">
                    <div class="nav-project-info">
                        <span class="nav-project-label">Siguiente Proyecto</span>
                        <span class="nav-project-title">No hay más proyectos</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

