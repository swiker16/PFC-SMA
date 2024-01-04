<?php
include_once 'includes/config.php';

class IndexPeliculaHandler
{
    public static function mostrarTopPeliculas()
    {
        $conexion = ConnectDatabase::conectar();
        $sql = "SELECT * FROM peliculas ORDER BY pelicula_id DESC LIMIT 7";
        $resultado = $conexion->query($sql);

        if ($resultado->rowCount() > 0) {
            self::mostrarTopPeliculasSection($resultado);
        }
    }

    private static function mostrarTopPeliculasSection($resultado)
    {
        ?>
        <section class="home">

            <div class="owl-carousel home__bg">
                <?php
                $backgroundImages = ["home__bg.jpg", "home__bg2.jpg", "home__bg3.jpg", "home__bg4.jpg"];
                foreach ($backgroundImages as $image) {
                    echo '<div class="item home__cover" data-bg="assets/img/home/' . $image . '"></div>';
                }
                ?>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="home__title"><b>TOP PELÍCULAS</b></h1>
                        <button class="home__nav home__nav--prev" type="button"><i class="icon ion-ios-arrow-round-back"></i></button>
                        <button class="home__nav home__nav--next" type="button"><i class="icon ion-ios-arrow-round-forward"></i></button>
                    </div>

                    <div class="col-12">
                        <div class="owl-carousel home__carousel">
                            <?php
                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                self::mostrarTarjetaPelicula($registro);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private static function mostrarTarjetaPelicula($registro)
    {
        $id_pelicula = $registro['pelicula_id'];
        $imagen_binaria = $registro['imagen'];
        $titulo = $registro['titulo'];
        $genero = $registro['genero'];
        
        ?>

        <div class="item">
            <div class="card card--big border border-0" style="background-color: transparent;">
                <a href="views/pelicula.php?id=<?php echo $id_pelicula; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen_binaria); ?>" class="card-img-top" alt="<?php echo $titulo; ?>">
                </a>

                <div class="card__content">
                    <h3 class="card__title"><?php echo $titulo; ?></h3>
                    <span class="card__category">
                        <a href="#"><?php echo $genero; ?></a>
                    </span>
                </div>
            </div>
        </div>
    <?php
    }
}
?>
