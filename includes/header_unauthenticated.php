<?php
// Limpiar el búfer actual y obtener su contenido
$buffer_content = ob_get_clean();

// Restaurar el búfer y cerrarlo
ob_start();

// Resto del código de header_unauthenticated.php

?>

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
                                <a href="../views/cartelera.php" class="header__nav-link">Cartelera</a>
                            </li>
                            <!-- dropdown -->
                            <li class="header__nav-item">
                                <a href="../views/promociones.php" class="header__nav-link">Promociones</a>
                            </li>
                            <!-- end dropdown -->

                            <li class="header__nav-item">
                                <a href="../views/experiencias.php" class="header__nav-link">Experiencias</a>
                            </li>

                            <li class="header__nav-item">
                                <a href="../views/contactanos.php" class="header__nav-link">Contactanos</a>
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
