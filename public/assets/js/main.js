// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            
            // Animate hamburger icon
            const spans = navToggle.querySelectorAll('span');
            if (navMenu.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
        
        // Close menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                const spans = navToggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            });
        });
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.querySelectorAll('.feature-card, .experience-card, .skill-category, .highlight-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Form validation y contador de caracteres
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        const messageTextarea = document.getElementById('message');
        const charCount = document.querySelector('.char-count');
        const submitBtn = document.getElementById('submitBtn');
        
        // Contador de caracteres
        if (messageTextarea && charCount) {
            function updateCharCount() {
                const length = messageTextarea.value.length;
                charCount.textContent = `${length} / 2000 caracteres`;
                
                if (length > 2000) {
                    charCount.style.color = '#ef4444';
                } else if (length > 1800) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#6b7280';
                }
            }
            
            messageTextarea.addEventListener('input', updateCharCount);
            updateCharCount(); // Inicializar contador
        }
        
        // Validación del formulario
        contactForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            
            // Validación básica
            if (!name || !email || !message) {
                e.preventDefault();
                showFormError('Por favor, complete todos los campos requeridos.');
                return false;
            }
            
            // Validación de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                showFormError('Por favor, ingrese un email válido.');
                return false;
            }
            
            // Validación de longitud
            if (name.length < 2) {
                e.preventDefault();
                showFormError('El nombre debe tener al menos 2 caracteres.');
                return false;
            }
            
            if (message.length < 10) {
                e.preventDefault();
                showFormError('El mensaje debe tener al menos 10 caracteres.');
                return false;
            }
            
            if (message.length > 2000) {
                e.preventDefault();
                showFormError('El mensaje no puede exceder 2000 caracteres.');
                return false;
            }
            
            // Deshabilitar botón durante el envío
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalText = submitBtn.querySelector('span').textContent;
                submitBtn.querySelector('span').textContent = 'Enviando...';
                submitBtn.style.opacity = '0.7';
                
                // Re-habilitar después de 5 segundos por si hay un error
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.querySelector('span').textContent = originalText;
                    submitBtn.style.opacity = '1';
                }, 5000);
            }
        });
        
        function showFormError(message) {
            // Crear o actualizar mensaje de error
            let errorDiv = document.querySelector('.form-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-error form-error';
                contactForm.insertBefore(errorDiv, contactForm.firstChild);
            }
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + message;
            
            // Scroll al error
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Remover después de 5 segundos
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.remove();
                }
            }, 5000);
        }
    }
});

