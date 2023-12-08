<?php

class SessionCloseHandler
{
    public static function cerrarSesion()
    {
        session_start();
        
        self::limpiarSesion();
        
        header("Location: ../index.php");
        
        exit();
    }

    private static function limpiarSesion()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }
}

?>
