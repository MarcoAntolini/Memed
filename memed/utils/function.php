<?php

function registerLoggedUser($user){
    $_SESSION["IDuser"] = $user["IDuser"];
    $_SESSION["username"] = $user["username"];
}

?>

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = $dbh->getUser($username, $password);
    if ($user) {
        registerLoggedUser($user);
        header("Location: index.php");
    } else {
        echo "Username or password is incorrect";
    }
}