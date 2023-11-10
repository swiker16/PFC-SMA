<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo con Parámetros en PHP</title>
</head>
<body>
    <h1>Mensaje Personalizado en PHP</h1>

    <?php
    // Verificar si se proporcionó el parámetro "nombre" en la URL
    if (isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
        // Mostrar un mensaje personalizado
        echo "<p>Hola, $nombre. ¡Bienvenido al sitio!</p>";
    } else {
        // Si no se proporcionó el parámetro "nombre", mostrar un mensaje genérico
        echo "<p>Bienvenido al sitio. Por favor, proporciona tu nombre en la URL para un mensaje personalizado.</p>";
    }
    ?>
</body>
</html>