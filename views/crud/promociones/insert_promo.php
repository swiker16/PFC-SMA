<?php

include_once '../../../includes/config.php';

class PromoInsert {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function insertarPromo($titulo, $descripcion, $fecha, $imagen) {
        
        if ($this->validarDatos($titulo, $descripcion, $fecha, $imagen)) {
            $imagen = $this->procesarImagen($imagen);
            
            $statement = $this->pdo->prepare("INSERT INTO promociones (titulo, descripcion, fecha, imagen) VALUES (?, ?, ?, ?)");

            $statement->execute([$titulo, $descripcion, $fecha, $imagen]);

            return true;

        } else {
            return false;
        }
    }

    private function validarDatos($titulo, $descripcion, $fecha, $imagen) {
        return !empty($titulo) && !empty($descripcion) && !empty($fecha) && !empty($imagen);
    }

    private function procesarImagen($imagen) {

        if ($_FILES['imagen']['size'] > 0) {
            return file_get_contents($_FILES['imagen']['tmp_name']);

        } else {
            return null;
        }
    }
}

$PromoInsert = new PromoInsert();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    if ($PromoInsert->insertarPromo($titulo, $descripcion, $fecha, $_FILES['imagen'])) {
        header('Location: administrador_promo.php');
        exit();

    } else {
        echo "Error en la validación de datos.";
    }

} else {
    header('Location: administrador_promo.php');
    exit();
}
?>
