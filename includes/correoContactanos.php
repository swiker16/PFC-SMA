<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar la biblioteca PHPMailer
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST["to"];
    $asunto = $_POST["subject"];
    $mensaje = $_POST["body"];

    // Validar los datos (puedes agregar más validaciones según tus necesidades)

    // Procesar los datos y enviar el correo
    $destinatario = "tucorreo@example.com"; // Reemplaza con tu dirección de correo electrónico

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurar el servidor de correo
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Reemplaza con la dirección de tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'ikerfrancos008@gmail.com'; // Reemplaza con tu correo electrónico SMTP
        $mail->Password = 'IkerFrancos16*'; // Reemplaza con tu contraseña SMTP
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configurar el remitente, destinatario, asunto y cuerpo del correo
        $mail->setFrom($correo);
        $mail->addAddress($destinatario);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        // Enviar el correo
        $mail->send();

        // Redirigir al usuario a una página de agradecimiento o mostrar un mensaje de éxito
        header("Location: ../views/peliculpa.php");
        exit();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
