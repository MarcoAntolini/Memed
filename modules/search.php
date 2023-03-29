<?php

require_once "bootstrap.php";

$templateParams["title"] = "Memed - Cerca";
$templateParams["page"] = "search-view.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");

$templateParams["risultati"] = $mysqli->users()->getUserLikeUsername($_GET['search']);
$usersList = $templateParams["risultati"];
$currUser = $_SESSION["LoggedUser"];
if (isset($_POST["unfollowing"])) {
	$mysqli->follows()->deleteFollow($_POST["unfollowing"], $_SESSION["LoggedUser"]);
}
if (isset($_POST["following"])) {
	$mysqli->follows()->insertFollow($_POST["following"], $_SESSION["LoggedUser"]);
}

require "../template/logged-base-view.php";
