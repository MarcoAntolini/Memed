<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Profilo";
    $templateParams["username"] = $_SESSION["username"];
    if (isset($_GET["username"])) {
        $utente = $_GET["username"];
        $_SESSION["utente"] = $utente;
        $templateParams["utente"] = $utente;
        $templateParams["profilo"] = $mysqli->ottieniUtente($utente);
        $templateParams["nFol"] = $mysqli->contaFollower($utente);
        $templateParams["nSeguiti"] = $mysqli->contaSeguiti($utente);
        $templateParams["follower"] = $mysqli->ottieniFollower($utente);
        $templateParams["seguiti"] = $mysqli->ottieniSeguiti($utente);
        $templateParams["nPost"] = $mysqli->contaPost($utente);
    }
    if ($templateParams["utente"] != $templateParams["username"]) {
        if ($templateParams["follower"] && $mysqli->controllasesegiu($templateParams["utente"], $templateParams["username"])) {
            $templateParams["isFollowing"] = true;
        } else {
            $templateParams["isFollowing"] = false;
        }
    }
    if (isset($_POST["unfollowing"])) {
        $mysqli->cancellaSegui($_POST["unfollowing"], $_SESSION["username"]);
        header("location: user.php?username=" . $templateParams["utente"]);
    }
    if (isset($_POST["following"])) {
        $mysqli->inserisciSegue($_POST["following"], $_SESSION["username"]);
        header("location: user.php?username=" . $templateParams["utente"]);
    }
    $templateParams["nome"] = "user-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    require 'postSettings.php';
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}
