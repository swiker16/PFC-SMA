<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Register
{
    private $conexion;

    public function __construct()
    {
        include_once "../includes/config.php";
        $this->conexion = ConnectDatabase::conectar();
    }

    public function verificarUsuarioExistente($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE Nombre_usuario = :user";
        $resultado = $this->conexion->prepare($sql);

        $usuario = htmlentities(addslashes(trim($usuario)));
        $resultado->bindValue(":user", $usuario, PDO::PARAM_STR);
        $resultado->execute();

        return $resultado->rowCount() == 1;
    }

    public function insertarUsuario($name, $lastname, $usuario, $contrasenia, $email)
    {
        $pass_cifrado = password_hash($contrasenia, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellidos, Nombre_usuario, Contrasena, Correo_electronico) VALUES (:nombre, :lastname, :user, :password, :email)";
        $resultado = $this->conexion->prepare($sql);


        $resultado->execute(array(":nombre" => $name, ":lastname" => $lastname, ":user" => $usuario, ":password" => $pass_cifrado, ":email" => $email));
        if ($resultado->rowCount() > 0) {
            // Si la inserción fue exitosa, envía el correo electrónico de confirmación
            $this->enviarCorreoConfirmacion($email);
        }
        return $resultado->rowCount() > 0;
    }

    public function enviarCorreoConfirmacion($email)
    {
        // Configuración de PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@magiccinema.es';
            $mail->Password = 'MagicCinema2023*';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('no-reply@magiccinema.es', 'no-reply@magiccinema.es');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Confirmación de Registro';
            $mail->Body = 'Gracias por registrarte en nuestro sitio. Tu cuenta ha sido creada con éxito.';

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo de confirmación: {$mail->ErrorInfo}";
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
        echo  "<p>" . $e->getMessage() . "</p>";
    }

    public function __destruct()
    {
        if ($this->conexion) {
            $this->conexion = null;
        }
    }
}

try {
    $registro_usuario = new register();
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $usuario_input = $_POST["user"];
    $contrasenia_input = $_POST["password"];
    $email_input = $_POST["email"];


    if ($registro_usuario->verificarUsuarioExistente($usuario_input)) {

        $registro_usuario->redireccionar("mensajes/usuario_existe.php");
    } else {

        $registro_usuario->insertarUsuario($name, $lastname, $usuario_input, $contrasenia_input, $email_input);
        $registro_usuario->redireccionar("html/FormLogin.html");
    }
} catch (Exception $e) {
    $registro_usuario->error($e);
}
