<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Impostazioni";
    $templateParams["nome"] = "settings-view.php";
    $templateParams["username"] = $_SESSION["username"];
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
