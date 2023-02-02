<?php
require("bootstrap.php");

// TODO: controllare se home, cerca o profilo
$post = $mysqli->ottieniPostPerHome($_SESSION["username"]);

for ($i = 0; $i < count($post); $i++) {
    $post[$i]["nomefile"] = UPLOAD_DIR . $post[$i]["nomefile"];
    $post[$i]["commenti"]  = $mysqli->ottieniCommentiPerPost($post[$i]["idpost"]);
    $post[$i]["reazione1"] = $mysqli->contaReazioniPost(1, $post[$i]["idpost"]);
    $post[$i]["reazione2"] = $mysqli->contaReazioniPost(2, $post[$i]["idpost"]);
    $post[$i]["reazione3"] = $mysqli->contaReazioniPost(3, $post[$i]["idpost"]);
    $post[$i]["reazione4"] = $mysqli->contaReazioniPost(4, $post[$i]["idpost"]);
    $post[$i]["reazione5"] = $mysqli->contaReazioniPost(5, $post[$i]["idpost"]);
}

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($post);