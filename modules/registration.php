<?php
require_once 'bootstrap.php';

// Recupero la password criptata dal form di inserimento.
if($mysqli->ottieniUtente($_POST['username'])){
      $error_msg .= '<p class="error">Username già esistente</p>';
}
if($mysqli->ottieniUtenteemail($_POST['email'])){
      $error_msg .= '<p class="error">Email già esistente</p>';
}
if($_POST['password'] != $_POST['confirm-password']){
      $error_msg .= '<p class="error">Le password non coincidono</p>';
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
if ($insert_stmt = $mysqli->getMysqli()->prepare("INSERT INTO utenti (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
   $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
   // Esegui la query ottenuta.
   $insert_stmt->execute();
}

$templateParams["titolo"] = "Memed registration";
$templateParams["nome"] = "../template/register.php";

require "../template/......php"; //file da usare
//TODO
?>