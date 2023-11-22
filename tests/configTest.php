<?php

use PHPUnit\Framework\TestCase;
include 'includes/config.php';


class ConfigTest extends TestCase
{


    public function testErrorDeConexion()
    {
        // Simular un escenario de error de conexión
        // Puedes hacerlo configurando mal las credenciales, por ejemplo
        $db_host = "localhost";
        $db_nombre = "base_de_datos_inexistente";
        $db_usuario = "usuario_inexistente";
        $db_pass = "contraseña_inexistente";

        // Sobrescribir las variables de entorno para simular un fallo
        putenv("DB_HOST=$db_host");
        putenv("DB_NAME=$db_nombre");
        putenv("DB_USER=$db_usuario");
        putenv("DB_PASS=$db_pass");

        $base = ConnectDatabase::conectar();

        // Verificar que la conexión sea nula
        $this->assertNull($base);
    }
}

?>
