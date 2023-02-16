<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Impostazioni";
    $templateParams["nome"] = "settings-view.php";
    $templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/settings.js", "../public/assets/js/noticeSection.js");
    $templateParams["Username"] = $_SESSION["Username"];
    $templateParams["profilo"] = $mysqli->ottieniUtente($_SESSION["Username"]);
    if (isset($_POST["logout"])) {
        logout();
        header('location: login.php');
    }
    require "../template/logged-base-view.php";
} else {
    header("location: login.php");
}
