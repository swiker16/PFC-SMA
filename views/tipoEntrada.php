<?php

include '../includes/navbarFunctions.php';
generateNavbar();


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

// Define variables para los campos del formulario
$nombreUsuario = '';
$apellidosUsuario = '';
$correoUsuario = '';


// Si el formulario se envió por POST, procesa las butacas seleccionadas
// Recuperar el número total de butacas desde la URL
$totalButacas = isset($_GET['butacas']) ? $_GET['butacas'] : 0;
$idsButacas = isset($_GET['id']) ? $_GET['id'] : '';
$idsButacasArray = is_array($idsButacas) ? $idsButacas : explode(',', $idsButacas);
$numeroTotalIDs = count($idsButacasArray);




// Si el usuario ha iniciado sesión, obtén los datos del usuario desde la base de datos
if (!empty($_SESSION["Usuario_ID"])) {
    try {
        // Conecta con la base de datos utilizando tu clase de conexión
        include_once '../includes/config.php';
        $conexion = ConnectDatabase::conectar();

        // Prepara y ejecuta la consulta SQL para obtener los datos del usuario
        $consulta = $conexion->prepare("SELECT nombre, apellidos, correo_electronico FROM usuarios WHERE Usuario_ID = :usuario_id");
        $consulta->bindParam(':usuario_id', $_SESSION['Usuario_ID'], PDO::PARAM_INT);
        $consulta->execute();

        // Obtiene los resultados
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Asigna los datos del usuario a las variables
        $nombreUsuario = $resultado['nombre'];
        $apellidosUsuario = $resultado['apellidos'];
        $correoUsuario = $resultado['correo_electronico'];
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
        <meta name="author" content="Dmitry Volkov">
        <title>Magic Cinema - Butacas</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                font-family: 'Open Sans', sans-serif;
                box-shadow: 0 5px 25px 0 rgba(0, 0, 0, 0.3);
                border: 2px solid transparent;
                border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
                border-image-slice: 1;

            }

            table::before {
                background-image: -moz-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
                background-image: -webkit-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
                background-image: -ms-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
                background-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
                -webkit-box-shadow: 0 0 20px 0 rgba(255, 88, 96, 0.5);
                box-shadow: 0 0 20px 0 rgba(255, 88, 96, 0.5);
            }

            th,
            td {
                border: 1px solid #3434;
            }

            th,
            td {
                padding: 15px;
                text-align: left;
            }

            td {
                color: #fff;
            }

            th {
                background-color: #f2f2f2;
            }

            button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 2px 2px;
                cursor: pointer;
            }

            .boton-limite {
                background-color: #d3d3d3;
                /* Color gris para indicar el límite alcanzado */
            }
        </style>

</head>

<body>


    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
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
        <div class="container">

            <form action="procesarCompra.php" method="post" class="sign__form">

                <div class="sign__group">
                    <input type="text" id="nombre" name="nombre" class="sign__input" placeholder="Nombre" value="<?php echo htmlspecialchars($nombreUsuario); ?>" required>
                </div>

                <div class="sign__group">
                    <input type="text" id="apellidos" name="apellidos" class="sign__input" placeholder="Apellidos" value="<?php echo htmlspecialchars($apellidosUsuario); ?>" required>
                </div>
                <div class="sign__group">
                    <input type="email" id="correo" name="correo" class="sign__input" placeholder="Correo Electronico" value="<?php echo htmlspecialchars($correoUsuario); ?>" required>
                </div>
            </form>
            <script>
                // Inicializar el límite de butacas disponibles desde PHP
                var maxEntradas = <?php echo $totalButacas; ?>;
                var totalEntradasSeleccionadas = 0; // Inicializar el total de butacas seleccionadas

                // Resto del código JavaScript...
            </script>

            <table>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <span id="totalEntradasSeleccionadas">0</span>/<span id="maxEntradas"><?php echo $totalButacas; ?></span> Entradas
                    </td>
                </tr>
                <tr>
                    <th>Articulo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td>Normal</td>
                    <td id="precioNormal">8.50</td>
                    <td>
                        <button onclick="decrementarCantidad('cantidadNormal')">-</button>
                        <span id="cantidadNormal">0</span>
                        <button onclick="incrementarCantidad('cantidadNormal')">+</button>
                    </td>
                    <td id="subtotalNormal">0.00</td>
                </tr>
                <tr>
                    <td>Menores de 13 años</td>
                    <td id="precioMenores">6.50</td>
                    <td>
                        <button onclick="decrementarCantidad('cantidadMenores')">-</button>
                        <span id="cantidadMenores">0</span>
                        <button onclick="incrementarCantidad('cantidadMenores')">+</button>
                    </td>
                    <td id="subtotalMenores">0.00</td>
                </tr>
                <tr>
                    <td>Carnet Joven</td>
                    <td id="precioCarnet">6.50</td>
                    <td>
                        <button onclick="decrementarCantidad('cantidadCarnet')">-</button>
                        <span id="cantidadCarnet">0</span>
                        <button onclick="incrementarCantidad('cantidadCarnet')">+</button>
                    </td>
                    <td id="subtotalCarnet">0.00</td>
                </tr>
                <tr>
                    <td>Mayores de 65 años</td>
                    <td id="precioMayores">6.50</td>
                    <td>
                        <button onclick="decrementarCantidad('cantidadMayores')">-</button>
                        <span id="cantidadMayores">0</span>
                        <button onclick="incrementarCantidad('cantidadMayores')">+</button>
                    </td>
                    <td id="subtotalMayores">0.00</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">Total</td>
                    <td id="total">0.00</td>
                </tr>
            </table>

        </div>
        <!-- <input type="text" name="butacasSeleccionadas" value="<?php echo htmlspecialchars($totalButacas); ?>"> -->


    </section>



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
    <!-- end footer -->
    <!-- JS -->
    <script>
        // Función para incrementar la cantidad
        function incrementarCantidad(idCantidad) {
            var cantidadElemento = document.getElementById(idCantidad);
            var cantidad = parseInt(cantidadElemento.innerText);

            // Verificar si se alcanzó el límite de butacas
            if (totalEntradasSeleccionadas < maxEntradas) {
                cantidadElemento.innerText = cantidad + 1;
                totalEntradasSeleccionadas++;
                document.getElementById('totalEntradasSeleccionadas').innerText = totalEntradasSeleccionadas;
                calcularSubtotal(idCantidad);

                // Cambiar el color del botón a gris si se alcanza el límite
                if (totalEntradasSeleccionadas === maxEntradas) {
                    document.getElementById(idCantidad + '-incrementar').classList.add('boton-limite');
                }
            }
        }

        // Función para decrementar la cantidad
        function decrementarCantidad(idCantidad) {
            var cantidadElemento = document.getElementById(idCantidad);
            var cantidad = parseInt(cantidadElemento.innerText);

            if (cantidad > 0) {
                cantidadElemento.innerText = cantidad - 1;
                totalEntradasSeleccionadas--;
                document.getElementById('totalEntradasSeleccionadas').innerText = totalEntradasSeleccionadas;
                calcularSubtotal(idCantidad);

                // Restaurar el color del botón si no se alcanza el límite
                if (totalEntradasSeleccionadas < maxEntradas) {
                    document.getElementById(idCantidad + '-incrementar').classList.remove('boton-limite');
                }
            }
        }

        // Función para calcular el subtotal
        function calcularSubtotal(idCantidad) {
            var cantidadElemento = document.getElementById(idCantidad);
            var cantidad = parseInt(cantidadElemento.innerText);

            // Obtener el precio correspondiente
            var precioId = 'precio' + idCantidad.replace('cantidad', '');
            var precioElemento = document.getElementById(precioId);
            var precio = parseFloat(precioElemento.innerText);

            // Calcular el subtotal
            var subtotal = cantidad * precio;

            // Actualizar el subtotal en la tabla
            var subtotalId = 'subtotal' + idCantidad.replace('cantidad', '');
            var subtotalElemento = document.getElementById(subtotalId);
            subtotalElemento.innerText = subtotal.toFixed(2);

            // Actualizar el total
            actualizarTotal();
        }

        // Función para actualizar el total
        function actualizarTotal() {
            var subtotales = document.querySelectorAll('[id^="subtotal"]');
            var total = 0;

            subtotales.forEach(function(subtotal) {
                total += parseFloat(subtotal.innerText);
            });

            // Actualizar el total en la tabla
            var totalElemento = document.getElementById('total');
            totalElemento.innerText = total.toFixed(2);
        }
    </script>




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