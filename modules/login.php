<?php
require_once 'bootstrap.php';

if (isset($_POST['email'], $_POST['password'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   if (login($email, $password, $mysqli) == true) {
      header('Location: ../modules/index.php');
   } else {
      $templateParams['errorelogin'] = 'email o password errati';
   }
}

$templateParams["titolo"] = "Login | Memed";
$templateParams["nome"] = "../template/login.php";

require "../template/baseUnlogged.php";