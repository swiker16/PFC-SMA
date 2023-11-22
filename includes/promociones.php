<?php

function obtenerPromociones($pdo)
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

function generarTarjetasHTML($promociones)
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
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row">
                        <?php foreach ($promociones as $promocion) : ?>
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="card card--list border border-0" style="background-color: transparent;">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($promocion['imagen']); ?>" class="img-fluid rounded-start" alt="Promoción">
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="card__content">
                                                <div class="card__description">
                                                    <h3 class="card__title"><?php echo htmlspecialchars($promocion['titulo']); ?></h3>
                                                    <p><?php echo htmlspecialchars($promocion['descripcion']); ?></p>
                                                    <p>Fecha: <?php echo htmlspecialchars($promocion['fecha']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    return ob_get_clean();
}
?>