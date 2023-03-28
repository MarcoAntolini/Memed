<?php
require_once "bootstrap.php";

if (checkLogin($mysqli) == true) {
	$templateParams["titolo"] = "Memed";
	$templateParams["nome"] = "home-view.php";
	$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/postSection.js", "../public/assets/js/noticeSection.js");
	$templateParams["Username"] = $_SESSION["LoggedUsername"];
	$templateParams["posthome"] = $mysqli->getPostsForHomeByUsername($_SESSION["LoggedUsername"]);
	$templateParams["numNotifiche"] = $mysqli->countNotificationsByUsername($_SESSION["LoggedUsername"]);
	$templateParams["notifiche"] = $mysqli->getNotificationByUsername($_SESSION["LoggedUsername"]);
	require "../template/logged-base-view.php";
	require 'postSettings.php';
} else {
	header("location: login.php");
}
