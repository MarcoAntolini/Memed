<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    if (isset($_POST["Read"])) {
        $mysqli->leggiNotifica($_POST["Read"]);
    }
    if (isset($_POST["cancella"])) {
        $mysqli->cancellaNotifica($_POST["cancella"]);
    }
    if (isset($_POST["cancella-tutto"])) {
        $mysqli->cancellaTutteNotifiche($_SESSION["Username"]);
    }
    if (isset($_POST["leggi-tutto"])) {
        $mysqli->leggiTutteNotifiche($_SESSION["Username"]);
    }
    $templateParams["titolo"] = "Memed - Notifiche";
    $templateParams["nome"] = "notice-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
    $templateParams["Username"] = $_SESSION["Username"];
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["Username"])[0];
    if ($mysqli->ottieniNotifica($_SESSION["Username"])) {
        $templateParams["notifiche"] = true;
    } else {
        $templateParams["notifiche"] = false;
    }
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
