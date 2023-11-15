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
include_once 'includes/config.php';

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
    <form action="includes/insertar_pelicula.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>

        <label for="director">Director:</label>
        <input type="text" name="director" required><br>

        <label for="descripcion">descripcion:</label>
        <input type="text" name="descripcion" required><br>

        <label for="genero">genero:</label>
        <input type="text" name="genero" required><br>

        <label for="duracion">duracion:</label>
        <input type="text" name="duracion" required><br>

        <label for="clas">clas:</label>
        <input type="text" name="clas" required><br>

        <label for="fecha">datw:</label>
        <input type="date" name="fecha" required><br>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required><br>

        <input type="submit" value="Insertar Película">
    </form>
</body>
</html>
