<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Esplora";
$templateParams["page"] = "explore-view.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/notificationSection.js"
);

$_SESSION["selectedCategory"] = 0;
$templateParams["categories"] = $mysqli->categories()->getCategories();
if (isset($_POST["category"])) {
	$_SESSION["selectedCategory"] = $_POST["category"];
}

require "postSettings.php";
require "../template/logged-base-view.php";
