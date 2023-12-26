<?php
class NavbarHandler
{
    public static function checkUserActivity()
    {
        session_start();

        if (isset($_SESSION['tiempo'])) {
            $inactivo = 300; 
            $vida_session = time() - $_SESSION['tiempo'];

            if ($vida_session > $inactivo) {
                self::destroySession();
                header("Location: ../index.php");
                exit();
            } else {
                $_SESSION['tiempo'] = time();
            }
        } else {
            $_SESSION['tiempo'] = time();
        }
    }

    public static function generateNavbar()
    {
        self::checkUserActivity();

        if (!empty($_SESSION["usuario"])) {
            if ($_SESSION["usuario"] === 'admin') {
                include "headerAdmin.php";
            } else {
                include "header_authenticated.php";
            }
        } else {
            include "header_unauthenticated.php";
        }
    }

    private static function destroySession()
    {
        session_unset();
        session_destroy();
    }
}
