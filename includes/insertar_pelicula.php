<?php
try {
    $pdo = new PDO("mysql:host=172.20.0.4;dbname=magiccinema", "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];


        // Guardar la imagen en el servidor
        // Obtener el contenido binario del archivo
        $imagen_binaria = file_get_contents($_FILES["imagen"]["tmp_name"]);

        // Escapar el nombre del archivo para evitar inyección SQL
        $nombre = $pdo->quote($_FILES["imagen"]["name"]);

        // Insertar en la base de datos
        $stmt = $pdo->prepare("INSERT INTO experiencias (titulo, descripcion, imagen) 
        VALUES (:titulo, :descripcion, :imagen)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':imagen', $imagen_binaria, PDO::PARAM_LOB);
        $stmt->execute();

        echo "Película insertada correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
