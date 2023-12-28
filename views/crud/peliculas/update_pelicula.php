<?php

include_once '../../../includes/config.php';

class PeliculaUpdate {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function actualizarPelicula($id, $titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $fecha_de_estreno, $trailer_url, $imagen) {
        
        if ($this->validarDatos($id, $titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $trailer_url, $imagen)) {
            $imagen = $this->procesarImagen($id, $imagen);
            
            $statement = $this->pdo->prepare("UPDATE peliculas SET 
                titulo = ?, descripcion = ?, director = ?, genero = ?, duracion = ?, 
                clasificacion = ?, fecha_de_estreno = ?, imagen = ?, trailer_url = ? WHERE pelicula_id = ?");

            $statement->execute([$titulo, $descripcion, $director, $genero, $duracion, 
                                 $clasificacion, $fecha_de_estreno, $imagen, $trailer_url, $id]);

            return true;

        } else {
            return false;
        }
    }

    private function validarDatos($id, $titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $trailer_url, $imagen) {
        return !empty($id) && !empty($titulo) && !empty($descripcion) && !empty($director) &&
               !empty($genero) && !empty($duracion) && !empty($clasificacion) && !empty($trailer_url) && !empty($imagen);
    }

    private function procesarImagen($id, $imagen) {

        if ($_FILES['imagen']['size'] > 0) {
            return file_get_contents($_FILES['imagen']['tmp_name']);

        } else {
            $statement = $this->pdo->prepare("SELECT imagen FROM peliculas WHERE pelicula_id = ?");
            $statement->execute([$id]);
            return $statement->fetchColumn();
        }
    }
}

$peliculaUpdate = new PeliculaUpdate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $duracion = $_POST['duracion'];
    $clasificacion = $_POST['clasificacion'];
    $fecha_de_estreno = isset($_POST['fecha_de_estreno']) ? $_POST['fecha_de_estreno'] : null;
    $trailer_url = $_POST['trailer_url'];

    if ($peliculaUpdate->actualizarPelicula($id, $titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $fecha_de_estreno, $trailer_url, $_FILES['imagen'])) {
        header('Location: administrador_pelicula.php');
        exit();

    } else {
        echo "Error en la validación de datos.";
    }

} else {
    header('Location: administrador_pelicula.php');
    exit();
}
?>
