<?php
require_once 'bootstrap.php';

if ($mysqli->ottieniNotifica($_SESSION["Username"])) {
    $templateParams["notifiche"] = true;
} else {
    $templateParams["notifiche"] = false;
}
if (isset($_POST["letto"])) {
    $mysqli->leggiNotifica($_POST["letto"]);
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
$templateParams["notice"] = "notice-view.php";
$templateParams["Username"] = $_SESSION["Username"];
$templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["Username"])[0];
