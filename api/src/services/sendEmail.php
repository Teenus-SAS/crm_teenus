<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($emailEnvio, $passwordTemp)
{

    require 'vendor/autoload.php';
    require_once dirname(__DIR__) . "/env.php";

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = $_ENV["smtpHost"];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV["smtpEmail"];
        $mail->Password   = $_ENV["smtpPass"];
        $mail->SMTPSecure = 'tls';
        $mail->Port       = $_ENV["smtpPort"];

        $mail->setFrom($_ENV["smtpEmail"]);
        $mail->addAddress($emailEnvio);

        $mail->isHTML(true);
        $mail->Subject = 'Recordar password';
        $mail->Body    = "Recientemente solicitaste recordar tu password por lo que, para mayor seguridad te enviamos el siguiente password temporal '$passwordTemp'
                          con el que puedes ingresar a la plataforma. Te recomendamos cambiar la contraseña tan pronto ingreses.     
                          Puedes estar tranquilo que es seguro. Las contraseñas generadas a través de la plataforma solo se envían al correo electrónico del contacto 
                          de la cuenta.
        Saludos,
        teenus";

        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Email no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
    }
}
