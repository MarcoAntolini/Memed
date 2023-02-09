<?php
    require_once "../modules/bootstrap.php";
    $templateParams["titolo"] = "Memed - Cerca";
    $templateParams["risultati"] = $mysqli->ottieniUtentiPerNome($_GET['search']);
    $res = $templateParams["risultati"];
    $currUser = $_SESSION["username"];
    require "../template/logged-base-view.php";
    require "../template/search-view.php";
