<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Crea Post";
    $templateParams["nome"] = ""; //file da usare 
    $templateParams["username"] = $_SESSION["username"];
    require 'template/logged-base-view.php';
} else {
    header("location: login.php");
}