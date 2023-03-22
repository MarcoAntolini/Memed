<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Crea Post";
    $templateParams["nome"] = "newPost-view.php";
    $templateParams["Username"] = $_SESSION["Username"];
    $templateParams["categorie"] = $mysqli->getCategories();
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}
