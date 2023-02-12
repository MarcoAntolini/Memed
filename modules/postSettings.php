<?php
require_once("bootstrap.php");

if (isset($_POST["delete-post"])) {
    $mysqli->cancellaPost($_POST["idpost"]);
}
if (isset($_POST["edit-post"])) {
    $mysqli->modificaPost($_POST["idpost"], $_POST["description"]);
}
if (isset($_POST["save-post"])) {
    $mysqli->inserisciSalva($_SESSION["username"], $_POST["idpost"]);
}
if (isset($_POST["unsave-post"])) {
    $mysqli->cancellaSalva($_SESSION["username"], $_POST["idpost"]);
}
if (isset($_POST["submit-comment"])) {
    if (empty($_POST["comment-text"]) || preg_match('/^[\s]+$/', $string)) {
        return;
    } else {
        $mysqli->inserisciCommento(
            $mysqli->ottieniIdUltimoCommento($_POST["idpost"])[0] + 1,
            $_POST["comment-text"],
            date("Y-m-d H:i:s"),
            $_SESSION["username"],
            $_POST["idpost"]
        );
    }
}
