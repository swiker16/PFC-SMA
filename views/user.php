<?php
include '../includes/navbarFunctions.php';
generateNavbar();

if (empty($_SESSION["usuario"])) {

    header("Location: ../index.php");
    exit();
}

// Si el usuario ha iniciado sesión, obtén los datos del usuario desde la base de datos
if (!empty($_SESSION["Usuario_ID"])) {
    try {
        // Conecta con la base de datos utilizando tu clase de conexión
        include_once '../includes/config.php';
        $conexion = ConnectDatabase::conectar();

        // Prepara y ejecuta la consulta SQL para obtener los datos del usuario
        $consulta = $conexion->prepare("SELECT nombre, apellidos, correo_electronico, imagen FROM usuarios WHERE Usuario_ID = :usuario_id");
        $consulta->bindParam(':usuario_id', $_SESSION['Usuario_ID'], PDO::PARAM_INT);
        $consulta->execute();

        // Obtiene los resultados
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Asigna los datos del usuario a las variables
        $nombreUsuario = $resultado['nombre'];
        $apellidosUsuario = $resultado['apellidos'];
        $correoUsuario = $resultado['correo_electronico'];
        // Verifica si la columna 'imagen' tiene un valor no nulo
        if (!empty($resultado['imagen'])) {
            // Si hay una imagen en la base de datos, muestra esa imagen
            $imagenUsuario = 'data:image/jpeg;base64,' . base64_encode($resultado['imagen']);
        } else {
            // Si no hay imagen en la base de datos, muestra la imagen predeterminada
            $imagenUsuario = '../assets/img/blank-profile-picture-973460_960_720.webp';
        }
    } catch (PDOException $e) {
        // Maneja cualquier error en la conexión o la consulta
        echo "Error: " . $e->getMessage();
    } finally {
        // Cierra la conexión
        $conexion = null;
    }
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
    <title>Magic Cinema - Perfil</title>

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
                        <h2 class="content__title">Perfil <?php echo $_SESSION["usuario"]; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <form  id="updateForm" action="../includes/updatePerfil.php" method="post" enctype="multipart/form-data" class="sign__form">
                <div class="col-md-3 border-right sign__group">
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($_SESSION['Usuario_ID']); ?>">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle" width="250px" height="200px" src="<?php echo htmlspecialchars($imagenUsuario); ?>">
                        <input style="color:#fff; font-family: 'Open Sans', sans-serif;" type="file" id="imagenInput" name="imagen" accept="image/*" class="mt-5">
                    </div>
                </div>
                <div class="sign__group">
                    <input style="cursor: not-allowed; " type="text" id="nombre" name="nombre" class="sign__input" placeholder="Nombre" value="<?php echo htmlspecialchars($nombreUsuario); ?>" readonly required>
                </div>

                <div class="sign__group">
                    <input style="cursor: not-allowed;" type="text" id="apellidos" name="apellidos" class="sign__input" placeholder="Apellidos" value="<?php echo htmlspecialchars($apellidosUsuario); ?>" readonly required>
                </div>
                <div class="sign__group">
                    <input style="cursor: not-allowed;" type="email" id="correo" name="correo" class="sign__input" placeholder="Correo Electronico" value="<?php echo htmlspecialchars($correoUsuario); ?>" readonly required>
                </div>
                <button class="" style="font-family: 'Open Sans', sans-serif; background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">Continuar</button>

            </form>
        </div>

    </section>

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