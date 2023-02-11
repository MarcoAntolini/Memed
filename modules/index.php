<?php
require_once "bootstrap.php";

//date_default_timezone_set('Europe/Rome');

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed";
    $templateParams["nome"] = "home-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["username"]);
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
    $templateParams["notifiche"] = $mysqli->ottieniNotifica($_SESSION["username"]);
    require "../template/logged-base-view.php";
    require 'postSettings.php';
} else {
    header("location: login.php");
}
