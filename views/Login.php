<?php

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
                return true;
            }
        }

        return false;
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

        $login_usuario->redireccionar("../index.php");

    } else {

        $login_usuario->redireccionar("mensajes/credenciales_incorrectas.php");
    }

} catch (Exception $e) {
    $login_usuario->error($e);
}
?>
