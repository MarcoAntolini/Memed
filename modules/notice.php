<?php
require_once 'bootstrap.php';

if (login_check($mysqli)) {
    if (isset($_POST["Read"])) {
        $mysqli->readNotificationById($_POST["Read"]);
    }
    if (isset($_POST["cancella"])) {
        $mysqli->deleteNotificationById($_POST["cancella"]);
    }
    if (isset($_POST["cancella-tutto"])) {
        $mysqli->deleteAllNotificationsByUsername($_SESSION["Username"]);
    }
    if (isset($_POST["leggi-tutto"])) {
        $mysqli->readAllNotificationsByUsername($_SESSION["Username"]);
    }
    $templateParams["titolo"] = "Memed - Notifiche";
    $templateParams["nome"] = "notice-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
    $templateParams["Username"] = $_SESSION["Username"];
    $templateParams["numNotifiche"] = $mysqli->countNotificationsByUsername($_SESSION["Username"])[0];
    if ($mysqli->getNotificationByUsername($_SESSION["Username"])) {
        $templateParams["notifiche"] = true;
    } else {
        $templateParams["notifiche"] = false;
    }
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
