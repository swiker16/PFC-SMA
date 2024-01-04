<?php

class BarHandler
{
    public static function obtenerBar($pdo)
    {
        try {
            $total = isset($_GET['total']) ? floatval($_GET['total']) : 0.00;
            $idsButacas = isset($_GET['idsButacas']) ? $_GET['idsButacas'] : '';
            $correoUsuario = isset($_GET['correo']) ? $_GET['correo'] : '';
            $id_horario = $_GET['idHorario'];

            // Realizar la consulta a la base de datos para obtener las experiencias limitadas
            $stmt = $pdo->prepare("SELECT * FROM bar");
            $stmt->execute();

            $experiencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
            <div class="row d-flex justify-content-center">
                <?php foreach ($experiencias as $experiencia) : ?>
                    <div class="col-md-5 col-12">
                        <div class="card" style="box-shadow: 0 5px 25px 0 rgba(0,0,0,0.3); max-width: 1040px; border: 2px solid transparent; border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border-image-slice: 1; background-color: #28282d;">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($experiencia['imagen']); ?>" class="card-img-top" alt="Experiencia">
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($experiencia['titulo']); ?></h5>
                                <p class="card-text" style="color: #fff; font-family: 'Open Sans', sans-serif;"><?php echo htmlspecialchars($experiencia['precio']); ?> €</p>
                                <button class="" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">
                                    <a href="../views/tarjeta.php?total=<?php echo ($total + $experiencia['precio']); ?>&idsButacas=<?php echo $idsButacas ?>&correo=<?php echo $correoUsuario?> &idHorario=<?php echo $id_horario ?>" style="text-decoration: none; color: #fff;">Continuar</a>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">
                <a href="../views/tarjeta.php?total=<?php echo $total ?> &idsButacas=<?php echo $idsButacas ?> &correo=<?php echo $correoUsuario?> &idHorario=<?php echo $id_horario?>" style="text-decoration: none; color: #fff;">Continuar sin producto</a>
            </button>

<?php
            return $experiencias;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            error_log("Error al obtener experiencias: " . $e->getMessage());
            return false;
        }
    }
}

?>