<?php
$model = new App\Models\PortfolioModel();
$personalInfo = $model->getPersonalInfo();
$competencies = $model->getCompetencies();
$education = $model->getEducation();
?>

<section class="about-section">
    <div class="container">
        <div class="section-header">
            <h1>Sobre Mí</h1>
            <p class="section-subtitle">Conoce más sobre mi trayectoria profesional</p>
        </div>
        
        <div class="about-content">
            <div class="about-main">
                <div class="about-card">
                    <h2>Perfil Profesional</h2>
                    <p class="lead">Soy <strong><?php echo $personalInfo['name']; ?></strong>, <?php echo strtolower($personalInfo['title']); ?> con especialización en desarrollo IoT (Internet de las cosas).</p>
                    <p>Mi pasión se centra en el desarrollo de soluciones tecnológicas innovadoras que combinan hardware, firmware y software para crear sistemas embebidos inteligentes. Trabajo en el diseño e implementación de sensores, sistemas de comunicación IoT y desarrollo full stack para aplicaciones embebidas.</p>
                </div>
                
                <div class="about-card">
                    <h2>Educación</h2>
                    <?php foreach ($education as $edu): ?>
                    <div class="education-item">
                        <div class="education-header">
                            <h3><?php echo $edu['degree']; ?></h3>
                            <span class="education-period"><?php echo $edu['period']; ?></span>
                        </div>
                        <p class="education-institution"><?php echo $edu['institution']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="about-sidebar">
                <div class="info-card">
                    <h3>Información Personal</h3>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span><?php echo $personalInfo['email']; ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span><?php echo $personalInfo['phone']; ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo $personalInfo['location']; ?></span>
                    </div>
                </div>
                
                <div class="info-card">
                    <h3>Idiomas</h3>
                    <?php foreach ($personalInfo['languages'] as $lang): ?>
                    <div class="language-item">
                        <span class="language-name"><?php echo $lang['name']; ?></span>
                        <span class="language-level"><?php echo $lang['level']; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="competencies-section">
            <h2>Competencias</h2>
            <div class="competencies-grid">
                <?php foreach ($competencies as $competency): ?>
                <div class="competency-badge">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo $competency; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

