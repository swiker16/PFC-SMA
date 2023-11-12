<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de PHP y MySQL</title>
</head>
<body>

<?php
// Incluir el archivo de conexión
include_once 'src/config.php';

$conexion = ConnectDatabase::conectar();

$sql = "SELECT * from peliculas";

$resultado = $conexion->prepare($sql);

$resultado->execute();

if ($resultado->rowCount() == 0) {
    echo "<div class ='container'>";
        echo "No hay ningúna publicacion subida.";
    echo "</div>";
} else {
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo $registro['Titulo'];
    }
}

?>

</body>
</html>
