<!DOCTYPE html>
<html lang="es">

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
    <link rel="icon" type="image/png" href="../assets/icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="../assets/icon/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/icon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/icon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/icon/apple-touch-icon-144x144.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Magic Cinema - Codigo de verificación</title>
</head>

<body class="body">
<?php



 if (isset($_GET["userID"])) {
    $userID = $_GET["userID"];
    echo '
    <div class="sign section--bg" data-bg="../assets/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <form id="verificationForm" action="../includes/code.php" method="post" class="sign__form" onsubmit="return validateForm()">
                            <a href="../../index.php" class="sign__logo">
                                <img src="../../assets/img/logo.png" alt="">
                            </a>

                            <h4 style="color: #fff; font-family: \'Open Sans\', sans-serif;" class="mb-5">Codigo de Verificación</h4>

                            <!-- Campo oculto para almacenar el ID de usuario -->
                            <input type="hidden" name="userID" value="' . htmlspecialchars($userID) . '">

                            <div class="sign__group">
                                <!-- Único código -->
                                <input type="text" id="verificationCode" name="verificationCode" class="sign__input" placeholder="Codigo de Verificación" required>
                            </div>

                            <button class="sign__btn" type="submit">Enviar</button>

                            <div id="countdown" style="color: #fff; font-family: \'Open Sans\', sans-serif;" class="my-4">Tiempo restante: 1:00</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
} else {
    // Manejo del caso en el que el parámetro userID no está presente
    echo "Error: ID de usuario no encontrado en la URL.";
}

?>

    <!-- JS -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.mousewheel.min.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="../assets/js/wNumb.js"></script>
    <script src="../assets/js/nouislider.min.js"></script>
    <script src="../assets/js/plyr.min.js"></script>
    <script src="../assets/js/jquery.morelines.min.js"></script>
    <script src="../assets/js/photoswipe.min.js"></script>
    <script src="../assets/js/photoswipe-ui-default.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
        function validateForm() {
            var verificationCode = document.getElementById('verificationCode').value;

            if (verificationCode.length !== 6) {
                alert('Verification code must be 6 characters long.');
                return false;
            }

            // Additional validation logic can be added here

            return true;
        }

        // Countdown timer
        var countdownElement = document.getElementById('countdown');
        var countdown = 60; // 1 minute

        function updateCountdown() {
            var minutes = Math.floor(countdown / 60);
            var seconds = countdown % 60;

            countdownElement.textContent = 'Tiempo restante: ' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

            if (countdown > 0) {
                countdown--;
                setTimeout(updateCountdown, 1000); // Update every second
            } else {
                countdownElement.textContent = 'Tiempo agotado';
                // Optionally, you can perform an action when the countdown reaches zero
            }
        }

        // Start the countdown when the page loads
        updateCountdown();
    </script>
</body>

</html>