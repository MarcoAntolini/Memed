<?php
require_once 'bootstrap.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
   if ($mysqli->ottieniUtente($_POST['username'])) {
      $templateParams['erroreregistrazione'] = 'Username già esistente';
   } else if ($mysqli->ottieniUtenteDaEmail($_POST['email'])) {
      $templateParams['erroreregistrazione'] = 'Email già esistente';
   } else if ($_POST['password'] != $_POST['confirm-password']) {
      $templateParams['erroreregistrazione'] = 'Le password non coincidono';
   } else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      $password = hash('sha512', $password . $random_salt);
      $mysqli->inserisciUtente($username, $email, $password, $random_salt);
      header('Location: ../modules/login.php');
      // TODO: qualcosa a schermo per dire che si è registrato
   }
}

$templateParams["titolo"] = "Memed - Registrati";
$templateParams["nome"] = "../template/register-view.php";

require "../template/base/unlogged-base-view.php";
