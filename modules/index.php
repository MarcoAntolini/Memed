<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed";
    $templateParams["nome"] = "home-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js", "../public/assets/js/noticeSection.js");
    $templateParams["Username"] = $_SESSION["Username"];
    $templateParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["Username"]);
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["Username"]);
    $templateParams["notifiche"] = $mysqli->ottieniNotifica($_SESSION["Username"]);
    require "../template/logged-base-view.php";
    require 'postSettings.php';
} else {
    header("location: login.php");
}
