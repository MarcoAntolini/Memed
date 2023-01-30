<?php
require_once "bootstrap.php";

// if(login_check($mysqli) == true) {
$templeteParams["titolo"] = "Memed";
$templeteParams["nome"] = ""; //file da usare 
$templeteParams["username"] = $_SESSION["username"];
$templeteParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["username"]);
$templeteParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
//  } else {
//     echo 'You are not authorized to access this page, please login. <br/>';
//     require "../template/login.php";
//  }

require "../template/home.php";