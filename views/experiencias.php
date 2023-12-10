<?php
include '../includes/navbarFunctions.php';
NavbarHandler::generateNavbar();
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
    <title>Magic Cinema</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body class="body">

    <!-- home -->
    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
            <div class="item home__cover" data-bg="../assets/img/home/home__bg2.jpg"></div>
            <div class="item home__cover" data-bg="../assets/img/home/home__bg3.jpg"></div>
            <div class="item home__cover" data-bg="../assets/img/home/home__bg4.jpg"></div>
        </div>
        <!-- end home bg -->
    </section>

    <!-- end content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Disfruta de las mejores experiencias en Magic Cinema</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row">
                        <p style="color: #fff; font-family: 'Open Sans', sans-serif;">Conoce todos los detalles de las salas de cine premium más exclusivas y adéntrate en los lujosos Cinesa LUXE. Maravíllate con la gran oferta de sesiones en versión original y déjate mimar por los productos de bar más selectos. Todo a tu alcance para hacer de tu visita al cine una experiencia única.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    try {
        include_once '../includes/config.php';

        $pdo = ConnectDatabase::conectar();

        // Incluir el archivo con la lógica de experiencias
        require_once('../includes/experiencias.php');

        // Definir el límite
        $limiteExperiencias = 4;

        // Obtener las experiencias limitadas
        $experiencias = ExperienciasHandler::obtenerExperienciasLimitadas($pdo, $limiteExperiencias);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>

    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">¿CONOCES TODAS LAS SALAS PREMIUM?</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <?php echo ExperienciasHandler::generarHTMLExperienciasSalas($experiencias); ?>
        </div>
    </section>

    <!-- footer -->
    <?php require_once("footer.php");?>
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