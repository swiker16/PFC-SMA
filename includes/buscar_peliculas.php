<?php
include_once 'config.php';

class SearchPeliculaHandler
{
    public static function buscarPeliculas($busqueda)
    {
        $conexion = ConnectDatabase::conectar();
        $sql = "SELECT * FROM peliculas WHERE titulo LIKE :busqueda";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarResultados($resultado)
    {
        echo '<ul class="list-group mt-2" aria-labelledby="dropdownMenuButton">';

        foreach ($resultado as $pelicula) {
            echo '<li class="list-group-item">' . $pelicula['titulo'] . '</li>';
        }

        echo '</ul>';
    }

    public static function mostrarMensajeSinResultados()
    {
        echo '<ul class="list-group mt-2" aria-labelledby="dropdownMenuButton">';
        echo '<li class="list-group-item">No se encontraron resultados.</li>';
        echo '</ul>';
    }

    public static function mostrarErrorConsulta()
    {
        echo '<p>Error al ejecutar la consulta.</p>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['q'])) {

    $busqueda = $_GET['q'];

    if (!empty($busqueda)) {
        $resultado = SearchPeliculaHandler::buscarPeliculas($busqueda);

        if ($resultado) {

            SearchPeliculaHandler::mostrarResultados($resultado);

        } else {

            SearchPeliculaHandler::mostrarMensajeSinResultados();
        }
    } else {
        echo '<p>La búsqueda no puede estar vacía.</p>';
    }
} else {
    echo '<p>Parámetros de búsqueda no proporcionados correctamente.</p>';
}
?>
