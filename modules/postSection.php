<?php
require("bootstrap.php");

if (isset($_GET["url"])) {
    switch ($_GET["url"]) {
        case "index.php":
            $post = $mysqli->ottieniPostPerHome($_SESSION["Username"]);
            break;
        case "user.php":
            $post = $mysqli->ottieniPostDaUtente($_SESSION["utente"]);
            break;
        case "explore.php":
            if (isset($_SESSION["categoria"]) && $_SESSION["categoria"] != 0) {
                $post = $mysqli->ottieniPostDaCategoria($_SESSION["categoria"], $_SESSION["Username"]);
            } else {
                $post = $mysqli->ottieniPostPerEsplora($_SESSION["Username"]);
            }
            break;
        case "saved.php":
            $post = $mysqli->ottieniPostSalvati($_SESSION["Username"]);
            break;
        default:
            $post = NULL;
            break;
    }

    if ($post != NULL) {
        for ($i = 0; $i < count($post); $i++) {
            $post[$i]["FileName"] = UPLOAD_DIR . $post[$i]["FileName"];
            $post[$i]["commenti"]  = $mysqli->ottieniCommentiPerPost($post[$i]["PostID"]);
            $post[$i]["reazione1"] = $mysqli->contaReazioniPost(1, $post[$i]["PostID"]);
            $post[$i]["reazione2"] = $mysqli->contaReazioniPost(2, $post[$i]["PostID"]);
            $post[$i]["reazione3"] = $mysqli->contaReazioniPost(3, $post[$i]["PostID"]);
            $post[$i]["reazione4"] = $mysqli->contaReazioniPost(4, $post[$i]["PostID"]);
            $post[$i]["reazione5"] = $mysqli->contaReazioniPost(5, $post[$i]["PostID"]);
            $post[$i]["session-username"] = $_SESSION["Username"];
            $post[$i]["controllaSalva"] = $mysqli->controllaSalva($_SESSION["Username"], $post[$i]["PostID"]);
            $post[$i]["reazione-attiva"] = $mysqli->ottieniReazionePost($post[$i]["PostID"], $_SESSION["Username"]);
        }
    }

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($post);
}
