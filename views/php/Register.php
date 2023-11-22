<?php

class Register
{
    private $conexion;

    public function __construct()
    {
        include_once "../../includes/config.php";
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

    public function insertarUsuario($usuario, $contrasenia, $email)
    {
        $pass_cifrado = password_hash($contrasenia, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (Nombre_usuario, Contrasena, Correo_electronico) VALUES (:user, :password, :email)";
        $resultado = $this->conexion->prepare($sql);

        $resultado->execute(array(":user" => $usuario, ":password" => $pass_cifrado, ":email" => $email));

        return $resultado->rowCount() > 0;
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
    $registro_usuario = new register();

    $usuario_input = $_POST["user"];
    $contrasenia_input = $_POST["password"];
    $email_input = $_POST["email"];

    if ($registro_usuario->verificarUsuarioExistente($usuario_input)) {

        $registro_usuario->redireccionar("mensajes/usuario_existe.php");

    } else {

        $registro_usuario->insertarUsuario($usuario_input, $contrasenia_input, $email_input);
        $registro_usuario->redireccionar("../../index.php");
    }

} catch (Exception $e) {
    $registro_usuario->error($e);
}
?>
