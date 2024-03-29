<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Notifiche";
$templateParams["page"] = "notification.php";
$templateParams["js"] = array(
	"https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js",
	"../public/assets/js/notificationSection.js"
);

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

require "../template/baseLogged.php";
