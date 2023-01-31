<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - profilo";
    $templateParams["nome"] = ""; //file da usare 
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["profilo"] = $mysqli->ottieniUtente($_SESSION["username"]);
    $templateParams["nFol"] = $mysqli->contaFollower($_SESSION["username"]);
    $templateParams["nSeguiti"] = $mysqli->contaSeguiti($_SESSION["username"]);
    $templateParams["follower"] = $mysqli->ottieniFollower($_SESSION["username"]);
    $templateParams["seguiti"] = $mysqli->ottieniSeguiti($_SESSION["username"]);
    $templateParams["nPost"] = $mysqli->contaPost($_SESSION["username"]);
} else {
    echo 'You are not authorized to access this page, please login. <br/>';
}

require 'template/base.php';