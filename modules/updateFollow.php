<?php

require_once "bootstrap.php";

$currUser = $_SESSION["LoggedUser"];
$username = $_POST["Username"];
if ($mysqli->follows()->checkFollow($username, $currUser)) {
	$mysqli->follows()->deleteFollow($username, $currUser);
	echo "unfollow";
} else {
	$mysqli->follows()->insertFollow($username, $currUser);
	echo "follow";
}
