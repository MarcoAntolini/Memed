<?php
require_once "bootstrap.php";

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - post salvati";
    $templateParams["nome"] = "saved-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js");
    $templateParams["username"] = $_SESSION["username"];
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}