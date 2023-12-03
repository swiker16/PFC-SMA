<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];
}
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';
    $mail->isMail();
    $mail->UseSendmailOptions = 0;
    $mail->setFrom("iker.francos@magiccinema.es", "Iker");
    $mail->Subject = $subject;
    $mail->addAddress($email);
    $mail->msgHTML($message);
    $send = $mail->send();
    
    if(!$send){
        return $mail->ErrorInfo;
    }else{
        return "ok";
    } 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}