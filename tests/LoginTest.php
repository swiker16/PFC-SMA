<?php

use PHPUnit\Framework\TestCase;

include 'views/Login.php';

class LoginTest extends TestCase
{
    public function testVerificarCredencialesCorrectas()
    {
        $login = new login();

        $usuarioCorrecto = 'usuario1_true';
        $contraseniaCorrecta = '1234_true';

        $this->assertTrue($login->verificarCredenciales($usuarioCorrecto, $contraseniaCorrecta));
    }

    public function testVerificarCredencialesIncorrectas()
    {
        $login = new login();

        $usuarioIncorrecto = 'usuario2_false';
        $contraseniaIncorrecta = '12345_false';

        $this->assertFalse($login->verificarCredenciales($usuarioIncorrecto, $contraseniaIncorrecta));
    }

}

?>
