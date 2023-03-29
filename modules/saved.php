<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Post Salvati";
$templateParams["page"] = "saved-view.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/noticeSection.js"
);

require "postSettings.php";
require "../template/logged-base-view.php";
