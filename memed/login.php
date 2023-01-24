<?php
require_once 'bootstrap.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = $dbh->getUser($username, $password);
    if ($user) {
        registerLoggedUser($user["IDuser"]);
        header("Location: index.php");
    } else {
        echo "Username or password is incorrect";
    }
}

$templateParams["titolo"] = "Memed";
$templeteParams["nome"]=""; //file da usare 