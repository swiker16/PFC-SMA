<?php
include '../includes/navbarFunctions.php';
NavbarHandler::generateNavbar();

?>
<!DOCTYPE html>
<html lang="es">


<body class="body">

    <?php
    include_once '../includes/carteleraFunctions.php';

    BillboardHandler::mostrarTopPeliculas();
    ?>

    <!-- end home -->

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <!-- content title -->
                        <h2 class="content__title">Cartelera</h2>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include_once '../includes/carteleraFunctions.php';
        
        BillboardHandler::mostrarCartelera();
        ?>
        
        <!-- end content tabs -->
        </div>
    </section>
    <!-- end content -->

    <!-- footer -->
    <?php require_once("footer.php");?>
    <!-- end footer -->

    <!-- JS -->
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