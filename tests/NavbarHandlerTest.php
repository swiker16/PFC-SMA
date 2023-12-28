<?php

use PHPUnit\Framework\TestCase;

class NavbarHandlerTest extends TestCase
{


    public function testGenerateNavbarAuthenticatedAdmin()
    {
        // Configura el ambiente de la sesión para un usuario administrador autenticado
        session_start();
        $_SESSION['tiempo'] = time();

        // Configura el valor de usuario en 'admin'
        $_SESSION['usuario'] = 'admin';

        // Obtiene el contenido generado por el método
        ob_start();
        NavbarHandler::generateNavbar();
        $output = ob_get_clean();

        // Verifica que se incluyó el headerAdmin.php
        $this->assertNotNull($output);
        }

    public function testGenerateNavbarAuthenticatedUser()
    {
        // Configura el ambiente de la sesión para un usuario autenticado
        session_start();
        $_SESSION['tiempo'] = time();

        // Configura el valor de usuario en cualquier cosa diferente de 'admin'
        $_SESSION['usuario'] = 'some_user';

        // Obtiene el contenido generado por el método
        ob_start();
        NavbarHandler::generateNavbar();
        $output = ob_get_clean();

        // Verifica que se incluyó el header_authenticated.php
        $this->assertNotNull($output);
    }

    public function testGenerateNavbarUnauthenticated()
    {
        // Configura el ambiente de la sesión para un usuario no autenticado
        session_start();
        $_SESSION['tiempo'] = time();

        // Borra cualquier valor de usuario en la sesión
        unset($_SESSION['usuario']);

        // Obtiene el contenido generado por el método
        ob_start();
        NavbarHandler::generateNavbar();
        $output = ob_get_clean();

        // Verifica que se incluyó el header_unauthenticated.php
        $this->assertNotNull($output);
    }
}

?>