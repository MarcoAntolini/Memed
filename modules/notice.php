<?php
require_once 'bootstrap.php';

if (checkLogin($mysqli)) {
	if (isset($_POST["Read"])) {
		$mysqli->readNotificationById($_POST["Read"]);
	}
	if (isset($_POST["cancella"])) {
		$mysqli->deleteNotificationById($_POST["cancella"]);
	}
	if (isset($_POST["cancella-tutto"])) {
		$mysqli->deleteAllNotificationsByUsername($_SESSION["LoggedUsername"]);
	}
	if (isset($_POST["leggi-tutto"])) {
		$mysqli->readAllNotificationsByUsername($_SESSION["LoggedUsername"]);
	}
	$templateParams["titolo"] = "Memed - Notifiche";
	$templateParams["nome"] = "notice-view.php";
	$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
	$templateParams["Username"] = $_SESSION["LoggedUsername"];
	$templateParams["numNotifiche"] = $mysqli->countNotificationsByUsername($_SESSION["LoggedUsername"])[0];
	if ($mysqli->getNotificationByUsername($_SESSION["LoggedUsername"])) {
		$templateParams["notifiche"] = true;
	} else {
		$templateParams["notifiche"] = false;
	}
	require "../template/logged-base-view.php";
} else {
	header("location: login.php");
}
