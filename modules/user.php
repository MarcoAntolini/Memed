<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Profilo";
    $templateParams["nome"] = "user-view.php";
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
        if ($templateParams["utente"] != $templateParams["username"]) {
            if (in_array($templateParams["username"], $templateParams["follower"])) {
                $templateParams["isFollowing"] = true;
            } else {
                $templateParams["isFollowing"] = false;
            }
        }
    }
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    if (isset($_POST["unfollowing"])) {
        $mysqli->cancellaSegui($_POST["unfollowing"], $_SESSION["username"]);
    }
    if (isset($_POST["following"])) {
        $mysqli->inserisciSegue($_POST["following"], $_SESSION["username"]);
    }
    require 'postSettings.php';
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}
