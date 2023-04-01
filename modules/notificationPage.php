<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["notificationPage"] = "notification.php";

$templateParams["notificationsNumber"] = $mysqli->notifications()->countNotificationsByUsername();
if ($mysqli->notifications()->getNotificationByUsername() != null) {
	$templateParams["notifications"] = true;
} else {
	$templateParams["notifications"] = false;
}

if (isset($_POST["read"])) {
	$mysqli->notifications()->readNotificationById($_POST["read"]);
}
if (isset($_POST["delete"])) {
	$mysqli->notifications()->deleteNotificationById($_POST["delete"]);
}
if (isset($_POST["readAll"])) {
	$mysqli->notifications()->readAllNotificationsByUsername();
}
if (isset($_POST["deleteAll"])) {
	$mysqli->notifications()->deleteAllNotificationsByUsername();
}
