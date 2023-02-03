<?php
require_once 'bootstrap.php';

// TODO: controllare se è desktop o mobile
if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Notifiche";
    $templateParams["nome"] = ""; //file da usare 
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
    $templateParams["notifiche"] = $mysqli->ottieniNotifica($_SESSION["username"]);
} else {
    echo 'You are not authorized to access this page, please login. <br/>';
}

require 'template/logged-base-view.php';