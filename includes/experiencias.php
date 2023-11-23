<?php

function obtenerExperienciasLimitadas($pdo, $limite)
{
    try {
        // Realizar la consulta a la base de datos para obtener las experiencias limitadas
        $stmt = $pdo->prepare("SELECT * FROM experiencias LIMIT :limite");
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();

        $experiencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $experiencias;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function generarHTMLExperienciasSalas($experiencias)
{
    ob_start();
?>
    <div class="row d-flex justify-content-center">
        <?php foreach ($experiencias as $experiencia) : ?>
            <div class="col-md-5 col-12">
            <div class="card" style="box-shadow: 0 5px 25px 0 rgba(0,0,0,0.3); max-width: 1040px; border: 2px solid transparent; border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border-image-slice: 1; background-color: #28282d;">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($experiencia['imagen']); ?>" class="card-img-top" alt="Experiencia">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($experiencia['titulo']); ?></h5>
                        <p class="card-text" style="color: #fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($experiencia['descripcion']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
    return ob_get_clean();
}

?>