<?php

class ConnectDatabase{

    public static function conectar()
    {
        try {
            $db_host = "localhost";
            $db_nombre = "u757869769_magiccinema";
            $db_usuario = "u757869769_root";
            $db_pass = "MagicCinema2023*";
            
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
            ];

            $base = new PDO("mysql:host=$db_host;dbname=$db_nombre", $db_usuario, $db_pass, $options);
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $base;

        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

?>
