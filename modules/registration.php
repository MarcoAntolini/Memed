<?php
require_once 'bootstrap.php';

// Recupero la password criptata dal form di inserimento.
if ($mysqli->ottieniUtente($_POST['username'])) {
   $templateParams['erroreregistrazione'] = 'Username già esistente';
}
if ($mysqli->ottieniEmailDaUtente($_POST['email'])) {
   $templateParams['erroreregistrazione'] = 'Email già esistente';
}
if ($_POST['password'] != $_POST['confirm-password']) {
   $templateParams['erroreregistrazione'] = 'Le password non coincidono';
}
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
// Crea una chiave casuale
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Crea una password usando la chiave appena creata.
$password = hash('sha512', $password . $random_salt);
// Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
// Assicurati di usare statement SQL 'prepared'.
$mysqli->inserisciUtente($username, $email, $password, $salt);

$templateParams["titolo"] = "Registrati | Memed";
$templateParams["nome"] = "../template/register.php";

require "../template/authentication.php";
