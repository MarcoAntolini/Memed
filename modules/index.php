<?php
require_once "bootstrap.php";

if(login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/index.js");
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["username"]);
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
    $templateParams["notifiche"] = $mysqli->ottieniNotifica($_SESSION["username"]);
    require "../modules/base.php";
} else {
    require "../modules/login.php";
}