<?php

namespace crmteenus\dao;

use crmteenus\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendEmailDao extends PHPMailer
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function sendEmail($dataEmail, $email, $name)
    {
        require_once dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . '/env.php';

        try {
            $mail = new PHPMailer(true);

            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = $_ENV["smtpHost"];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["smtpEmail"];
            $mail->Password   = $_ENV["smtpPass"];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $_ENV["smtpPort"];

            // Configuración del remitente y destinatario
            $mail->setFrom($email, $name);
            foreach ($dataEmail['to'] as $value) {
                $mail->addAddress($value);
            }

            // Configuración del contenido
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $dataEmail['subject'];
            $mail->Body    = $dataEmail['body'];
            if ($dataEmail['ccHeader'] != null) {
                $mail->addCC($dataEmail['ccHeader']);
            }

            // Enviar correo y seguimiento del estado
            if ($mail->send()) {
                $status = [
                    'status' => 'success',
                    'message' => 'Correo enviado exitosamente.',
                ];
            } else {
                $status = [
                    'status' => 'error',
                    'message' => 'El correo no pudo ser enviado. Error desconocido.',
                ];
            }
        } catch (\Exception $e) {
            // Detalle de error en caso de excepción
            $status = [
                'status' => 'error',
                'message' => 'Error al enviar correo: ' . $e->getMessage(),
            ];
        }

        // Registrar estado en base de datos o log para hacer seguimiento
        // saveEmailLog($email, $status); // Implementa una función para guardar el registro

        return $status;
    }
}
