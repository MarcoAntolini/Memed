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

$templateParams["titolo"] = "Memed - Login";
$templateParams["nome"] = "../template/login-view.php";

require "../template/base/unlogged-base-view.php";
