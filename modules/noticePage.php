<?php
require_once 'bootstrap.php';

if ($mysqli->getNotificationByUsername($_SESSION["Username"])) {
    $templateParams["notifiche"] = true;
} else {
    $templateParams["notifiche"] = false;
}
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
$templateParams["notice"] = "notice-view.php";
$templateParams["Username"] = $_SESSION["Username"];
$templateParams["numNotifiche"] = $mysqli->countNotificationsByUsername($_SESSION["Username"])[0];
