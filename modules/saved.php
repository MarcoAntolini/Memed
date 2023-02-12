<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Post Salvati";
    $templateParams["nome"] = "saved-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js", "../public/assets/js/noticeSection.js");
    $templateParams["username"] = $_SESSION["username"];
    require 'postSettings.php';
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
