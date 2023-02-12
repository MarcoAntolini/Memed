<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    if (isset($_POST["letto"])) {
        $mysqli->leggiNotifica($_POST["letto"]);
    }
    if (isset($_POST["cancella"])) {
        $mysqli->cancellaNotifica($_POST["cancella"]);
    }
    if (isset($_POST["cancella-tutto"])) {
        $mysqli->cancellaTutteNotifiche($_SESSION["username"]);
    }
    if (isset($_POST["leggi-tutto"])) {
        $mysqli->leggiTutteNotifiche($_SESSION["username"]);
    }
    $templateParams["titolo"] = "Memed - Notifiche";
    $templateParams["nome"] = "notice-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"])[0];
    if ($mysqli->ottieniNotifica($_SESSION["username"])) {
        $templateParams["notifiche"] = true;
    } else {
        $templateParams["notifiche"] = false;
    }
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
