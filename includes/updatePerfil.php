<?php
// updatePerfil.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include_once '../includes/config.php';
        $conexion = ConnectDatabase::conectar();

        // Recupera el Usuario_ID del formulario
        $usuarioID = $_POST['usuario_id'];

        // Verifica si se subió un nuevo archivo de imagen
        if (!empty($_FILES['imagen']['name'])) {
            // Lógica para manejar la subida de la nueva imagen
            $nombreArchivo = $_FILES['imagen']['name'];
            $tipoArchivo = $_FILES['imagen']['type'];
            $tamanioArchivo = $_FILES['imagen']['size'];
            $archivoTemporal = $_FILES['imagen']['tmp_name'];

            // Verifica si es una imagen
            if (strpos($tipoArchivo, 'image') !== false) {
                // Lee el contenido del archivo en forma de binario
                $datosBinarios = file_get_contents($archivoTemporal);

                // Actualiza el campo 'imagen' en la base de datos
                $consultaActualizarImagen = $conexion->prepare("UPDATE usuarios SET imagen = :imagen WHERE Usuario_ID = :usuario_id");
                $consultaActualizarImagen->bindParam(':imagen', $datosBinarios, PDO::PARAM_LOB);
                $consultaActualizarImagen->bindParam(':usuario_id', $usuarioID, PDO::PARAM_INT);
                $consultaActualizarImagen->execute();

                // Devuelve un mensaje de éxito
                header("Location: ../views/user.php");
            } else {
                echo "Error: El archivo no es una imagen válida.";
            }
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
?>
