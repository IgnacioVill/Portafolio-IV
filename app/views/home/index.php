<?php
// Los datos deben ser pasados desde el controlador
$model = new App\Models\PortfolioModel();
$personalInfo = $model->getPersonalInfo();
?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Hola, soy <span class="highlight"><?php echo $personalInfo['name']; ?></span>
                </h1>
                <h2 class="hero-subtitle"><?php echo $personalInfo['title']; ?></h2>
                <p class="hero-description"><?php echo $personalInfo['specialization']; ?></p>
                <div class="hero-buttons">
                    <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/about'; ?>" class="btn btn-primary">Conoce más</a>
                    <a href="<?php echo (BASE_URL ? BASE_URL : '') . '/contact'; ?>" class="btn btn-secondary">Contacto</a>
                </div>
                <div class="hero-social">
                    <a href="mailto:<?php echo $personalInfo['email']; ?>" class="social-link" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="tel:<?php echo $personalInfo['phone']; ?>" class="social-link" title="Teléfono">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <div class="profile-card">
                    <div class="profile-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <div class="profile-info">
                        <h3><?php echo $personalInfo['name']; ?></h3>
                        <p><?php echo $personalInfo['title']; ?></p>
                        <div class="profile-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $personalInfo['location']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="section-header">
            <h2>Áreas de Especialización</h2>
            <p>Desarrollo integral de soluciones IoT y sistemas embebidos</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-microchip"></i>
                </div>
                <h3>Hardware & Firmware</h3>
                <p>Diseño de PCB y desarrollo de firmware para microcontroladores</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h3>IoT & Sensores</h3>
                <p>Desarrollo de sistemas IoT con sensores de inclinación, vibración y presión</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-code"></i>
                </div>
                <h3>Full Stack</h3>
                <p>Desarrollo completo desde backend hasta frontend para sistemas embebidos</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Calibración</h3>
                <p>Diseño e implementación de equipos para calibración de sensores</p>
            </div>
        </div>
    </div>
</section>

<section class="quick-stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">3+</div>
                <div class="stat-label">Años de Experiencia</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">IoT</div>
                <div class="stat-label">Especialización</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">Full Stack</div>
                <div class="stat-label">Desarrollo</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">I+D</div>
                <div class="stat-label">Investigación</div>
            </div>
        </div>
    </div>
</section>

