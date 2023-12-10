<?php
include '../includes/navbarFunctions.php';
NavbarHandler::generateNavbar();


// Redirige al usuario si no ha iniciado sesión
if (empty($_SESSION["Usuario_ID"])) {
    // Puedes manejar la inactividad aquí o simplemente mostrar un mensaje de sesión no iniciada
}

// Verifica el tiempo de inactividad
if (isset($_SESSION['tiempo'])) {
    $inactivo = 40; // Establece el tiempo de inactividad en segundos
    $vida_session = time() - $_SESSION['tiempo'];

    if ($vida_session > $inactivo) {
        session_unset();
        session_destroy();
        // Puedes redirigir o manejar la inactividad aquí
    } else {
        $_SESSION['tiempo'] = time();
    }
} else {
    $_SESSION['tiempo'] = time();
}

// Incluye el archivo de configuración y establece la conexión a la base de datos
include_once '../includes/config.php';
$conexion = ConnectDatabase::conectar();

// Incluye la clase ProcesarPago
include_once '../includes/procesarPago.php';

// Crea una instancia de la clase ProcesarPago con la conexión a la base de datos
$procesarPago = new ProcesarPago($conexion);

// Obtiene los datos necesarios desde la URL
$idsButacas = isset($_GET['idsButacas']) ? $_GET['idsButacas'] : '';
$usuarioId = isset($_SESSION["Usuario_ID"]) ? $_SESSION["Usuario_ID"] : null;
$correoUsuario = isset($_GET['correo']) ? $_GET['correo'] : '';
$id_horario = isset($_GET['idHorario']) ? $_GET['idHorario'] : 1; // Ajusta según tus necesidades
$total = isset($_GET['total']) ? floatval($_GET['total']) : 0.00;

// Actualiza la tabla de usuarios y realiza la reserva

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idsButacas = isset($_POST['idsButacas']) ? htmlspecialchars($_POST['idsButacas']) : '';
    $correoUsuario = isset($_POST['correo']) ? filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL) : '';
    // ... Otros campos del formulario ...

    $procesarPago->actualizarButacas($idsButacas);
    $procesarPago->realizarReserva($idsButacas, $usuarioId, $correoUsuario, $id_horario);
}


// Cierra la conexión después de realizar las operaciones
$conexion = null;

?>
<!DOCTYPE html>
<html lang="es">

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
    <title>Magic Cinema - Pagar</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>


    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
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
                        <h2 class="content__title">Terminar de Pagar</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="container mt-5">
                <h2 style="color:#fff; font-family: 'Open Sans', sans-serif;">Selecciona Método de Pago</h2>
                <div class="form-check">
                    <input style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-input" type="radio" name="metodoPago" value="visa" id="visaRadio" onchange="mostrarSeccion()">
                    <label style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-label" for="visaRadio">
                        Tarjeta Visa
                    </label>
                </div>

                <div class="form-check">
                    <input style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-input" type="radio" name="metodoPago" value="credito" id="creditoRadio" onchange="mostrarCredito()">
                    <label style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-label" for="creditoRadio">
                        Tarjeta de Crédito
                    </label>
                </div>

                <div class="form-check">
                    <input style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-input" type="radio" name="metodoPago" value="paypal" id="paypalRadio" onchange="ocultarSeccion()">
                    <label style="color:#fff; font-family: 'Open Sans', sans-serif;" class="form-check-label" for="paypalRadio">
                        PayPal
                    </label>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <input type="hidden" name="idsButacas" value="<?php echo htmlspecialchars($idsButacas); ?>">
                    <input type="hidden" name="correo" value="<?php echo htmlspecialchars($correoUsuario); ?>">
                    <!-- Tarjeta Visa -->
                    <div class="card mt-3 sign__form" id="visaSection" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#fff; font-family: 'Open Sans', sans-serif;">Tarjeta Visa</h5>

                            <div class="mb-3">
                                <label for="visaNumero" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">Número de Tarjeta</label>
                                <input type="text" class="form-control" id="visaNumero" placeholder="XXXX-XXXX-XXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="visaExpiracion" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">Fecha de Expiración</label>
                                <input type="text" class="form-control" id="visaExpiracion" placeholder="MM/YY">
                            </div>
                            <div class="mb-3">
                                <label for="visaCVV" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">CVV</label>
                                <input type="text" class="form-control" id="visaCVV" placeholder="XXX">
                            </div>
                            <button style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;" type="submit" class="btn btn-primary">Pagar con Visa</button>
                            <p class="my-3" style="color:#fff; font-family: 'Open Sans', sans-serif;">Total: <?php echo $total ?> €</p>

                        </div>
                    </div>

                    <!-- Tarjeta de Crédito -->
                    <div class="card mt-3 sign__form" id="creditoSection" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#fff; font-family: 'Open Sans', sans-serif;">Tarjeta de Crédito</h5>
                            <div class="mb-3">
                                <label for="creditoNumero" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">Número de Tarjeta</label>
                                <input type="number" class="form-control" id="creditoNumero" placeholder="XXXX-XXXX-XXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="creditoExpiracion" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">Fecha de Expiración</label>
                                <input type="text" class="form-control" id="creditoExpiracion" placeholder="MM/YY">
                            </div>
                            <div class="mb-3">
                                <label for="creditoCVV" class="form-label" style="color:#fff; font-family: 'Open Sans', sans-serif;">CVV</label>
                                <input type="text" class="form-control" id="creditoCVV" placeholder="XXX">
                            </div>
                            <button style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;" type="submit" class="btn btn-primary">Pagar con Visa</button>
                            <p class="my-3" style="color:#fff; font-family: 'Open Sans', sans-serif;">Total: <?php echo $total ?> €</p>
                        </div>
                    </div>

                    <!-- PayPal -->
                    <div class="card mt-3 sign__form" id="paypalSection" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#fff; font-family: 'Open Sans', sans-serif;">PayPal</h5>
                            <!-- Puedes agregar el botón de PayPal aquí -->
                            <button style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;" type="button" class="btn btn-primary" onclick="pagarConPayPal()">Pagar con PayPal</button>
                            <p class="my-3" style="color:#fff; font-family: 'Open Sans', sans-serif;">Total: <?php echo $total ?> €</p>

                        </div>
                    </div>
                </form>
            </div>

    </section>

    <script>
        function mostrarSeccion() {
            document.getElementById('visaSection').style.display = 'block';
            document.getElementById('creditoSection').style.display = 'none';
            document.getElementById('paypalSection').style.display = 'none';
        }

        function mostrarCredito() {
            document.getElementById('visaSection').style.display = 'none';
            document.getElementById('creditoSection').style.display = 'block';
            document.getElementById('paypalSection').style.display = 'none';
        }

        function ocultarSeccion() {
            document.getElementById('visaSection').style.display = 'none';
            document.getElementById('creditoSection').style.display = 'none';
            document.getElementById('paypalSection').style.display = 'block';
        }

        function pagarConVisa() {
            var visaNumero = document.getElementById('visaNumero').value;
            var visaExpiracion = document.getElementById('visaExpiracion').value;
            var visaCVV = document.getElementById('visaCVV').value;

            alert('Realizando pago con Tarjeta Visa\nNúmero: ' + visaNumero + '\nExpiración: ' + visaExpiracion + '\nCVV: ' + visaCVV);
        }

        function pagarConCredito() {
            var creditoNumero = document.getElementById('creditoNumero').value;
            var creditoExpiracion = document.getElementById('creditoExpiracion').value;
            var creditoCVV = document.getElementById('creditoCVV').value;

            alert('Realizando pago con Tarjeta de Crédito\nNúmero: ' + creditoNumero + '\nExpiración: ' + creditoExpiracion + '\nCVV: ' + creditoCVV);
        }

        function pagarConPayPal() {
            // Aquí puedes agregar la lógica para redirigir al usuario a la página de PayPal
            alert('Redirigiendo a la página de PayPal');
        }
    </script>
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