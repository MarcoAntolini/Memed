<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templeteParams["titolo"] = "Memed - profilo";
    $templeteParams["nome"] = ""; //file da usare 
    $templeteParams["username"] = $_SESSION["username"];
    $templeteParams["profilo"] = $mysqli->getUser($_SESSION["username"]);
    $templeteParams["nFol"] = $mysqli->countFollower($_SESSION["username"]);
    $templeteParams["nSeguiti"] = $mysqli->countSeguiti($_SESSION["username"]);
    $templeteParams["follower"] = $mysqli->getfollower($_SESSION["username"]);
    $templeteParams["seguiti"] = $mysqli->getseguiti($_SESSION["username"]);
    $templeteParams["nPost"] = $mysqli->countPost($_SESSION["username"]);
} else {
    echo 'You are not authorized to access this page, please login. <br/>';
}

require 'template/base.php';