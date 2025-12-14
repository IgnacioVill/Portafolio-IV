<?php
$model = new App\Models\PortfolioModel();
$skills = $model->getSkills();
?>

<section class="skills-section">
    <div class="container">
        <div class="section-header">
            <h1>Habilidades Técnicas</h1>
            <p class="section-subtitle">Tecnologías y herramientas que domino</p>
        </div>
        
        <div class="skills-container">
            <?php foreach ($skills as $category => $items): ?>
            <div class="skill-category">
                <div class="category-header">
                    <h2><?php echo $category; ?></h2>
                </div>
                <div class="skills-grid">
                    <?php foreach ($items as $skill): ?>
                    <div class="skill-item">
                        <div class="skill-icon">
                            <?php
                            $icons = [
                                'C/C++' => 'fa-code',
                                'Arduino' => 'fa-microchip',
                                'Espressif' => 'fa-wifi',
                                'Microchip' => 'fa-microchip',
                                'STM32' => 'fa-microchip',
                                'Eagle' => 'fa-drafting-compass',
                                'Laravel' => 'fa-laravel',
                                'PHP' => 'fa-php',
                                'MySQL' => 'fa-database',
                                'React' => 'fa-react',
                                'HTML' => 'fa-html5',
                                'CSS' => 'fa-css3-alt',
                                'MQTT' => 'fa-network-wired',
                                'FlutterFlow' => 'fa-mobile-alt',
                                'Siemens' => 'fa-industry',
                                'AutoCAD' => 'fa-drafting-compass'
                            ];
                            $icon = 'fa-code';
                            foreach ($icons as $key => $val) {
                                if (stripos($skill, $key) !== false) {
                                    $icon = $val;
                                    break;
                                }
                            }
                            ?>
                            <i class="fab <?php echo $icon; ?>"></i>
                        </div>
                        <span class="skill-name"><?php echo $skill; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="skills-summary">
            <div class="summary-card">
                <h3>Resumen de Competencias</h3>
                <div class="summary-content">
                    <div class="summary-item">
                        <i class="fas fa-layer-group"></i>
                        <div>
                            <strong>Stack Completo</strong>
                            <p>Desde hardware hasta frontend</p>
                        </div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-cogs"></i>
                        <div>
                            <strong>Sistemas Embebidos</strong>
                            <p>Microcontroladores y firmware</p>
                        </div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-cloud"></i>
                        <div>
                            <strong>IoT & Cloud</strong>
                            <p>MQTT y comunicación en tiempo real</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

