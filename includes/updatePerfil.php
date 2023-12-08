<?php
include_once '../includes/config.php';

class UpdatePerfilHandler
{
    public static function actualizarPerfil()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {

                $conexion = ConnectDatabase::conectar();

                $usuarioID = $_POST['usuario_id'];

                if (!empty($_FILES['imagen']['name'])) {
                    self::procesarNuevaImagen($conexion, $usuarioID);
                } else {
                    echo "Error: No se seleccionó un nuevo archivo de imagen.";
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                
            } finally {
                $conexion = null;
            }
        } else {
            echo "Error: Método no permitido.";
        }
    }

    private static function procesarNuevaImagen($conexion, $usuarioID)
    {
        $nombreArchivo = $_FILES['imagen']['name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $tamanioArchivo = $_FILES['imagen']['size'];
        $archivoTemporal = $_FILES['imagen']['tmp_name'];

        if (strpos($tipoArchivo, 'image') !== false) {

            $datosBinarios = file_get_contents($archivoTemporal);

            $consultaActualizarImagen = $conexion->prepare("UPDATE usuarios SET imagen = :imagen WHERE Usuario_ID = :usuario_id");
            $consultaActualizarImagen->bindParam(':imagen', $datosBinarios, PDO::PARAM_LOB);
            $consultaActualizarImagen->bindParam(':usuario_id', $usuarioID, PDO::PARAM_INT);
            $consultaActualizarImagen->execute();

            header("Location: ../views/user.php");
        } else {
            echo "Error: El archivo no es una imagen válida.";
        }
    }
}

?>
