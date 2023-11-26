<?php
try {
    $pdo = new PDO("mysql:host=172.19.0.2;dbname=magiccinema", "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Incluir el archivo con la lógica de promociones
    require_once('../includes/promociones.php');

    // Obtener las promociones
    $promociones = obtenerPromociones($pdo);

    // Generar el HTML de las tarjetas
    $tarjetasHTML = generarTarjetasHTML($promociones);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

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
    <meta name="author" content="Dmitry Volkov">
    <title>Magic Cinema</title>

</head>

<body class="body">

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
		<!-- home -->
		<section class="home">
			<!-- home bg -->
			<div class="owl-carousel home__bg">
				<div class="item home__cover" data-bg="../assets/img/home/home__bg.jpg"></div>
				<div class="item home__cover" data-bg="../assets/img/home/home__bg2.jpg"></div>
				<div class="item home__cover" data-bg="../assets/img/home/home__bg3.jpg"></div>
				<div class="item home__cover" data-bg="../assets/img/home/home__bg4.jpg"></div>
			</div>
			<!-- end home bg -->
		</section>

    <?php echo $tarjetasHTML; ?>
    <!-- end content -->
    <!-- footer -->
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