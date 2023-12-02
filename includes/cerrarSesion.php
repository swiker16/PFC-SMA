<?php
// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, borra la cookie de la sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión o a donde desees
header("Location: ../index.php");
exit();
?>
