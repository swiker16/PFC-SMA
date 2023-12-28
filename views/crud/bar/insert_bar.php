<?php

include_once '../../../includes/config.php';

class BarInsert {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function insertarBar($titulo, $precio, $imagen) {
        
        if ($this->validarDatos($titulo, $precio, $imagen)) {
            $imagen = $this->procesarImagen($imagen);
            
            $statement = $this->pdo->prepare("INSERT INTO bar (titulo, precio, imagen) VALUES (?, ?, ?)");

            $statement->execute([$titulo, $precio, $imagen]);

            return true;

        } else {
            return false;
        }
    }

    private function validarDatos($titulo, $precio, $imagen) {
        return !empty($titulo) && !empty($precio) && !empty($imagen);
    }

    private function procesarImagen($imagen) {

        if ($_FILES['imagen']['size'] > 0) {
            return file_get_contents($_FILES['imagen']['tmp_name']);

        } else {
            return null;
        }
    }
}

$BarInsert = new BarInsert();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];

    if ($BarInsert->insertarBar($titulo, $precio, $_FILES['imagen'])) {
        header('Location: administrador_bar.php');
        exit();

    } else {
        echo "Error en la validación de datos.";
    }

} else {
    header('Location: administrador_bar.php');
    exit();
}
?>
