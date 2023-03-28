<?php
require_once 'bootstrap.php';

if (checkLogin($mysqli) == true) {
    $_SESSION["categoria"] = 0;
    $templateParams["titolo"] = "Memed - Esplora";
    $templateParams["nome"] = "explore-view.php";
    $templateParams["categorie"] = $mysqli->getCategories();
    if (isset($_POST["categoria"])) {
        $_SESSION["categoria"] = $_POST["categoria"];
    }
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js", "../public/assets/js/noticeSection.js");
    require 'postSettings.php';
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
