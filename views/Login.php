<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
class login
{
    private $conexion;

    public function __construct()
    {
        include_once "../includes/config.php";
        $this->conexion = ConnectDatabase::conectar();
    }

    public function verificarCredenciales($usuario, $contrasenia)
    {
        $sql = "SELECT * FROM usuarios WHERE (Nombre_usuario = :user OR Correo_electronico = :user)";
        $resultado = $this->conexion->prepare($sql);

        $usuario = htmlentities(addslashes(trim($usuario)));
        $resultado->bindValue(":user", $usuario, PDO::PARAM_STR);
        $resultado->execute();

        if ($resultado->rowCount() == 1) {
            $usuarioData = $resultado->fetch(PDO::FETCH_ASSOC);

            if (password_verify($contrasenia, $usuarioData['Contrasena'])) {
                session_start();
                $_SESSION["Usuario_ID"] = $usuarioData['Usuario_ID'];
                $_SESSION["usuario"] = $usuarioData['Nombre_usuario'];

                // Genera un código alfanumérico
                $verificationCode = substr(md5(uniqid(mt_rand(), true)), 0, 6);

                // Define la marca de tiempo de expiración (1 minuto desde ahora)
                $expirationTime = time() + 60;

                // Inserta el código en la tabla check_codes
                $insertSql = "INSERT INTO check_codes (usuarios_id, code, expiration_time) VALUES (:userID, :code, :expiration)";
                $insertStatement = $this->conexion->prepare($insertSql);
                $insertStatement->bindValue(":userID", $usuarioData['Usuario_ID'], PDO::PARAM_INT);
                $insertStatement->bindValue(":code", $verificationCode, PDO::PARAM_STR);
                $insertStatement->bindValue(":expiration", date('Y-m-d H:i:s', $expirationTime), PDO::PARAM_STR);
                $insertStatement->execute();

                $this->enviarCorreoConfirmacion($usuarioData['Correo_electronico'], $verificationCode);

                header("location: authentication.php?userID=" . $usuarioData['Usuario_ID']);
                return true;
            }
        }

        return false;
    }
    public function enviarCorreoConfirmacion($email, $verificationCode)
    {
        // Configuración de PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@magiccinema.es';
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('no-reply@magiccinema.es', 'no-reply@magiccinema.es');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Codigo de verificación';
            $mail->Body = 'Tu código de verificación es: ' . $verificationCode;

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo de verificación: {$mail->ErrorInfo}";
        }
    }
    public function redireccionar($ruta)
    {
        header("location: $ruta");
        exit;
    }

    public function error($e)
    {
        echo "Línea del error: " . $e->getLine();
    }

    public function __destruct()
    {
        if ($this->conexion) {
            $this->conexion = null;
        }
    }
}

try {
    $login_usuario = new login();

    $usuario_input = $_POST["user"];
    $contrasenia_input = $_POST["password"];

    if ($login_usuario->verificarCredenciales($usuario_input, $contrasenia_input)) {

        // $login_usuario->redireccionar("../index.php");
    } else {

        $login_usuario->redireccionar("mensajes/credenciales_incorrectas.php");
    }
} catch (Exception $e) {
    $login_usuario->error($e);
}
