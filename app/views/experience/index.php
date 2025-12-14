<?php
$model = new App\Models\PortfolioModel();
$experience = $model->getExperience();
?>

<section class="experience-section">
    <div class="container">
        <div class="section-header">
            <h1>Experiencia Profesional</h1>
            <p class="section-subtitle">Trayectoria y logros en el desarrollo de tecnología IoT</p>
        </div>
        
        <div class="experience-timeline">
            <?php foreach ($experience as $exp): ?>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <div class="experience-card">
                        <div class="experience-header">
                            <div class="experience-title">
                                <h2><?php echo $exp['position']; ?></h2>
                                <h3><?php echo $exp['company']; ?></h3>
                            </div>
                            <div class="experience-period">
                                <i class="fas fa-calendar-alt"></i>
                                <span><?php echo $exp['period']; ?></span>
                            </div>
                        </div>
                        <div class="experience-body">
                            <ul class="experience-list">
                                <?php foreach ($exp['description'] as $desc): ?>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <span><?php echo $desc; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="experience-tags">
                            <span class="tag">Hardware</span>
                            <span class="tag">Firmware</span>
                            <span class="tag">IoT</span>
                            <span class="tag">Full Stack</span>
                            <span class="tag">I+D</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="experience-highlights">
            <h2>Logros Destacados</h2>
            <div class="highlights-grid">
                <div class="highlight-card">
                    <i class="fas fa-microchip"></i>
                    <h3>Desarrollo de Sensores</h3>
                    <p>Creación de sensores de inclinación, vibración y presión para flotas de transporte</p>
                </div>
                <div class="highlight-card">
                    <i class="fas fa-tools"></i>
                    <h3>Equipos de Calibración</h3>
                    <p>Diseño y puesta en marcha de equipos para calibración de diversos tipos de sensores</p>
                </div>
                <div class="highlight-card">
                    <i class="fas fa-code"></i>
                    <h3>Desarrollo Full Stack</h3>
                    <p>Implementación de soluciones completas para sistemas embebidos</p>
                </div>
            </div>
        </div>
    </div>
</section>

