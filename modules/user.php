<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Profilo";
    $templateParams["Username"] = $_SESSION["Username"];
    if (isset($_GET["username"])) {
        $utente = $_GET["username"];
        $_SESSION["utente"] = $utente;
        $templateParams["utente"] = $utente;
        $templateParams["profilo"] = $mysqli->getUserByUsername($utente);
        $templateParams["nFol"] = $mysqli->countFollowersByFollowedUsername($utente);
        $templateParams["nSeguiti"] = $mysqli->countFollowedByFollowerUsername($utente);
        $templateParams["follower"] = $mysqli->getAllFollowersByFollowedUsername($utente);
        $templateParams["seguiti"] = $mysqli->getAllFollowedByFollowerUsername($utente);
        $templateParams["nPost"] = $mysqli->countPostsByUsername($utente);
    }
    if ($templateParams["utente"] != $templateParams["Username"]) {
        if ($templateParams["follower"] && $mysqli->checkFollow($templateParams["utente"], $templateParams["Username"])) {
            $templateParams["isFollowing"] = true;
        } else {
            $templateParams["isFollowing"] = false;
        }
    }
    if (isset($_POST["unfollowing"])) {
        $mysqli->deleteFollow($_POST["unfollowing"], $_SESSION["Username"]);
        header("location: user.php?username=" . $templateParams["utente"]);
    }
    if (isset($_POST["following"])) {
        $mysqli->insertFollow($_POST["following"], $_SESSION["Username"]);
        header("location: user.php?username=" . $templateParams["utente"]);
    }
    $templateParams["nome"] = "user-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js", "../public/assets/js/noticeSection.js");
    require 'postSettings.php';
    require '../template/logged-base-view.php';
} else {
    header("location: login.php");
}
