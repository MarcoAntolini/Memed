<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Notifiche";
$templateParams["page"] = "notice-view.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");

if (isset($_POST["Read"])) {
	$mysqli->notifications()->readNotificationById($_POST["Read"]);
}
if (isset($_POST["cancella"])) {
	$mysqli->notifications()->deleteNotificationById($_POST["cancella"]);
}
if (isset($_POST["cancella-tutto"])) {
	$mysqli->notifications()->deleteAllNotificationsByUsername($_SESSION["LoggedUser"]);
}
if (isset($_POST["leggi-tutto"])) {
	$mysqli->notifications()->readAllNotificationsByUsername($_SESSION["LoggedUser"]);
}

$templateParams["notificationsNumber"] = $mysqli->notifications()->countNotificationsByUsername($_SESSION["LoggedUser"])[0];
if ($mysqli->notifications()->getNotificationByUsername($_SESSION["LoggedUser"])) {
	$templateParams["notifications"] = true;
} else {
	$templateParams["notifications"] = false;
}

require "../template/logged-base-view.php";
