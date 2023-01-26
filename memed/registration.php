<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["emal"]) && isset($_POST["password"]) && isset($_POST["confermapassword"])){
    if(!$dbh->getUserByusername($_POST["username"]) && $_POST["password"]==$_POST["confermapassword"]){
        $dbh->inserisciUtente($_POST["username"], $_POST["emal"], $_POST["password"]);
        $user = $dbh->getUserLogin($_POST["username"], $_POST["password"]);
        registerLoggedUser($user["username"]);
        header("Location: index.php");
    }else{
        $templateParams["erroreregistrazione"] = "Username already exists";
    }


}

$templateParams["titolo"] = "Memed registration";
$templateParams["nome"] = ""; //file da usare
?>