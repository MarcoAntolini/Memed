<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Crea Post";
    $templateParams["nome"] = "newPost-view.php";
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["categorie"] = $mysqli->ottieniCategorie();
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}