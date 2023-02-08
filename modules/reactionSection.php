<?php
require("bootstrap.php");

$data= json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli->inserisciReazionePost($data["username"], $data["idpost"], $data["idreazione"]);
    $port = $mysqli->contaReazioniPost($data["idreazione"], $data["idpost"]);
}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    $port = $mysqli->contaReazioniPost($_GET["idreazione"], $_GET["idpost"]);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($port);
}


