<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class EmailHandler
{
    public static function enviarCorreo($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->CharSet = 'utf-8';
            $mail->isMail();
            $mail->UseSendmailOptions = 0;
            $mail->setFrom("iker.francos@magiccinema.es", "Iker");
            $mail->Subject = $subject;
            $mail->addAddress($to);
            $mail->msgHTML($body);

            $send = $mail->send();

            if (!$send) {

                return $mail->ErrorInfo;

            } else {

                return "ok";
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];

    $result = EmailHandler::enviarCorreo($to, $subject, $body);

    if ($result === true) {

        echo "El correo electrónico se envió correctamente.";

    } else {
        
        echo "Error al enviar el correo electrónico: $result";
    }
}

?>
