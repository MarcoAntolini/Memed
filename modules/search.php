<?php
require_once "../modules/bootstrap.php";
$templateParams["titolo"] = "Memed - Cerca";
$templateParams["nome"] = "search-view.php";
$templateParams["risultati"] = $mysqli->getUserLikeUsername($_GET['search']);
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
$res = $templateParams["risultati"];
$currUser = $_SESSION["Username"];
require "../template/logged-base-view.php";
