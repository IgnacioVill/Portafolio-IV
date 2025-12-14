<?php
namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;
    
    public function __construct() {
        // Cargar autoloader de Composer
        if (file_exists(ROOT . '/vendor/autoload.php')) {
            require_once ROOT . '/vendor/autoload.php';
        }
        
        $this->mail = new PHPMailer(true);
        
        // Habilitar debug si está configurado
        $debugLevel = defined('SMTP_DEBUG') && SMTP_DEBUG ? 2 : 0;
        $this->mail->SMTPDebug = $debugLevel; // 0 = off, 1 = client, 2 = client and server
        $this->mail->Debugoutput = function($str, $level) {
            error_log("PHPMailer Debug: $str");
        };
        
        // Configuración del servidor SMTP
        if (SMTP_ENABLED) {
            $this->mail->isSMTP();
            $this->mail->Host = SMTP_HOST;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = SMTP_USERNAME;
            $this->mail->Password = SMTP_PASSWORD;
            $this->mail->SMTPSecure = SMTP_SECURE;
            $this->mail->Port = SMTP_PORT;
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Encoding = 'base64';
        } else {
            // Fallback a mail() de PHP
            $this->mail->isMail();
        }
        
        // Configuración del remitente
        $this->mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    }
    
    /**
     * Enviar email de contacto
     */
    public function sendContactEmail($data) {
        try {
            // Limpiar destinatarios anteriores
            $this->mail->clearAddresses();
            $this->mail->clearReplyTos();
            
            // Destinatario
            $this->mail->addAddress(CONTACT_EMAIL, 'Ignacio Villanueva');
            
            // Reply-To
            $this->mail->addReplyTo($data['email'], $data['name']);
            
            // Contenido
            $this->mail->isHTML(true);
            $this->mail->Subject = !empty($data['subject']) ? $data['subject'] : 'Contacto desde Portafolio - ' . $data['name'];
            
            // Cuerpo del mensaje HTML
            $this->mail->Body = $this->getContactEmailBody($data);
            
            // Versión texto plano
            $this->mail->AltBody = $this->getContactEmailPlainText($data);
            
            // Enviar
            $this->mail->send();
            
            return [
                'success' => true,
                'message' => 'Mensaje enviado correctamente'
            ];
            
        } catch (Exception $e) {
            $errorInfo = $this->mail->ErrorInfo;
            error_log("Error PHPMailer: " . $errorInfo);
            error_log("Exception: " . $e->getMessage());
            
            // Mensaje de error más amigable
            $errorMessage = 'Error al enviar el mensaje. ';
            
            // Mensajes específicos según el error
            if (strpos($errorInfo, 'SMTP connect() failed') !== false) {
                $errorMessage .= 'No se pudo conectar al servidor SMTP. Verifica la configuración.';
            } elseif (strpos($errorInfo, 'Authentication failed') !== false) {
                $errorMessage .= 'Error de autenticación. Verifica usuario y contraseña.';
            } elseif (strpos($errorInfo, 'Invalid address') !== false) {
                $errorMessage .= 'Dirección de email inválida.';
            } else {
                $errorMessage .= 'Detalles: ' . $errorInfo;
            }
            
            return [
                'success' => false,
                'message' => $errorMessage,
                'debug' => $errorInfo
            ];
        }
    }
    
    /**
     * Generar cuerpo HTML del email
     */
    private function getContactEmailBody($data) {
        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #333; 
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
                .container { 
                    max-width: 600px; 
                    margin: 20px auto; 
                    background: white;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .header { 
                    background: linear-gradient(135deg, #2563eb, #10b981); 
                    color: white; 
                    padding: 30px 20px; 
                    text-align: center;
                }
                .header h2 {
                    margin: 0;
                    font-size: 24px;
                }
                .content { 
                    padding: 30px; 
                }
                .field { 
                    margin-bottom: 20px; 
                    padding-bottom: 15px;
                    border-bottom: 1px solid #e5e7eb;
                }
                .field:last-child {
                    border-bottom: none;
                }
                .label { 
                    font-weight: bold; 
                    color: #2563eb; 
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 8px;
                }
                .value { 
                    margin-top: 5px; 
                    font-size: 16px;
                    color: #1f2937;
                }
                .value a {
                    color: #2563eb;
                    text-decoration: none;
                }
                .value a:hover {
                    text-decoration: underline;
                }
                .message-box { 
                    background: #f9fafb; 
                    padding: 20px; 
                    border-left: 4px solid #2563eb; 
                    margin-top: 10px;
                    border-radius: 4px;
                    white-space: pre-wrap;
                    font-size: 15px;
                    line-height: 1.8;
                }
                .footer {
                    background: #f9fafb;
                    padding: 20px;
                    text-align: center;
                    font-size: 12px;
                    color: #6b7280;
                    border-top: 1px solid #e5e7eb;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📧 Nuevo Mensaje desde el Portafolio</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Nombre</div>
                        <div class='value'>" . htmlspecialchars($data['name']) . "</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email</div>
                        <div class='value'><a href='mailto:" . htmlspecialchars($data['email']) . "'>" . htmlspecialchars($data['email']) . "</a></div>
                    </div>";
        
        if (!empty($data['phone'])) {
            $html .= "
                    <div class='field'>
                        <div class='label'>Teléfono</div>
                        <div class='value'><a href='tel:" . htmlspecialchars($data['phone']) . "'>" . htmlspecialchars($data['phone']) . "</a></div>
                    </div>";
        }
        
        if (!empty($data['subject'])) {
            $html .= "
                    <div class='field'>
                        <div class='label'>Asunto</div>
                        <div class='value'>" . htmlspecialchars($data['subject']) . "</div>
                    </div>";
        }
        
        $html .= "
                    <div class='field'>
                        <div class='label'>Mensaje</div>
                        <div class='message-box'>" . nl2br(htmlspecialchars($data['message'])) . "</div>
                    </div>
                </div>
                <div class='footer'>
                    <p>Este mensaje fue enviado desde el formulario de contacto del portafolio.</p>
                    <p>Fecha: " . date('d/m/Y H:i:s') . " | IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        return $html;
    }
    
    /**
     * Generar versión texto plano del email
     */
    private function getContactEmailPlainText($data) {
        $text = "NUEVO MENSAJE DESDE EL PORTAFOLIO\n";
        $text .= "================================\n\n";
        $text .= "Nombre: " . $data['name'] . "\n";
        $text .= "Email: " . $data['email'] . "\n";
        
        if (!empty($data['phone'])) {
            $text .= "Teléfono: " . $data['phone'] . "\n";
        }
        
        if (!empty($data['subject'])) {
            $text .= "Asunto: " . $data['subject'] . "\n";
        }
        
        $text .= "\nMensaje:\n";
        $text .= str_repeat("-", 40) . "\n";
        $text .= $data['message'] . "\n";
        $text .= str_repeat("-", 40) . "\n\n";
        $text .= "Fecha: " . date('d/m/Y H:i:s') . "\n";
        $text .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "\n";
        
        return $text;
    }
}
?>

