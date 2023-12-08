<?php include 'buffer.php'; ?>

<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">

                        <a href="../index.php" class="header__logo">
                            <img src="../assets/img/Magic_Cinema-removebg-preview.png" alt="">
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
                            <a href="../views/html/FormLogin.html" class="header__sign-in mx-1">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Iniciar Sesión</span>
                            </a>
                        </div>

                        <div class="container">
                            <form class="d-flex position-relative" role="search">
                                <input id="busqueda-input" class="form-control m-4" type="search" placeholder="Search" aria-label="Search">
                                <div class="position-absolute start-0 mt-5" id="resultados-busqueda">
                                    
                                </div>
                            </form>
                        </div>

                        <script src="../assets/js/buscar_peliculas_v1.js"></script>
 
                        <button class="header__btn" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>