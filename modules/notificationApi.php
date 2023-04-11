<?php

require_once "bootstrap.php";

if ($_GET["type"] === "section") {
	$data = $mysqli->notifications()->getNotificationByUsername();
} elseif ($_GET["type"] === "buttons") {
	$unreadNotificationsNumber = $mysqli->notifications()->countUnreadNotificationsByUsername();
	$notificationsNumber = $mysqli->notifications()->countNotificationsByUsername();
	if (!empty($mysqli->notifications()->getNotificationByUsername())) {
		$notifications = true;
	} else {
		$notifications = false;
	}
	$data = array(
		"unreadNotificationsNumber" => $unreadNotificationsNumber,
		"notificationsNumber" => $notificationsNumber,
		"notifications" => $notifications
	);
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($data);
