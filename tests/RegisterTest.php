<?php

use PHPUnit\Framework\TestCase;

include 'views/php/Register.php';

class RegisterTest extends TestCase
{
    public function testVerificarUsuarioExistente()
    {
        $register = new register();

        $usuarioExistente = 'usuario_true';

        $this->assertTrue($register->verificarUsuarioExistente($usuarioExistente));
    }

    public function testVerificarUsuarioNoExistente()
    {
        $register = new register();

        $usuarioNoExistente = 'usuario_false';

        $this->assertFalse($register->verificarUsuarioExistente($usuarioNoExistente));
    }

    public function testInsertarUsuario()
    {
        $register = new register();

        $usuario = 'usuario1';
        $contrasenia = '1234';
        $email = 'usuario1@gmail.com';

        $this->assertTrue($register->insertarUsuario($usuario, $contrasenia, $email));
    }

}

?>
