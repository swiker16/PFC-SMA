<?php
include_once 'config.php'; // Ajusta la ruta según tu estructura de archivos

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['q'])) {
    $busqueda = $_GET['q'];
    
    $conexion = ConnectDatabase::conectar();

    // Utiliza sentencias preparadas para evitar inyección de SQL
    $sql = "SELECT * FROM peliculas WHERE titulo LIKE :busqueda";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
    $stmt->execute();

    // Verifica si la consulta se ejecutó correctamente
    if ($stmt) {
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado) {
            echo '<ul class="list-group mt-2" aria-labelledby="dropdownMenuButton">';
            // Procesa los resultados
            foreach ($resultado as $pelicula) {
                echo '<li class="list-group-item">' . $pelicula['titulo'] . '</li>';
            }
            echo '</ul>';
            
        } else {
            echo '<ul class="list-group mt-2" aria-labelledby="dropdownMenuButton">';

            echo '<li class="list-group-item">No se encontraron resultados.</li>';
            echo '</ul>';
        }
    } else {
        echo '<p>Error al ejecutar la consulta.</p>';
    }
} else {
    echo '<p>Parámetros de búsqueda no proporcionados correctamente.</p>';
}
?>
