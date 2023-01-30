<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templeteParams["titolo"] = "Memed - profilo";
    $templeteParams["nome"] = ""; //file da usare 
    $templeteParams["username"] = $_SESSION["username"];
    $templeteParams["profilo"] = $mysqli->ottieniUtente($_SESSION["username"]);
    $templeteParams["nFol"] = $mysqli->contaFollower($_SESSION["username"]);
    $templeteParams["nSeguiti"] = $mysqli->contaSeguiti($_SESSION["username"]);
    $templeteParams["follower"] = $mysqli->ottieniFollower($_SESSION["username"]);
    $templeteParams["seguiti"] = $mysqli->ottieniSeguiti($_SESSION["username"]);
    $templeteParams["nPost"] = $mysqli->contaPost($_SESSION["username"]);
} else {
    echo 'You are not authorized to access this page, please login. <br/>';
}

require 'template/base.php';