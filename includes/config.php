<?php

class ConnectDatabase{

    public static function conectar()
    {
        try {
            $db_host = "172.19.0.3";
            $db_nombre = "magiccinema";
            $db_usuario = "root";
            $db_pass = "root";

            $base = new PDO("mysql:host=$db_host;dbname=$db_nombre", $db_usuario, $db_pass);
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $base;

        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

?>
