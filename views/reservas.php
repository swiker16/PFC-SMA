<?php
include '../includes/navbarFunctions.php';
NavbarHandler::generateNavbar();

if (empty($_SESSION["usuario"])) {

    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

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
    <title>Magic Cinema - Reservas</title>

</head>

<body>

    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
        <div class="item home__cover" data-bg="../assets/img/home/home__bg.jpg"></div>

        </div>
        <!-- end home bg -->
    </section>
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Tipo de Entrada</h2>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once '../includes/config.php';
        $conexion = ConnectDatabase::conectar();

        $consulta = $conexion->prepare("
                SELECT
                R.Usuario_ID,
                R.Horario_ID,
                A.numero_fila,
                A.numero_columna,
                S.Nombre_sala AS nombre_sala,
                P.titulo AS nombre_pelicula,
                H.fecha_hora_inicio
                FROM
                reservas R
                JOIN
                horarios H ON R.Horario_ID = H.Horario_ID
                JOIN
                asientos A ON R.asiento_id = A.id_asiento
                JOIN
                salas S ON H.Sala_ID = S.Sala_ID
                JOIN
                peliculas P ON H.Pelicula_ID = P.Pelicula_ID
                WHERE
                R.Usuario_ID = :usuario_id
                ");

        $consulta->bindParam(':usuario_id', $_SESSION['Usuario_ID'], PDO::PARAM_INT);
        $consulta->execute();
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if ($resultados) {
            echo '<div class="container">';
            echo '<div class="row">';
            foreach ($resultados as $fila) {

                echo '<div class="col-sm-4 mb-3 mb-sm-0">';
                echo '<div class="card " style="box-shadow: 0 5px 25px 0 rgba(0,0,0,0.3); border: 2px solid transparent; border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border-image-slice: 1; background-color: #28282d;">';
                echo '<div class="card-body p-3">';
                echo '<p class="card-text text-white" style ="font-family: \'Open Sans\', sans-serif;"><strong>Pelicula: </strong>' . $fila['nombre_pelicula'] . '</p>';
                echo '<p class="text-white" style="font-family: \'Open Sans\', sans-serif;"><strong>Sala: </strong>' . $fila['nombre_sala'] . '</p>';
                echo '<p class="text-white" style="font-family: \'Open Sans\', sans-serif;"><strong>Asientos Fila: </strong>' . $fila['numero_fila'] . '<strong>Butaca: </strong>' . $fila['numero_columna'] . '</p>';
                echo '<p class="text-white" style="font-family: \'Open Sans\', sans-serif;"><strong>Fecha y Hora de Inicio: </strong>' . $fila['fecha_hora_inicio'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo "No se encontraron resultados.";
        }
        ?>
    </section>

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