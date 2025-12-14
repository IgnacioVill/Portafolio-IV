<?php
$model = new App\Models\PortfolioModel();
$personalInfo = $model->getPersonalInfo();
?>

<section class="contact-section">
    <div class="container">
        <div class="section-header">
            <h1>Contacto</h1>
            <p class="section-subtitle">¿Tienes un proyecto en mente? Hablemos</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <div class="info-card-large">
                    <h2>Información de Contacto</h2>
                    <p>Estoy disponible para proyectos de desarrollo IoT, sistemas embebidos y soluciones tecnológicas innovadoras.</p>
                    
                    <div class="contact-items">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <a href="mailto:<?php echo $personalInfo['email']; ?>"><?php echo $personalInfo['email']; ?></a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Teléfono</h3>
                                <a href="tel:<?php echo $personalInfo['phone']; ?>"><?php echo $personalInfo['phone']; ?></a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Ubicación</h3>
                                <p><?php echo $personalInfo['location']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <div class="form-card">
                    <h2>Envíame un Mensaje</h2>
                    
                    <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo (BASE_URL ? BASE_URL : '') . '/contact/send'; ?>" method="POST" class="contact-form" id="contactForm">
                        <!-- Honeypot para protección contra spam -->
                        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="name">Nombre *</label>
                            <input type="text" id="name" name="name" 
                                   value="<?php echo isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : ''; ?>" 
                                   required 
                                   minlength="2" 
                                   maxlength="100"
                                   placeholder="Tu nombre completo">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" 
                                   value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>" 
                                   required 
                                   maxlength="255"
                                   placeholder="tu@email.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" id="phone" name="phone" 
                                   value="<?php echo isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : ''; ?>" 
                                   maxlength="50"
                                   placeholder="+54 9 261 1234567">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <input type="text" id="subject" name="subject" 
                                   value="<?php echo isset($_SESSION['form_data']['subject']) ? $_SESSION['form_data']['subject'] : ''; ?>" 
                                   maxlength="200"
                                   placeholder="¿Sobre qué quieres hablar?">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensaje *</label>
                            <textarea id="message" name="message" rows="6" 
                                      required 
                                      minlength="10" 
                                      maxlength="2000"
                                      placeholder="Escribe tu mensaje aquí..."><?php echo isset($_SESSION['form_data']['message']) ? $_SESSION['form_data']['message'] : ''; ?></textarea>
                            <small class="char-count">0 / 2000 caracteres</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                            <i class="fas fa-paper-plane"></i>
                            <span>Enviar Mensaje</span>
                        </button>
                    </form>
                    
                    <?php 
                    // Limpiar datos del formulario después de mostrarlos
                    if (isset($_SESSION['form_data']) && isset($_SESSION['success'])) {
                        unset($_SESSION['form_data']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

