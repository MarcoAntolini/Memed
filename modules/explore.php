<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Esplora";
$templateParams["page"] = "explore-view.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/noticeSection.js"
);

// TODO a che serve $_SESSION["category"]?
$_SESSION["category"] = 0;
$templateParams["categories"] = $mysqli->categories()->getCategories();
if (isset($_POST["categoria"])) {
	$_SESSION["category"] = $_POST["categoria"];
}

require "postSettings.php";
require "../template/logged-base-view.php";
