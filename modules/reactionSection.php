<?php
require("bootstrap.php");

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli->inserisciReazionePost($data["username"], (int) $data["idpost"], $data["idreazione"]);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $port[1] = $mysqli->contaReazioniPost(1, $_GET["idpost"]);
    $port[2] = $mysqli->contaReazioniPost(2, $_GET["idpost"]);
    $port[3] = $mysqli->contaReazioniPost(3, $_GET["idpost"]);
    $port[4] = $mysqli->contaReazioniPost(4, $_GET["idpost"]);
    $port[5] = $mysqli->contaReazioniPost(5, $_GET["idpost"]);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($port);
}
