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

                            <a href="../views/html/FormLogin.html" class="header__sign-in mx-1">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Iniciar Sesión</span>
                            </a>
                        </div>
                        <!-- Formulario de búsqueda -->
                        <div class="container">
                        <form class="d-flex position-relative" role="search">
                            <input id="busqueda-input" class="form-control m-4" type="search" placeholder="Search" aria-label="Search">
                            <div class="position-absolute start-0 mt-5" id="resultados-busqueda">
                                
                            </div>
                        </form>
                        </div>

                        <script>
                            // Función para manejar la búsqueda en tiempo real
                            function buscarPeliculas() {
                                // Obtener el valor del input de búsqueda
                                var busqueda = document.getElementById('busqueda-input').value;

                                // Realizar la solicitud AJAX al servidor
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        // Obtener la lista desplegable
                                        var dropdown = document.getElementById('resultados-busqueda');

                                        // Limpiar los elementos antiguos
                                        dropdown.innerHTML = '';

                                        // Obtener los resultados y agregarlos al dropdown
                                        var resultados = xhr.responseText.split(';');
                                        resultados.forEach(function(resultado) {
                                            var listItem = document.createElement('li');
                                            listItem.innerHTML = resultado;
                                            listItem.className = 'dropdown-item';
                                            dropdown.appendChild(listItem);
                                        });

                                        // Mostrar el dropdown si hay resultados
                                        if (busqueda !== '' && resultados.length > 0) {
                                            dropdown.style.display = 'block';
                                        } else {
                                            dropdown.style.display = 'none';
                                        }
                                    }
                                };

                                // Configurar y enviar la solicitud
                                xhr.open('GET', '../includes/buscar_peliculas.php?q=' + busqueda, true);
                                xhr.send();
                            }

                            // Escuchar los cambios en el input de búsqueda
                            document.getElementById('busqueda-input').addEventListener('input', buscarPeliculas);
                        </script>
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