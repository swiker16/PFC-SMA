<?php
include_once '../../../includes/config.php';
$pdo = ConnectDatabase::conectar();

// Obtener los resultados de la tabla horarios
$statement = $pdo->prepare("SELECT titulo FROM peliculas");
$statement->execute();
$resultados = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement2 = $pdo->prepare("SELECT Nombre_sala FROM salas");
$statement2->execute();
$resultados2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

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
<title>Magic Cinema - Nuevo Horario</title>
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
                                    <a href="../peliculas/administrador_pelicula.php" class="header__nav-link">Peliculas</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="../promociones/administrador_promo.php" class="header__nav-link">Promociones</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="administrador_horario.php" class="header__nav-link">Horarios</a>
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
        <h2 class="mb-4">Nuevo Horario</h2>
        <form action="insert_horario.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="sala" class="form-label">Sala:</label>
                    <select class="form-select" name="sala" required>
        <!-- Aquí se cargarán las opciones de las salas desde la base de datos -->
        <?php
        foreach ($resultados2 as $sala) {
            // Imprime cada opción en el formato correcto
            echo "<option value=\"{$sala['Nombre_sala']}\">{$sala['Nombre_sala']}</option>";
        }
        ?>
    </select>
            </div>

            <div class="mb-3">
                <label for="pelicula" class="form-label">Pelicula:</label>
    <select class="form-select" name="pelicula" required>
        <!-- Aquí se cargarán las opciones de las películas desde la base de datos -->
        <?php
        foreach ($resultados as $pelicula) {
            // Imprime cada opción en el formato correcto
            echo "<option value=\"{$pelicula['titulo']}\">{$pelicula['titulo']}</option>";
        }
        ?>
    </select>            </div>
            
            <div class="mb-3">
                <label for="columnas" class="form-label">Numero de columnas:</label>
                <input type="text" class="form-control" name="columnmas" required>
            </div>
            
            <div class="mb-3">
                <label for="filas" class="form-label">Numero de filas:</label>
                <input type="text" class="form-control" name="filas" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha:</label>
                <input type="datetime-local" class="form-control" name="fecha" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
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
