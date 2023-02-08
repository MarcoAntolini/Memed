<?php 
    require_once "../modules/bootstrap.php";
    $templateParams["titolo"] = "Memed - Ricerca";
    $templateParams["risultati"] = $mysqli->ottieniUtentiPerNome($_GET['search']);
    require "../template/logged-base-view.php";
    require "../template/search-view.php";
    /* TODO:
        add onclick='follow()' to button
    */
