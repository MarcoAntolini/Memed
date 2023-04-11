<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed";
$templateParams["page"] = "home.php";
$templateParams["js"] = array(
	"https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/notificationSection.js"
);

require "postSettings.php";
require "../template/baseLogged.php";
