<?php
require_once "../modules/bootstrap.php";
$templateParams["titolo"] = "Memed - Cerca";
$templateParams["nome"] = "search-view.php";
$templateParams["risultati"] = $mysqli->getUserLikeUsername($_GET['search']);
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
$usersList = $templateParams["risultati"];
$currUser = $_SESSION["LoggedUsername"];
if (isset($_POST["unfollowing"])) {
	$mysqli->deleteFollow($_POST["unfollowing"], $_SESSION["LoggedUsername"]);
}
if (isset($_POST["following"])) {
	$mysqli->insertFollow($_POST["following"], $_SESSION["LoggedUsername"]);
}
require "../template/logged-base-view.php";
