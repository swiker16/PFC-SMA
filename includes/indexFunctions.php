<?php
include_once 'includes/config.php';

function mostrarTopPeliculas()
{
    $conexion = ConnectDatabase::conectar();
    $sql = "SELECT * FROM peliculas ORDER BY pelicula_id DESC LIMIT 7";
    $resultado = $conexion->query($sql);

    if ($resultado->rowCount() > 0) {
?>

        <!-- home -->
        <section class="home">
            <!-- home bg -->
            <div class="owl-carousel home__bg">
                <div class="item home__cover" data-bg="assets/img/home/home__bg.jpg"></div>
                <div class="item home__cover" data-bg="assets/img/home/home__bg2.jpg"></div>
                <div class="item home__cover" data-bg="assets/img/home/home__bg3.jpg"></div>
                <div class="item home__cover" data-bg="assets/img/home/home__bg4.jpg"></div>
            </div>
            <!-- end home bg -->

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="home__title"><b>TOP PELÍCULAS</b></h1>

                        <button class="home__nav home__nav--prev" type="button">
                            <i class="icon ion-ios-arrow-round-back"></i>
                        </button>
                        <button class="home__nav home__nav--next" type="button">
                            <i class="icon ion-ios-arrow-round-forward"></i>
                        </button>
                    </div>

                    <div class="col-12">
                        <div class="owl-carousel home__carousel">
                            <?php
                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                $id_pelicula = $registro['pelicula_id'];
                                $imagen_binaria = $registro['imagen'];
                                $titulo = $registro['titulo'];
                                $genero = $registro['genero'];
                            ?>
                                <div class="item">
                                    <!-- card -->
                                    <div class="card card--big border border-0" style="background-color: transparent;">
                                        <a href="views/pelicula.php?id=<?php echo $id_pelicula; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($imagen_binaria); ?>" class="card-img-top" alt="<?php echo $titulo; ?>"></a>
                                        <div class="card__content">
                                            <h3 class="card__title"><?php echo $titulo; ?></h3>
                                            <span class="card__category">
                                                <a href="#"><?php echo $genero; ?></a>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}

