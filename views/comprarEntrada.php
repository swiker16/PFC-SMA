<?php
include_once '../includes/config.php';

// Obtén el id_horario de la URL
$id_horario = $_GET['id'];

// Realiza una consulta para obtener la información de los asientos disponibles
$conexion = ConnectDatabase::conectar();

$sql = "
    SELECT a.id_asiento, a.numero_fila, a.numero_columna, a.estado_asiento
    FROM horarios h
    JOIN salas s ON h.sala_id = s.sala_id
    JOIN asientos a ON s.sala_id = a.id_sala
    WHERE h.Horario_id = :id_horario
";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
$stmt->execute();

// Almacena los asientos en un array asociativo para facilitar la manipulación
$asientos = [];
while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $asientos[$fila['numero_fila']][$fila['numero_columna']] = $fila['estado_asiento'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="../assets/css/nouislider.min.css">
        <link rel="stylesheet" href="../assets/css/ionicons.min.css">
        <link rel="stylesheet" href="../assets/css/plyr.css">
        <link rel="stylesheet" href="../assets/css/photoswipe.css">
        <link rel="stylesheet" href="../assets/css/default-skin.css">
        <link rel="stylesheet" href="../assets/css/main.css">

        <!-- Favicons -->
        <link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
        <link rel="apple-touch-icon" href="icon/favicon-32x32.png">
        <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">

        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Dmitry Volkov">
        <title>Magic Cinema - Butacas</title>

    </head>
    <style>
        .seating-plan {
            display: grid;
            grid-template-columns: repeat(<?php echo count($asientos[1]); ?>, 40px);
            /* Ajusta según el número máximo de columnas */
            gap: 5px;
        }

        .seat {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
            background-color: #808080;
            border: 1px solid #fff;
        }

        .available {
            background-color: #4CAF50;
            /* verde */
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__content">
                            <!-- header logo -->
                            <a href="../index.php" class="header__logo">
                                <img src="../assets/img/Magic_Cinema-removebg-preview.png" alt="">
                            </a>
                            <!-- end header logo -->

                            <!-- header nav -->
                            <ul class="header__nav">
                                <li class="header__nav-item">
                                    <a href="cartelera.php" class="header__nav-link">Cartelera</a>
                                </li>
                                <!-- dropdown -->
                                <li class="header__nav-item">
                                    <a href="promociones.php" class="header__nav-link">Promociones</a>
                                </li>
                                <!-- end dropdown -->

                                <li class="header__nav-item">
                                    <a href="experiencias.php" class="header__nav-link">Experiencias</a>
                                </li>

                                <li class="header__nav-item">
                                    <a href="contactanos.php" class="header__nav-link">Contactanos</a>
                                </li>
                                <!-- end dropdown -->
                            </ul>
                            <!-- end header nav -->

                            <!-- header auth -->
                            <div class="header__auth">
                                <a href="../views/html/FormLogin.html" class="header__sign-in">
                                    <i class="icon ion-ios-log-in"></i>
                                    <span>Iniciar Sesión</span>
                                </a>
                            </div>
                            <a href="../views/html/FormRegister.html" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Registrarse</span>
                            </a>
                            <!-- end header auth -->

                            <!-- header menu btn -->
                            <button class="header__btn" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <!-- end header menu btn -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
            <div class="item home__cover" data-bg="../assets/img/home/home__bg3.jpg"></div>
            <div class="item home__cover" data-bg="../assets/img/home/home__bg4.jpg"></div>
        </div>
        <!-- end home bg -->
    </section>
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Elige tu asiento</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <?php
            include_once '../includes/config.php';

            // Obtener el id del horario de la URL
            $id_horario = $_GET['id'];

            // Realizar una consulta para obtener información adicional
            // Asumiendo que tienes una conexión a la base de datos llamada $conexion
            $conexion = ConnectDatabase::conectar();

            // Realiza la consulta SQL para obtener la información del horario específico
            $sql = "SELECT horarios.Fecha_hora_inicio, horarios.sesion, salas.Nombre_sala as sala_nombre, peliculas.titulo as nombre_pelicula
        FROM horarios
        INNER JOIN salas ON horarios.sala_id = salas.sala_id
        INNER JOIN peliculas ON horarios.pelicula_id = peliculas.pelicula_id
        WHERE horarios.Horario_id = :id";  // Cambiado a Horario_id

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id_horario, PDO::PARAM_INT);  // Cambiado a $id_horario
            $stmt->execute();

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Mostrar la información en la página
                echo '<div>';
                echo '<h2>Detalles del Horario</h2>';
                echo '<p><strong>Nombre de la Película:</strong> ' . $fila['nombre_pelicula']  . '</p>';
                echo '<p><strong>Sala:</strong> ' . $fila['sala_nombre'] . '</p>';
                $fechaFormateada = date('d-m-Y H:i', strtotime($fila['Fecha_hora_inicio']));  // Cambiado a 'd-m-Y H:i'
                echo '<p><strong>Fecha y Hora:</strong> ' . $fechaFormateada . '</p>';
                // Agrega más detalles según sea necesario
                echo '</div>';
            }
            ?>
        </div>

        <div class="container">
            <div class="d-flex justify-content-center">


                <h2>Asientos Disponibles</h2>
                <div class="seating-plan">
                    <?php
                    foreach ($asientos as $fila => $columnas) {
                        foreach ($columnas as $columna => $estado) {
                            $clase_asiento = 'seat';
                            if ($estado == 'Disponible') {
                                $clase_asiento .= ' available';
                            }
                            echo '<div class="' . $clase_asiento . '">' . $fila . '-' . $columna . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
    </section>

    <footer class=" footer">
        <div class="container">
            <div class="row">
                <!-- footer list -->
                <div class="col-12 col-md-3">
                    <h6 class="footer__title"> </h6>
                    <ul class="footer__app">
                        <li><a href="#"><img src="img/Download_on_the_App_Store_Badge.svg" alt=""></a></li>
                        <li><a href="#"><img src="img/google-play-badge.png" alt=""></a></li>
                    </ul>
                </div>
                <!-- end footer list -->

                <!-- footer list -->
                <div class="col-6 col-sm-4 col-md-3">
                    <h6 class="footer__title">Sobre nosotros</h6>
                    <ul class="footer__list">
                        <li><a href="#">Quienés somos</a></li>
                        <li><a href="#">Trabaja con nosotros</a></li>
                        <li><a href="#">Apoyo Institucional</a></li>
                    </ul>
                </div>
                <!-- end footer list -->

                <!-- footer list -->
                <div class="col-6 col-sm-4 col-md-3">
                    <h6 class="footer__title">Legal</h6>
                    <ul class="footer__list">
                        <li><a href="#">Aviso Legal</a></li>
                        <li><a href="#">Condiciones de compra</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                    </ul>
                </div>
                <!-- end footer list -->

                <!-- footer list -->
                <div class="col-12 col-sm-4 col-md-3">
                    <h6 class="footer__title">Contacto</h6>
                    <ul class="footer__list">
                        <li><a href="tel:+18002345678">+34 624 23 34 03</a></li>
                        <li><a href="mailto:atencionalclient@cinemmagic.com">atencionalclient@magiccinema.com</a></li>
                    </ul>
                </div>
                <!-- end footer list -->
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- JS -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/assets/js/jquery.mousewheel.min.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="../assets/js/wNumb.js"></script>
    <script src="../assets/js/nouislider.min.js"></script>
    <script src="../assets/js/plyr.min.js"></script>
    <script src="../assets/js/jquery.morelines.min.js"></script>
    <script src="../assets/js/photoswipe.min.js"></script>
    <script src="../assets/js/photoswipe-ui-default.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>