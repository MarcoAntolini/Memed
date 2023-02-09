<?php
    require_once "../modules/bootstrap.php";
    $currUser = $_SESSION["username"];
    $username = $_POST["username"];
    if ($mysqli->controllaSegue($username, $currUser)) {
        $mysqli->cancellaSegui($username, $currUser);
    } else {
        $mysqli->inserisciSegue($username, $currUser);
    }