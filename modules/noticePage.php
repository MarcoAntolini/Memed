<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["notice"] = "notice-view.php";

if ($mysqli->notifications()->getNotificationByUsername() != null) {
	$templateParams["notifications"] = true;
} else {
	$templateParams["notifications"] = false;
}
if (isset($_POST["Read"])) {
	$mysqli->notifications()->readNotificationById($_POST["Read"]);
}
if (isset($_POST["cancella"])) {
	$mysqli->notifications()->deleteNotificationById($_POST["cancella"]);
}
if (isset($_POST["cancella-tutto"])) {
	$mysqli->notifications()->deleteAllNotificationsByUsername();
}
if (isset($_POST["leggi-tutto"])) {
	$mysqli->notifications()->readAllNotificationsByUsername();
}
$templateParams["notificationsNumber"] = $mysqli->notifications()->countNotificationsByUsername();
