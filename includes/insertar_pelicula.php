<?php
include_once 'config.php';

class InsertPeliculaHandler
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function guardarPeliculaEnBD($titulo, $director, $descripcion, $genero, $duracion, $clas, $fecha, $imagen_binaria)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO peliculas (titulo, director, descripcion, genero, duracion, clasificacion, fecha_de_estreno, imagen) 
                VALUES (:titulo, :director, :descripcion, :genero, :duracion, :clas, :fecha, :imagen)");

            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':director', $director);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':duracion', $duracion);
            $stmt->bindParam(':clas', $clas);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':imagen', $imagen_binaria, PDO::PARAM_LOB);

            $stmt->execute();

            echo "Película insertada correctamente.";
        } catch (PDOException $e) {
            echo "Error al insertar la película: " . $e->getMessage();
        }
    }

    public function procesarFormulario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $director = $_POST["director"];
            $descripcion = $_POST["descripcion"];
            $genero = $_POST["genero"];
            $duracion = $_POST["duracion"];
            $clas = $_POST["clas"];
            $fecha = date("Y-m-d", strtotime($_POST["fecha"]));

            $imagen_binaria = file_get_contents($_FILES["imagen"]["tmp_name"]);

            $this->guardarPeliculaEnBD($titulo, $director, $descripcion, $genero, $duracion, $clas, $fecha, $imagen_binaria);
        }
    }
}

?>
