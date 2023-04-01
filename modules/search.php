<?php

require_once "bootstrap.php";

$templateParams["title"] = "Memed - Cerca";
$templateParams["page"] = "search-view.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/notificationSection.js");

$usersList = $mysqli->users()->getUserLikeUsername($_GET['search']);
if (isset($_POST["unfollowing"])) {
	$mysqli->follows()->deleteFollow($_POST["unfollowing"]);
}
if (isset($_POST["following"])) {
	$mysqli->follows()->insertFollow($_POST["following"]);
}

require "../template/logged-base-view.php";
