<?php

class PromocionesHandler
{
    public static function obtenerPromociones($pdo)
    {
        try {
            // Realizar la consulta a la base de datos
            $stmt = $pdo->query("SELECT * FROM promociones");
            $promociones = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $promociones;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function generarTarjetasHTML($promociones)
    {
        ob_start();
?>
        <section class="content">
            <div class="content__head">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- content title -->
                            <h2 class="content__title">Ofertas y Sorteos</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <?php foreach ($promociones as $promocion) : ?>
                    <div class="card m-5" style="box-shadow: 0 5px 25px 0 rgba(0,0,0,0.3); max-width: 1040px; border: 2px solid transparent; border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border-image-slice: 1; background-color: #28282d;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($promocion['imagen']); ?>" class="img-fluid rounded-start" alt="Promoción">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="color:#fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($promocion['titulo']); ?></h5>
                                    <p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($promocion['descripcion']); ?></p>
                                    <p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">Fecha: <?php echo htmlspecialchars($promocion['fecha']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </section>
<?php
        return ob_get_clean();
    }
}

?>
