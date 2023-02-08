<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Impostazioni";
    $templateParams["nome"] = "settings-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/settings.js");
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["profilo"] = $mysqli->ottieniUtente($_SESSION["username"]);
    if (isset($_POST["logout"])) {
        logout();
        header('location: login.php');
    }
    if (isset($_POST["submit"])) {
        // TODO: controllo se l'immagine è stata caricata
        $mysqli->modificaProfilo($_SESSION["username"], $_POST["profile-pic-input"], $_POST["bio"]);
        header('location: user.php?username=' . $_SESSION["username"] . '');
    }
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
