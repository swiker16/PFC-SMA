<?php
include_once '../../../includes/config.php';
$pdo = ConnectDatabase::conectar();

$id = $titulo = $descripcion = $director = $genero = $duracion = $clasificacion = $fecha_de_estreno = $imagen = $trailer_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];

    $statement = $pdo->prepare("SELECT * FROM peliculas WHERE pelicula_id = ?");
    $statement->execute([$id]);
    $pelicula = $statement->fetch(PDO::FETCH_ASSOC);

    $titulo = $pelicula['titulo'];
    $descripcion = $pelicula['descripcion'];
    $director = $pelicula['director'];
    $genero = $pelicula['genero'];
    $duracion = $pelicula['duracion'];
    $clasificacion = $pelicula['clasificacion'];
    $fecha_de_estreno = $pelicula['fecha_de_estreno'];
    $imagen = base64_encode($pelicula['imagen']);
    $trailer_url = $pelicula['trailer_url'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Font -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- CSS -->
<link rel="stylesheet" href="../../../assets/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="../../../assets/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="../../../assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="../../../assets/css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="../../../assets/css/nouislider.min.css">
<link rel="stylesheet" href="../../../assets/css/ionicons.min.css">
<link rel="stylesheet" href="../../../assets/css/plyr.css">
<link rel="stylesheet" href="../../../assets/css/photoswipe.css">
<link rel="stylesheet" href="../../../assets/css/default-skin.css">
<link rel="stylesheet" href="../../../assets/css/main.css">

<!-- Favicons -->
<link rel="icon" type="image/png" href="../icon/favicon-32x32.png" sizes="32x32">
<link rel="apple-touch-icon" href="../icon/favicon-32x32.png">
<link rel="apple-touch-icon" sizes="72x72" href="../icon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="../icon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="../icon/apple-touch-icon-144x144.png">

<meta name="description" content="">
<meta name="keywords" content="">
<title>Magic Cinema - Editar pelicula</title>

</head>
    <body>
    <header class="header">
        <div class="header__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__content">
                            <a href="../../../index.php" class="header__logo">
                                <img src="../../../assets/img/Magic_Cinema-removebg-preview.png" alt="">
                            </a>

                            <ul class="header__nav">
                                <li class="header__nav-item">
                                    <a href="administrador_pelicula.php" class="header__nav-link">Peliculas</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="../promociones/administrador_promo.php" class="header__nav-link">Promociones</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="../experiencias.php" class="header__nav-link">Horarios</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="../bar/administrador_bar.php" class="header__nav-link">Bar</a>
                                </li>

                                <a href="administrador_pelicula.php" class="header__sign-in">
                                    <i class="icon ion-ios-log-in"></i>
                                    <span>Volver</span>
                                </a>
                            </ul>

                            <button class="header__btn" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
        <div class="container mt-5 text-white">
            <h2 class="mb-3 text-black">-</h2>
            <h2 class="mb-4">Editar Película</h2>
            <form action="update_pelicula.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-row">
                    <div class="form-group mb-3 mt-5">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" name="titulo" value="<?php echo $titulo; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" name="descripcion" required rows="5"><?php echo $descripcion; ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="director">Director:</label>
                        <input type="text" class="form-control" name="director" value="<?php echo $director; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="genero">Género:</label>
                        <input type="text" class="form-control" name="genero" value="<?php echo $genero; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="duracion">Duración:</label>
                        <input type="text" class="form-control" name="duracion" value="<?php echo $duracion; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="clasificacion">Clasificación:</label>
                        <input type="text" class="form-control" name="clasificacion" value="<?php echo $clasificacion; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_de_estreno">Fecha de Estreno:</label>
                        <input type="date" class="form-control" name="fecha_de_estreno" value="<?php echo $fecha_de_estreno; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="imagen">Imagen:</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
                    </div>

                    <div class="form-group mb-3">
                        <label for="trailer_url">URL del Trailer:</label>
                        <input type="text" class="form-control" name="trailer_url" value="<?php echo $trailer_url; ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar Cambios</button>
            </form>
        </div>

    <!-- JS -->
    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/owl.carousel.min.js"></script>
    <script src="../../../assets/assets/js/jquery.mousewheel.min.js"></script>
    <script src="../../../assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="../../../assets/js/wNumb.js"></script>
    <script src="../../../assets/js/nouislider.min.js"></script>
    <script src="../../../assets/js/plyr.min.js"></script>
    <script src="../../../assets/js/jquery.morelines.min.js"></script>
    <script src="../../../assets/js/photoswipe.min.js"></script>
    <script src="../../../assets/js/photoswipe-ui-default.min.js"></script>
    <script src="../../../assets/js/main.js"></script>

</body>
</html>

<?php
} else {

    header('Location: administrador_pelicula.php');
    exit();
}
?>
