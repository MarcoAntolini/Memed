<?php
require_once "../modules/bootstrap.php";
$templateParams["titolo"] = "Memed - Cerca";
$templateParams["risultati"] = $mysqli->ottieniUtentiPerNome($_GET['search']);
require "../template/logged-base-view.php";
require "../template/search-view.php";
    /* TODO:
        add onclick='follow()' to button
        add href to username
        add bio
        add photo (in the db tho) and replace the svg
        add js to disable input if empty
    */
