<section class="projects-section">
    <div class="container">
        <div class="section-header">
            <h1>Mis Proyectos</h1>
            <p class="section-subtitle">Desarrollo de soluciones IoT, hardware y software embebido</p>
        </div>
        
        <!-- Filtros por categoría -->
        <div class="projects-filters">
            <button class="filter-btn <?php echo $selectedCategory === 'all' ? 'active' : ''; ?>" data-category="all">
                Todos
            </button>
            <?php foreach ($categories as $name => $value): ?>
                <?php if ($value !== 'all'): ?>
                <button class="filter-btn <?php echo $selectedCategory === $value ? 'active' : ''; ?>" data-category="<?php echo $value; ?>">
                    <?php echo $name; ?>
                </button>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <!-- Grid de proyectos -->
        <div class="projects-grid" id="projectsGrid">
            <?php if (empty($projects)): ?>
                <div class="no-projects">
                    <i class="fas fa-folder-open"></i>
                    <p>No hay proyectos en esta categoría</p>
                </div>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                <div class="project-card" data-category="<?php echo strtolower($project['category']); ?>">
                    <div class="project-image">
                        <div class="project-image-placeholder">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="project-status <?php echo strtolower($project['status']); ?>">
                            <?php echo $project['status']; ?>
                        </div>
                    </div>
                    <div class="project-content">
                        <div class="project-category">
                            <?php echo $project['category']; ?>
                        </div>
                        <h3><?php echo $project['title']; ?></h3>
                        <p class="project-description"><?php echo $project['description']; ?></p>
                        <div class="project-technologies">
                            <?php foreach (array_slice($project['technologies'], 0, 4) as $tech): ?>
                            <span class="tech-tag"><?php echo $tech; ?></span>
                            <?php endforeach; ?>
                            <?php if (count($project['technologies']) > 4): ?>
                            <span class="tech-tag">+<?php echo count($project['technologies']) - 4; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="project-features">
                            <h4>Características principales:</h4>
                            <ul>
                                <?php foreach (array_slice($project['features'], 0, 3) as $feature): ?>
                                <li><i class="fas fa-check-circle"></i> <?php echo $feature; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a href="<?php 
                            $base = BASE_URL ? BASE_URL : '';
                            $url = ($base ? $base : '') . '/projects/show?id=' . $project['id'];
                            echo $url;
                        ?>" class="btn btn-primary btn-sm">
                            Ver Detalles <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Filtrado de proyectos con JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // Actualizar URL sin recargar
            const url = new URL(window.location);
            if (category === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', category);
            }
            window.history.pushState({}, '', url);
            
            // Actualizar botones activos
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filtrar proyectos
            projectCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
</script>

