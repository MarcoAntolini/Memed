<?php
require_once "bootstrap.php";

//date_default_timezone_set('Europe/Rome');

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["posthome"] = $mysqli->ottieniPostPerHome($_SESSION["username"]);
    $templateParams["numNotifiche"] = $mysqli->contaNotifiche($_SESSION["username"]);
    $templateParams["notifiche"] = $mysqli->ottieniNotifica($_SESSION["username"]);
    if (isset($_POST["post-comment"])) {
        $mysqli->inserisciCommento(
            $mysqli->ottieniIdUltimoCommento() + 1,
            $_POST["comment-text"],
            date("20y-m-d h:m:s"),
            $_SESSION["username"],
            $_POST["idpost"]
        );
    }
    require "../template/base.php";
} else {
    require "../modules/login.php";
}