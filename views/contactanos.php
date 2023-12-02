<?php
include '../includes/navbarFunctions.php';
generateNavbar();
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

    <form action="correoContactanos.php" method="post">
        <!-- home -->
        <div class="container ">
            <!--Section: Contact v.2-->
            <section class="home mb-4 ">

                <!--Section heading-->
                <h2 class="h1-responsive font-weight-bold text-center my-4 text-white" style="font-family: 'Open Sans', sans-serif;">Contactanos</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5 text-white" style="font-family: 'Open Sans', sans-serif;">
                    ¿Tiene usted alguna pregunta? Por favor, no dude en contactarnos directamente. Nuestro equipo le responderá dentro de
                    Cuestión de horas para ayudarte.
                </p>

                <div class="row d-flex justify-content-center">

                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <!--Grid column-->
                            <div class="col-md-12 py-3">
                                <div class="md-form mb-0">
                                    <label for="email" class="text-white" style="font-family: 'Open Sans', sans-serif;">Correo electronico</label>
                                    <input type="text" id="email" name="to" class="form-control" style="font-family: 'Open Sans', sans-serif;">

                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12 py-3">
                                <div class="md-form mb-0">
                                    <label for="subject" class="text-white" style="font-family: 'Open Sans', sans-serif;">Asunto</label>
                                    <input type="text" id="subject" name="subject" class="form-control" style="font-family: 'Open Sans', sans-serif;">

                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12 ">

                                <div class="md-form">
                                    <label for="message" class="text-white" style="font-family: 'Open Sans', sans-serif;">Mensaje</label>
                                    <textarea type="text" id="message" name="body" rows="2" class="form-control md-textarea" style="font-family: 'Open Sans', sans-serif;"></textarea>

                                </div>

                            </div>
                        </div>
                        <!--Grid row-->
                        <div class="text-center text-md-left py-3">
                            <button><a href="#" class="" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">Enviar</a></button>
                        </div>
                        <div class="status"></div>
                    </div>
                    <!--Grid column-->
                </div>

            </section>

        </div>
    </form>



    <footer class=" footer">
		<div class="container">
			<div class="row">

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