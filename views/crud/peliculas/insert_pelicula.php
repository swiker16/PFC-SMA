<?php

include_once '../../../includes/config.php';

class PeliculaInsert {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function insertarPelicula($titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $fecha_de_estreno, $imagen, $trailer_url) {
        
        if ($this->validarDatos($titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $trailer_url, $imagen)) {
            $imagen = $this->procesarImagen($imagen);
            
            $statement = $this->pdo->prepare("INSERT INTO peliculas (titulo, descripcion, director, genero, duracion, clasificacion, fecha_de_estreno, imagen, trailer_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $statement->execute([$titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $fecha_de_estreno, $imagen, $trailer_url]);

            return true;

        } else {
            return false;
        }
    }

    private function validarDatos($titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $trailer_url, $imagen) {
        return !empty($titulo) && !empty($descripcion) && !empty($director) && !empty($genero) && !empty($duracion) && !empty($clasificacion) && !empty($trailer_url) && !empty($imagen);
    }

    private function procesarImagen($imagen) {

        if ($_FILES['imagen']['size'] > 0) {
            return file_get_contents($_FILES['imagen']['tmp_name']);

        } else {
            return null;
        }
    }
}

$PeliculaInsert = new PeliculaInsert();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $duracion = $_POST['duracion'];
    $clasificacion = $_POST['clasificacion'];
    $fecha_de_estreno = $_POST['fecha_de_estreno'];
    $trailer_url = $_POST['trailer_url'];

    if ($PeliculaInsert->insertarPelicula($titulo, $descripcion, $director, $genero, $duracion, $clasificacion, $fecha_de_estreno, $_FILES['imagen'], $trailer_url)) {
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
