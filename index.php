<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Magic Cinema</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Dropdown
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Something else here</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" aria-disabled="true">Disabled</a>
					</li>
				</ul>
				<form class="d-flex" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
		</div>
	</nav>
	<div class="container">

		<?php
		// Incluir el archivo de conexión
		include_once 'includes/config.php';

		$conexion = ConnectDatabase::conectar();

		$sql = "SELECT titulo, imagen FROM carrusel";
		$resultado = $conexion->query($sql);

		if ($resultado->rowCount() > 0) {
		?>
			<div id="carouselExampleFade" class="carousel slide carousel-fade m-5">
				<div class="carousel-inner">
					<?php
					$primero = true; // Variable para destacar la primera imagen
					while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
						$titulo = $registro['titulo'];
						$imagen_binaria = $registro['imagen'];
						$activeClass = $primero ? 'active' : ''; // Asignar la clase 'active' solo a la primera imagen
					?>
						<div class="carousel-item <?php echo $activeClass; ?>">
							<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($imagen_binaria) . '" alt="Imagen de la Película" class="d-block w-100">';
							?>
							<div class="carousel-caption d-none d-md-block text-left">
								<h5 class="display-3"><?php echo $titulo; ?></h5>
							</div>
						</div>

					<?php
						$primero = false; // Después de la primera iteración, establecer la variable a false
					}
					?>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>

		<?php
		}

		?>

<?php
// Obtener las últimas 4 imágenes y títulos de la tabla carrusel
$sql = "SELECT * FROM peliculas ORDER BY pelicula_id DESC LIMIT 4";
$resultado = $conexion->query($sql);

if ($resultado->rowCount() > 0) {
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <?php
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $imagen_binaria = $registro['imagen'];
                $titulo = $registro['titulo'];
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen_binaria); ?>" class="card-img-top" alt="<?php echo $titulo; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $titulo; ?></h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo "<p>No hay imágenes en la tabla carrusel.</p>";
}
?>




	</div>
</body>

</html>