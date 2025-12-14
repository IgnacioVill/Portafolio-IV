<?php
namespace App\Controllers;

use App\Core\Controller;

class ContactController extends Controller {
    public function index() {
        $data = [
            'title' => 'Contacto - Portafolio Ignacio Villanueva',
            'page' => 'contact'
        ];
        $this->view('contact/index', $data);
    }
    
    public function send() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . (BASE_URL ? BASE_URL : '') . '/contact');
            exit;
        }
        
        // Protección contra spam - honeypot
        if (!empty($_POST['website'])) {
            // Si este campo está lleno, es un bot
            $_SESSION['success'] = 'Mensaje enviado correctamente. Te responderé pronto.';
            header('Location: ' . (BASE_URL ? BASE_URL : '') . '/contact');
            exit;
        }
        
        // Obtener y limpiar datos
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');
        
        // Validación
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'El nombre es requerido.';
        } elseif (strlen($name) < 2) {
            $errors[] = 'El nombre debe tener al menos 2 caracteres.';
        } elseif (strlen($name) > 100) {
            $errors[] = 'El nombre no puede exceder 100 caracteres.';
        }
        
        if (empty($email)) {
            $errors[] = 'El email es requerido.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no es válido.';
        } elseif (strlen($email) > 255) {
            $errors[] = 'El email no puede exceder 255 caracteres.';
        }
        
        if (!empty($phone) && !preg_match('/^[\d\s\-\+\(\)]+$/', $phone)) {
            $errors[] = 'El teléfono contiene caracteres inválidos.';
        }
        
        if (empty($message)) {
            $errors[] = 'El mensaje es requerido.';
        } elseif (strlen($message) < 10) {
            $errors[] = 'El mensaje debe tener al menos 10 caracteres.';
        } elseif (strlen($message) > 2000) {
            $errors[] = 'El mensaje no puede exceder 2000 caracteres.';
        }
        
        if (!empty($subject) && strlen($subject) > 200) {
            $errors[] = 'El asunto no puede exceder 200 caracteres.';
        }
        
        // Si hay errores, mostrarlos
        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            $_SESSION['form_data'] = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'phone' => htmlspecialchars($phone),
                'subject' => htmlspecialchars($subject),
                'message' => htmlspecialchars($message)
            ];
            header('Location: ' . (BASE_URL ? BASE_URL : '') . '/contact');
            exit;
        }
        
        // Preparar el email
        $to = CONTACT_EMAIL;
        $emailSubject = !empty($subject) ? $subject : "Contacto desde Portafolio - " . $name;
        
        // Cuerpo del mensaje en formato HTML
        $body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #2563eb, #10b981); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
                .content { background: #f9fafb; padding: 20px; border-radius: 0 0 8px 8px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #2563eb; }
                .value { margin-top: 5px; }
                .message-box { background: white; padding: 15px; border-left: 4px solid #2563eb; margin-top: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Nuevo Mensaje desde el Portafolio</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Nombre:</div>
                        <div class='value'>" . htmlspecialchars($name) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div class='value'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></div>
                    </div>";
        
        if (!empty($phone)) {
            $body .= "
                    <div class='field'>
                        <div class='label'>Teléfono:</div>
                        <div class='value'><a href='tel:" . htmlspecialchars($phone) . "'>" . htmlspecialchars($phone) . "</a></div>
                    </div>";
        }
        
        if (!empty($subject)) {
            $body .= "
                    <div class='field'>
                        <div class='label'>Asunto:</div>
                        <div class='value'>" . htmlspecialchars($subject) . "</div>
                    </div>";
        }
        
        $body .= "
                    <div class='field'>
                        <div class='label'>Mensaje:</div>
                        <div class='message-box'>" . nl2br(htmlspecialchars($message)) . "</div>
                    </div>
                    <div class='field' style='margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #6b7280;'>
                        <p>Este mensaje fue enviado desde el formulario de contacto del portafolio.</p>
                        <p>Fecha: " . date('d/m/Y H:i:s') . "</p>
                        <p>IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
        
        // Preparar datos para el email
        $emailData = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message
        ];
        
        // Intentar enviar con PHPMailer
        $mailSent = false;
        $errorMessage = '';
        $debugInfo = '';
        
        try {
            // Cargar autoloader de Composer si existe
            if (!file_exists(ROOT . '/vendor/autoload.php')) {
                throw new \Exception('PHPMailer no está instalado. Ejecuta: composer install');
            }
            
            require_once ROOT . '/vendor/autoload.php';
            
            // Verificar si PHPMailer está disponible
            if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                throw new \Exception('PHPMailer no está disponible. Ejecuta: composer install');
            }
            
            $mailer = new \App\Core\Mailer();
            $result = $mailer->sendContactEmail($emailData);
            
            if ($result['success']) {
                $mailSent = true;
                error_log("Email enviado exitosamente a: " . CONTACT_EMAIL);
            } else {
                $errorMessage = $result['message'];
                $debugInfo = isset($result['debug']) ? $result['debug'] : '';
                error_log("Error al enviar email: " . $errorMessage);
                if ($debugInfo) {
                    error_log("Debug info: " . $debugInfo);
                }
            }
            
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            error_log("Error en ContactController: " . $errorMessage);
            error_log("Stack trace: " . $e->getTraceAsString());
        }
        
        // Si PHPMailer falla, intentar guardar en archivo como fallback
        if (!$mailSent) {
            $logDir = ROOT . '/storage/messages';
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }
            
            $filename = $logDir . '/message_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.txt';
            $logContent = "=== MENSAJE DE CONTACTO (FALLBACK) ===\n";
            $logContent .= "Fecha: " . date('d/m/Y H:i:s') . "\n";
            $logContent .= "Nombre: $name\n";
            $logContent .= "Email: $email\n";
            $logContent .= "Teléfono: " . ($phone ?: 'No proporcionado') . "\n";
            $logContent .= "Asunto: " . ($subject ?: 'Sin asunto') . "\n";
            $logContent .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "\n";
            $logContent .= "\n--- Mensaje ---\n$message\n";
            $logContent .= "\nError: $errorMessage\n";
            $logContent .= "\n=== FIN DEL MENSAJE ===\n";
            
            if (@file_put_contents($filename, $logContent)) {
                $mailSent = true;
                error_log("Mensaje guardado como fallback en: $filename");
            }
        }
        
        if ($mailSent) {
            $_SESSION['success'] = '¡Mensaje enviado correctamente! Te responderé a la brevedad.';
            // Limpiar datos del formulario
            unset($_SESSION['form_data']);
        } else {
            $errorMsg = 'Hubo un error al enviar el mensaje. ';
            if (!empty($errorMessage)) {
                $errorMsg .= 'Error: ' . htmlspecialchars($errorMessage) . '. ';
            }
            $errorMsg .= 'Por favor, intenta nuevamente o contáctame directamente a ' . CONTACT_EMAIL;
            
            $_SESSION['error'] = $errorMsg;
            // Mantener los datos del formulario para que el usuario no los pierda
            $_SESSION['form_data'] = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'phone' => htmlspecialchars($phone),
                'subject' => htmlspecialchars($subject),
                'message' => htmlspecialchars($message)
            ];
        }
        
        header('Location: ' . (BASE_URL ? BASE_URL : '') . '/contact');
        exit;
    }
}
?>

