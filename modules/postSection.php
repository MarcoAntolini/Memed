<?php
require("bootstrap.php");
if (isset($_GET["url"])) {
    switch ($_GET["url"]) {
        case "index.php":
            $post = $mysqli->ottieniPostPerHome($_SESSION["username"]);
            break;
        case "user.php":
            $post = $mysqli->ottieniPostDaUtente($_SESSION["utente"]);
            break;
        case "explore.php":
            if (isset($_SESSION["categoria"]) && $_SESSION["categoria"] != 0) {
                $post = $mysqli->ottieniPostDaCategoria($_SESSION["categoria"]);
            } else {
                $post = $mysqli->ottieniPostPerEsplora($_SESSION["username"]);
            }
            break;
        case "saved.php":
            $post = $mysqli->ottieniPostSalvati($_SESSION["username"]);
            break;
        default:
            $post = NULL;
            break;
    }

    if ($post != NULL) {
        for ($i = 0; $i < count($post); $i++) {
            $post[$i]["nomefile"] = UPLOAD_DIR . $post[$i]["nomefile"];
            $post[$i]["commenti"]  = $mysqli->ottieniCommentiPerPost($post[$i]["idpost"]);
            $post[$i]["reazione1"] = $mysqli->contaReazioniPost(1, $post[$i]["idpost"]);
            $post[$i]["reazione2"] = $mysqli->contaReazioniPost(2, $post[$i]["idpost"]);
            $post[$i]["reazione3"] = $mysqli->contaReazioniPost(3, $post[$i]["idpost"]);
            $post[$i]["reazione4"] = $mysqli->contaReazioniPost(4, $post[$i]["idpost"]);
            $post[$i]["reazione5"] = $mysqli->contaReazioniPost(5, $post[$i]["idpost"]);
            $post[$i]["session-username"] = $_SESSION["username"];
            $post[$i]["controllaSalva"] = $mysqli->controllaSalva($_SESSION["username"], $post[$i]["idpost"]);
        }
    }

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($post);
}
