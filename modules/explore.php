<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Esplora";
    $templateParams["nome"] = "../template/explore-view.php";
    $templateParams["categorie"] = $mysqli->ottieniCategorie();
    if (isset($_POST["categoria"])) {
        $_SESSION["categoria"] = $_POST["categoria"];
    }
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    require 'postSettings.php';
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
