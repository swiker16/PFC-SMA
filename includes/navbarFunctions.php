<?php
session_start();

function checkUserActivity()
{
    if (isset($_SESSION['tiempo'])) {
        $inactivo = 300; // 300 segundos = 5 minutos (puedes ajustar este valor según tus necesidades)
        $vida_session = time() - $_SESSION['tiempo'];

        if ($vida_session > $inactivo) {
            session_unset();
            session_destroy();
            // Puedes redirigir o manejar la inactividad aquí
        } else {
            $_SESSION['tiempo'] = time();
        }
    } else {
        $_SESSION['tiempo'] = time();
    }
}

function generateNavbar()
{
    checkUserActivity();

    if (!empty($_SESSION["usuario"])) {
        // Usuario autenticado
        include "header_authenticated.php";
    } else {
        // Usuario no autenticado
        include "header_unauthenticated.php";
    }
}
?>
