<?php
require_once 'bootstrap.php';

if(isset($_POST['email'], $_POST['password'])) { 
    $email = $_POST['email'];
    $password = $_POST['password']; // Recupero la password criptata.
    if(login($email, $password, $mysqli) == true) {
       // Login eseguito
      header('Location: ../index.php');
    } else {
       // Login fallito
       $templateParams['errorerelogin'] = 'email o password errati';
    }
 } else { 
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
 }

$templateParams["titolo"] = "Login | Memed";
$templateParams["nome"]="../template/login.php";

require "../template/......php"; //file da usare
//TODO
?>