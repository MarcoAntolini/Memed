<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Profilo";
    $templateParams["nome"] = "user-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    $templateParams["username"] = $_SESSION["username"];
    if (isset($_GET["username"])) {
        $utente = $_GET["username"];
        $templateParams["utente"] = $utente;
        $templateParams["profilo"] = $mysqli->ottieniUtente($utente);
        $templateParams["nFol"] = $mysqli->contaFollower($utente);
        $templateParams["nSeguiti"] = $mysqli->contaSeguiti($utente);
        $templateParams["follower"] = $mysqli->ottieniFollower($utente);
        $templateParams["seguiti"] = $mysqli->ottieniSeguiti($utente);
        $templateParams["nPost"] = $mysqli->contaPost($utente);
    }
    require '../template/base/logged-base-view.php';
} else {
    header("location: login.php");
}
