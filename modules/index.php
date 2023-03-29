<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed";
$templateParams["page"] = "home-view.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/noticeSection.js"
);

$templateParams["notificationsNumber"] = $mysqli->notifications()->countNotificationsByUsername($_SESSION["LoggedUser"]);
$templateParams["notifications"] = $mysqli->notifications()->getNotificationByUsername($_SESSION["LoggedUser"]);

require "postSettings.php";
require "../template/logged-base-view.php";
