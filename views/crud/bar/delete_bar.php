<?php

include_once '../../../includes/config.php';

class BarDelete {

    private $pdo;

    public function __construct() {
        $this->pdo = ConnectDatabase::conectar();
    }

    public function eliminarBar($id) {
        
        if ($this->validarId($id)) {
            $statement = $this->pdo->prepare("DELETE FROM bar WHERE bar_id = ?");
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

$BarDelete = new BarDelete();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
   
    $id = $_GET['id'];

    if ($BarDelete->eliminarBar($id)) {
        header('Location: administrador_bar.php');
        exit();

    } else {
        echo "Error en la validación del ID.";
    }

} else {
    header('Location: administrador_bar.php');
    exit();
}
?>
