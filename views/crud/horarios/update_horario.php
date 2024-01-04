<?php

include_once '../../../includes/config.php';

class BarUpdate {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function actualizarBar($id, $titulo, $precio, $imagen) {
        
        if ($this->validarDatos($id, $titulo, $precio, $imagen)) {
            $imagen = $this->procesarImagen($id, $imagen);
            
            $statement = $this->pdo->prepare("UPDATE bar SET 
                titulo = ?, precio = ?, imagen = ? WHERE bar_id = ?");

            $statement->execute([$titulo, $precio, $imagen, $id]);

            return true;

        } else {
            return false;
        }
    }

    private function validarDatos($id, $titulo, $precio, $imagen) {
        return !empty($id) && !empty($titulo) && !empty($precio) && !empty($imagen);
    }

    private function procesarImagen($id, $imagen) {

        if ($_FILES['imagen']['size'] > 0) {
            return file_get_contents($_FILES['imagen']['tmp_name']);

        } else {
            $statement = $this->pdo->prepare("SELECT imagen FROM bar WHERE bar_id = ?");
            $statement->execute([$id]);
            return $statement->fetchColumn();
        }
    }
}

$BarUpdate = new BarUpdate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];

    if ($BarUpdate->actualizarBar($id, $titulo, $precio, $_FILES['imagen'])) {
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
