<?php 
    require_once "../modules/bootstrap.php";
    $templateParams["titolo"] = "Memed - Ricerca";
    $templateParams["risultati"] = $mysqli->ottieniUtentiPerNome($_GET['search']);
    $res = $templateParams["risultati"];
    if (empty($res)) {
        echo "Nessun risultato.";
    }
    foreach ($res as $r) {
        echo $r["username"] . '<br>';
    }
    require "../template/logged-base-view.php";