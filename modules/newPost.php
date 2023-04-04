<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Crea Post";
$templateParams["page"] = "newPost.php";
$templateParams["js"] = array("https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js", "../public/assets/js/notificationSection.js");

$templateParams["categories"] = $mysqli->categories()->getCategories();

require "../template/baseLogged.php";
