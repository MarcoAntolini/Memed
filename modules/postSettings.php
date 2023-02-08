<?php
require_once("bootstrap.php");

if (isset($_POST["delete-post"])) {
    $mysqli->cancellaPost($_POST["idpost"]);
}
if (isset($_POST["edit-post"])) {
    // $mysqli->inserisciMiPiace($_SESSION["username"], $_POST["idpost"]);
}
if (isset($_POST["save-post"])) {
    $mysqli->inserisciSalva($_SESSION["username"], $_POST["idpost"]);
}
if (isset($_POST["unsave-post"])) {
    // $mysqli->cancellaSalva($_SESSION["username"], $_POST["idpost"]);
}
if (isset($_POST["post-comment"])) {
    $mysqli->inserisciCommento(
        $mysqli->ottieniIdUltimoCommento()[0] + 1,
        $_POST["comment-text"],
        date("Y-m-d H:i:s"),
        $_SESSION["username"],
        $_POST["idpost"]
    );
}

