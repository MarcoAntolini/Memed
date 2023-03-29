<?php

require_once "bootstrap.php";

$username = $_POST["Username"];
if ($mysqli->follows()->checkFollow($username)) {
	$mysqli->follows()->deleteFollow($username);
	echo "unfollow";
} else {
	$mysqli->follows()->insertFollow($username);
	echo "follow";
}
