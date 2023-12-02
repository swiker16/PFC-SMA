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
        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
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

        .selected {
            background-color: #9cf7a7;
            /* Cambia el color a tu preferencia */
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
                echo '<h2 style="color: #fff; font-family: \'Open Sans\', sans-serif;">Detalles de la Reserva</h2>';
                echo '<p style="color: #fff; font-family: \'Open Sans\', sans-serif;"><strong>Nombre de la Película:</strong> ' . $fila['nombre_pelicula']  . '</p>';
                echo '<p style="color: #fff; font-family: \'Open Sans\', sans-serif;"><strong>Sala:</strong> ' . $fila['sala_nombre'] . '</p>';
                $fechaFormateada = date('d-m-Y H:i', strtotime($fila['Fecha_hora_inicio']));  // Cambiado a 'd-m-Y H:i'
                echo '<p style="color: #fff; font-family: \'Open Sans\', sans-serif;"><strong>Fecha y Hora:</strong> ' . $fechaFormateada . '</p>';
                // Agrega más detalles según sea necesario
                echo '</div>';
            }

            // Obtener información de los asientos para el horario seleccionado
            $sqlAsientos = "SELECT id_asiento, numero_fila, numero_columna, estado_asiento FROM asientos WHERE horario_id = :id_horario";
            $stmtAsientos = $conexion->prepare($sqlAsientos);
            $stmtAsientos->bindParam(':id_horario', $id_horario, PDO::PARAM_INT);
            $stmtAsientos->execute();

            // Almacenar información de asientos en un array asociativo
            $asientos = [];
            $idButacas = [];

            while ($filaAsiento = $stmtAsientos->fetch(PDO::FETCH_ASSOC)) {
                $asientos[$filaAsiento['numero_fila']][$filaAsiento['numero_columna']] = $filaAsiento['estado_asiento'];
                $idButacas[$filaAsiento['numero_fila']][$filaAsiento['numero_columna']] = $filaAsiento['id_asiento'];
            }
            ?>

            <div class="row">
                <div class="col-12 text-center">
                    <svg width="300" height="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100">
                        <polygon points="10,10 290,10 250,90 50,90" style="fill: #3b475a;" />
                        <text x="150" y="50" text-anchor="middle" fill="#fff" font-size="12" font-family="Arial">Pantalla</text>
                    </svg>
                </div>
                <div class="col-12 text-center mt-3 d-flex justify-content-center">
                    <div class="seating-plan" id="seating-plan">
                        <?php
                        foreach ($asientos as $fila => $columnas) {
                            foreach ($columnas as $columna => $estado) {
                                $clase_asiento = 'seat';
                                if ($estado == 'Disponible') {
                                    $clase_asiento .= ' available';
                                }
                                $id = $idButacas[$fila][$columna];
                                echo '<div style="cursor:default;" class="' . $clase_asiento . '" data-id="' . $id . '" onclick="seleccionarButaca(this, ' . $fila . ', ' . $columna . ', \'' . $estado . '\')">' . $fila . '-' . $columna . '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <div style="color: #fff; font-family: 'Open Sans', sans-serif;" id="info-butacas-seleccionadas"></div>
                    <div id="comprar-entrada" style="display: none;">
                        <a id="enlace-comprar-entrada" href="tipoEntrada.php" class="btn btn-primary m-3" style=" font-family: 'Open Sans', sans-serif; background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">Comprar Entrada</a>
                    </div>
                    <p style="color: red; font-family: 'Open Sans', sans-serif;" id="mensaje-error"></p>
                </div>
            </div>

            <script>
                var butacasSeleccionadas = [];

                function seleccionarButaca(elemento, fila, columna, estado) {
                    var mensajeErrorElemento = document.getElementById('mensaje-error');
                    var id = elemento.dataset.id;

                    if (estado !== 'Disponible') {
                        mensajeErrorElemento.innerText = 'Este asiento está ocupado.';
                        return;
                    }

                    var butaca = {
                        fila: fila,
                        columna: columna,
                        id: id // Incluir el ID en el objeto de butaca
                    };

                    // Verificar si la butaca ya está seleccionada
                    var indice = butacasSeleccionadas.findIndex(function(e) {
                        return e.fila === fila && e.columna === columna;
                    });

                    if (indice !== -1) {
                        // Deseleccionar la butaca si ya está seleccionada
                        butacasSeleccionadas.splice(indice, 1);
                        elemento.classList.remove('selected');
                    } else {
                        // Seleccionar la butaca
                        if (butacasSeleccionadas.length < 8) {
                            butacasSeleccionadas.push(butaca);
                            elemento.classList.add('selected');
                        } else {
                            mensajeErrorElemento.innerText = 'No puedes seleccionar más de 8 butacas.';
                        }
                    }

                    // Limpiar el mensaje de error después de un tiempo
                    setTimeout(function() {
                        mensajeErrorElemento.innerText = '';
                    }, 30000);

                    // Mostrar información de butacas seleccionadas
                    actualizarInfoButacas();
                }

                function actualizarInfoButacas() {
                    var infoButacas = 'Butacas seleccionadas: ';
                    var idsButacas = []; // Crear un array para almacenar los IDs de las butacas seleccionadas

                    for (var i = 0; i < butacasSeleccionadas.length; i++) {
                        infoButacas += butacasSeleccionadas[i].fila + '-' + butacasSeleccionadas[i].columna + ', ';

                        // Obtener el ID de cada butaca seleccionada y agregarlo al array
                        idsButacas.push(butacasSeleccionadas[i].id);
                    }

                    // Mostrar información de butacas seleccionadas
                    document.getElementById('info-butacas-seleccionadas').innerText = infoButacas;

                    // Mostrar el mensaje "Comprar Entrada" al lado de las butacas seleccionadas
                    var comprarEntradaElement = document.getElementById('comprar-entrada');
                    if (butacasSeleccionadas.length > 0) {
                        comprarEntradaElement.style.display = 'block';

                        // Modificar el enlace para incluir los parámetros
                        var enlaceComprarEntrada = document.getElementById('enlace-comprar-entrada');
                        enlaceComprarEntrada.href = 'tipoEntrada.php?butacas=' + butacasSeleccionadas.length + '&id=' + idsButacas.join(',');
                    } else {
                        comprarEntradaElement.style.display = 'none';
                    }
                }
            </script>

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
                        <li><a href="html/QuienesSomos.html">Quienés somos</a></li>
                        <li><a href="#">Apoyo Institucional</a></li>
                    </ul>
                </div>
                <!-- end footer list -->

                <!-- footer list -->
                <div class="col-6 col-sm-4 col-md-3">
                    <h6 class="footer__title">Legal</h6>
                    <ul class="footer__list">
                        <li><a href="html/AvisLegal.html">Aviso Legal</a></li>
                        <li><a href="html/CondicionesCompra.html">Condiciones de compra</a></li>
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