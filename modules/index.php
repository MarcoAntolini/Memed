<?php
require_once "bootstrap.php";

// if(login_check($mysqli) == true) {
$templateParams["titolo"] = "Memed";
$templateParams["nome"] = "../template/registration.php"; //file da usare 
// $templateParams["username"] = $_SESSION["username"];
// $templateParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["username"]);
// $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
//  } else {
//     echo 'You are not authorized to access this page, please login. <br/>';
//     require "../template/login.php";
//  }

// TODO: template base login/register
require "../template/baseUnlogged.php";
