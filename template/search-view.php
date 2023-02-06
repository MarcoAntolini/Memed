<?php 
    require_once 'bootstrap.php';
    require 'logged-base-view.php';
    $templateParams["nome"] = "Memed - Cerca";
    $templateParams["results"] = $mysqli->ottieniUtentiPerNome($_GET['search']);