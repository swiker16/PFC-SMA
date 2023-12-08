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
                        
                            <button class="btn btn-primary mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">
                                <?php echo $_SESSION["usuario"]; ?>
                            </button>
                        </div>

                        <div class="container">
                            <form class="d-flex position-relative" role="search">
                                <input id="busqueda-input" class="form-control m-4" type="search" placeholder="Search" aria-label="Search">
                                <div class="position-absolute start-0 mt-5" id="resultados-busqueda">
                                    
                                </div>
                            </form>
                        </div>
                        
                        <script src="../assets/js/buscar_peliculas_v1.js"></script>

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
                                            <a href="../views/reservas.php">Mis reservas</a>
                                        </div>
                                    </div>
                                    <form class="d-flex" role="Cerrar sesion" method="POST" action="../includes/cerrarSesion.php">
                                        <button type="button" class="btn btn-danger" name="logout"><a href="../includes/cerrarSesion.php" style="color:#fff;">Cerrar Sesión</a></button>
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