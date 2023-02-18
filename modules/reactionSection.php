<?php
require("bootstrap.php");

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli->inserisciReazionePost($data["Username"], (int) $data["post-id"], $data["ReactionID"]);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $port[1] = $mysqli->contaReazioniPost(1, $_GET["post-id"]);
    $port[2] = $mysqli->contaReazioniPost(2, $_GET["post-id"]);
    $port[3] = $mysqli->contaReazioniPost(3, $_GET["post-id"]);
    $port[4] = $mysqli->contaReazioniPost(4, $_GET["post-id"]);
    $port[5] = $mysqli->contaReazioniPost(5, $_GET["post-id"]);
    $port["reazione-attiva"] = $mysqli->ottieniReazionePost($_GET["post-id"], $_SESSION["Username"]);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($port);
}
