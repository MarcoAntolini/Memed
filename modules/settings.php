<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Impostazioni";
$templateParams["page"] = "settings.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/settings.js",
	"../public/assets/js/notificationSection.js"
);

$templateParams["profile"] = $mysqli->users()->getUserByUsername($_SESSION["LoggedUser"]);
if (isset($_POST["logout"])) {
	logout();
	header(LOGIN);
}

require "../template/logged-base.php";
