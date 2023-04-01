<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed";
$templateParams["page"] = "home.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/notificationSection.js"
);

$templateParams["notificationsNumber"] = $mysqli->notifications()->countNotificationsByUsername();
$templateParams["notifications"] = $mysqli->notifications()->getNotificationByUsername();

require "postSettings.php";
require "../template/logged-base.php";
