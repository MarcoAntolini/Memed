<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Crea Post";
$templateParams["page"] = "newPost-view.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");

$templateParams["categories"] = $mysqli->categories()->getCategories();

require "../template/logged-base-view.php";
