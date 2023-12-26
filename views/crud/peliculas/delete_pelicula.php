<?php

include_once '../../../includes/config.php';

class PeliculaDelete {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function eliminarPelicula($id) {
        
        if ($this->validarId($id)) {
            $statement = $this->pdo->prepare("DELETE FROM peliculas WHERE pelicula_id = ?");
            $statement->execute([$id]);
            return true;

        } else {
            return false;

        }
    }

    private function validarId($id) {
        return is_numeric($id) && $id > 0;
    }
}

$PeliculaDelete = new PeliculaDelete();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
   
    $id = $_GET['id'];

    if ($PeliculaDelete->eliminarPelicula($id)) {
        header('Location: administrador_pelicula.php');
        exit();

    } else {
        echo "Error en la validación del ID.";
    }

} else {
    header('Location: administrador_pelicula.php');
    exit();
}
?>
