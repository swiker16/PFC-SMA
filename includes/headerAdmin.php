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
    <link rel="icon" type="image/png" href="../icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="../icon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../icon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../icon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../icon/apple-touch-icon-144x144.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Magic Cinema - Administrador</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">

                        <a href="../index.php" class="header__logo">
                            <img src="../../assets/img/Magic_Cinema-removebg-preview.png" alt="">
                        </a>

                        <ul class="header__nav">
                            <li class="header__nav-item">
                                <a href="../views/cartelera.php" class="header__nav-link">Cartelera</a>
                            </li>

                            <li class="header__nav-item">
                                <a href="../views/promociones.php" class="header__nav-link">Promociones</a>
                            </li>

                            <li class="header__nav-item">
                                <a href="../views/experiencias.php" class="header__nav-link">Experiencias</a>
                            </li>

                            <li class="header__nav-item">
                                <a href="../views/contactanos.php" class="header__nav-link">Contactanos</a>
                            </li>
                        </ul>

                        <div class="header__auth">
                            <!-- <form class="d-flex" role="search">
                                <div id="resultados-busqueda"></div>

                                <form class="d-flex" role="search">
                                    <input id="busqueda-input" class="form-control m-4" type="search" placeholder="Search" aria-label="Search">
                                </form>
                                
                                <script src="../assets/js/buscar_peliculas_v2.js"></script>

                            </form> -->
                            <button class="btn btn-primary mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">
                                <?php echo $_SESSION["usuario"]; ?>
                            </button>
                        </div>

                        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="staticBackdropLabel"><?php echo $_SESSION["usuario"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div>
                                    <div class="row my-3">
                                        <div class="col-12 my-2">
                                            <a href="../views/user.php">Ver perfil</a>
                                        </div>
                                        <div class="col-12 my-2">
<a href="../views/crud/peliculas/administrador_pelicula.php">Administradores</a>
</div>
                                    </div>
                                    <form class="d-flex" role="Cerrar sesion" method="POST" action="../includes/cerrarSesion.php">
                                        <button type="submit" class="btn btn-danger" name="logout" style="color:#fff;">Cerrar Sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="header__btn mx-3" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</header>