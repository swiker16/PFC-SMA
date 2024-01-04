<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verificationCode = $_POST["verificationCode"];
    $userID = $_POST["userID"];


    include_once '../includes/config.php';
    $db = ConnectDatabase::conectar();
    $sql = "SELECT * FROM check_codes WHERE usuarios_id = :userID AND code = :code AND expiration_time > NOW()";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':code', $verificationCode, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {

        header("location: ../index.php");
        exit;
    } else {
        session_destroy();
        header("location: ../views/html/FormLogin.html ");
        exit;
    }
} else {
    exit;
}


?>
