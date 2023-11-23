<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="assets/css/nouislider.min.css">
	<link rel="stylesheet" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/plyr.css">
	<link rel="stylesheet" href="assets/css/photoswipe.css">
	<link rel="stylesheet" href="assets/css/default-skin.css">
	<link rel="stylesheet" href="assets/css/main.css">

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
	<!-- Agrega esto en el head de tu HTML -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>

<body class="body">

	<!-- header -->
	<header class="header">
		<div class="header__wrap">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__content">
							<!-- header logo -->
							<a href="index.php" class="header__logo">
								<img src="assets/img/Magic_Cinema-removebg-preview.png" alt="">
							</a>
							<!-- end header logo -->

							<!-- header nav -->
							<ul class="header__nav">
								<li class="header__nav-item">
									<a href="views/cartelera.php" class="header__nav-link">Cartelera</a>
								</li>
								<!-- dropdown -->
								<li class="header__nav-item">
									<a href="views/promociones.php" class="header__nav-link">Promociones</a>
								</li>
								<!-- end dropdown -->

								<li class="header__nav-item">
									<a href="views/experiencias.php" class="header__nav-link">Experiencias</a>
								</li>

								<li class="header__nav-item">
									<a href="views/contactanos.php" class="header__nav-link">Contactanos</a>
								</li>
								<!-- end dropdown -->
							</ul>
							<!-- end header nav -->

							<!-- header auth -->
							<div class="header__auth">
								<a href="views/html/FormLogin.html" class="header__sign-in">
									<i class="icon ion-ios-log-in"></i>
									<span>Iniciar Sesión</span>
								</a>
							</div>
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

		<!-- header search -->
		<form action="#" class="header__search">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__search-content">
							<input type="text" placeholder="Search for a movie, TV Series that you are looking for">

							<button type="button">search</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- end header search -->
	</header>
	
	<?php
	include 'includes/indexFunctions.php';

	mostrarTopPeliculas();

	?>

	<!-- end home -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">Compra rápida</h2>
					</div>
				</div>
			</div>
		</div>




	</section>

	<!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">Ofertas y Sorteos</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="card my-5 border border-0" style="max-width: 1040px; background-color: transparent;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/wish-el-poder-de-los-deseos-sorteo-viaje-disney.jpg" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title fw-bold" style="color:#fff; font-family: 'Open Sans', sans-serif;">¡Todos tus deseos con este viaje lleno de magia!</h5>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">Compra ya tu entrada online y haz tus sueños realidad ganando este viaje a Disneyland® Paris</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">Participa en el sorteo con "Wish: El poder de los deseos" y podrás conseguir un viaje en familia al lugar donde todos los deseos se hacen realidad.</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">El sorteo termina el: 26/11/2023</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card my-5 border border-0" style="max-width: 1040px; background-color: transparent;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/ofertas-wonka-cinesa.jpg" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title fw-bold" style="color:#fff; font-family: 'Open Sans', sans-serif;">¡Consigue varios premios inspirados en la película!</h5>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">Compra ya tus entradas online para ver "Wonka" y consigue todos estos premios</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">¿Te vienes de viaje por el mundo con el joven Willy Wonka? Sé de los primeros en conocer la historia del personaje más emblemático de Roald Dahl. ¡Y consigue varios premios inspirados en la película!</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">La película se estrena el: 06/12/2023</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card my-5 border border-0" style="max-width: 1040px; background-color: transparent;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/ofertas-los-juegos-del-hambre-cinesa.jpg" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title fw-bold"style="color:#fff; font-family: 'Open Sans', sans-serif;">¡Consigue varios premios inspirados en la película!</h5>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">Compra ya tus entradas online para ver "Los Juegos del Hambre: Balada de pájaros cantores y serpientes" y consigue todos estos premios.</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">¿Te atreves a seguir de cerca los primeros Juegos? Viaja al Distrito 12 de hace 65 años a través de la gran pantalla. ¡Y consigue varios premios inspirados en la película!</p>
							<p class="card-text" style="color:#fff; font-family: 'Open Sans', sans-serif;">La película se estrena el: 17/11/2023</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end content -->

	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">PELÍCULAS EN VERSIÓN ORIGINAL</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="card text-bg-dark">
				<img src="assets/img/peliculas-version-original-septiembre-cinesa.webp" class="card-img" alt="...">
				<div class="card-img-overlay my-5">
					<h5 class="card-title fw-bold" style="font-family: 'Open Sans', sans-serif;">¿Prefieres ver las películas en versión original?</h5>
					<p class="card-text" style="font-family: 'Open Sans', sans-serif;">The Marvels, Los Juegos del Hambre, Five Nights at Freddy's... En Cinesa, encontrarás tus títulos preferidos también en Versión Original Subtitulada al Español.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">DESCUBRE NUESTRAS SALAS PREMIUM</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="card text-bg-dark">
				<img src="assets/img/banner-plf-1324x420.jpg" class="card-img" alt="...">
				<div class="card-img-overlay my-5">
					<h5 class="card-title fw-bold" style="font-family: 'Open Sans', sans-serif;">Salas Premium</h5>
					<p class="card-text text-start" style="font-family: 'Open Sans', sans-serif;">IMAX, ISENSE, DBOX, SCREENX... Conoce todos los detalles de las salas de cine premium más exclusivas. Todo a tu alcance para hacer de tu visita al cine una experiencia única.</p>
				</div>
			</div>
		</div>
	</section>

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
								<h6 class="footer__title">Resources</h6>
								<ul class="footer__list">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Pricing Plan</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
							<!-- end footer list -->

							<!-- footer list -->
							<div class="col-6 col-sm-4 col-md-3">
								<h6 class="footer__title">Legal</h6>
								<ul class="footer__list">
									<li><a href="#">Terms of Use</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Security</a></li>
								</ul>
							</div>
							<!-- end footer list -->

							<!-- footer list -->
							<div class="col-12 col-sm-4 col-md-3">
								<h6 class="footer__title">Contacto</h6>
								<ul class="footer__list">
									<li><a href="tel:+18002345678">+34 624 23 34 03</a></li>
									<li><a href="mailto:atencionalclient@cinemmagic.com">atencionalclient@cinemmagic.com</a></li>
								</ul>
								<ul class="footer__social">
									<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
									<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>
									<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
									<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>
								</ul>
							</div>
							<!-- end footer list -->
						</div>
					</div>
					</footer>
					<!-- end footer -->

					<!-- JS -->
					<script src="assets/js/jquery-3.3.1.min.js"></script>
					<script src="assets/js/bootstrap.bundle.min.js"></script>
					<script src="assets/js/owl.carousel.min.js"></script>
					<script src="assets/assets/js/jquery.mousewheel.min.js"></script>
					<script src="assets/js/jquery.mCustomScrollbar.min.js"></script>
					<script src="assets/js/wNumb.js"></script>
					<script src="assets/js/nouislider.min.js"></script>
					<script src="assets/js/plyr.min.js"></script>
					<script src="assets/js/jquery.morelines.min.js"></script>
					<script src="assets/js/photoswipe.min.js"></script>
					<script src="assets/js/photoswipe-ui-default.min.js"></script>
					<script src="assets/js/main.js"></script>
</body>

</html>