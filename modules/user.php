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
    if (isset($_POST["post-comment"])) {
        $mysqli->inserisciCommento(
            $mysqli->ottieniIdUltimoCommento() + 1,
            $_POST["comment-text"],
            date("20y-m-d h:m:s"),
            $_SESSION["username"],
            $_POST["idpost"]
        );
    }
    if(isset($_POST["delete-post"])) {
        $mysqli->cancellaPost($_POST["idpost"]);
    }
    if(isset($_POST["save-post"])) {
        $mysqli->inserisciSalva($_SESSION["username"], $_POST["idpost"]);
    }
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}
