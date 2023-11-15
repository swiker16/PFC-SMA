<?php
try {
    $pdo = new PDO("mysql:host=172.20.0.3;dbname=magiccinema", "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $director = $_POST["director"];
        $descripcion = $_POST["descripcion"];
        $genero = $_POST["genero"];
        $duracion = $_POST["duracion"];
        $clas = $_POST["clas"];
        $fecha = $_POST["fecha"];

        

        // Guardar la imagen en el servidor
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $ruta_imagen = "../assets/imagenes/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $ruta_imagen);

        // Insertar en la base de datos
        $stmt = $pdo->prepare("INSERT INTO peliculas (titulo, director, descripcion, genero, duracion, clasificacion, Fecha_de_estreno,imagen) 
        VALUES (:titulo, :director, :descripcion, :genero, :duracion, :clas, :fecha, :imagen)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':clas', $clas);
        $stmt->bindParam(':fecha', $date);
        $stmt->bindParam(':imagen', $ruta_imagen, PDO::PARAM_LOB);
        $stmt->execute();

        echo "Película insertada correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>