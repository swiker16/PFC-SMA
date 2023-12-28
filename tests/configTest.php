<?php

use PHPUnit\Framework\TestCase;

class configTest extends TestCase
{
    public function testConectar()
    {
        // Configura los datos de la base de datos para el entorno de prueba
        $db_host = "172.19.0.3";
        $db_nombre = "magiccinema";
        $db_usuario = "root";
        $db_pass = "root";

        // Configura la conexión a la base de datos usando los datos de prueba
        $base =  ConnectDatabase::conectar("mysql:host=$db_host;dbname=$db_nombre", $db_usuario, $db_pass);

        // Verifica que la conexión no sea nula
        $this->assertNull($base);

    }
}
?>