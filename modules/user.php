<?php

require_once "bootstrap.php";
require_once "sessionCheck.php";

$templateParams["title"] = "Memed - Profilo";
$templateParams["page"] = "user-view.php";
$templateParams["js"] = array(
	"https://unpkg.com/axios/dist/axios.min.js",
	"../public/assets/js/postSection.js",
	"../public/assets/js/notificationSection.js"
);

if (isset($_GET["username"])) {
	$username = $_GET["username"];
	$_SESSION["userProfile"] = $username;
	$templateParams["username"] = $username;
	$templateParams["profile"] = $mysqli->users()->getUserByUsername($username);
	$templateParams["followersNumber"] = $mysqli->follows()->countFollowersByFollowedUsername($username);
	$templateParams["followedNumber"] = $mysqli->follows()->countFollowedByFollowerUsername($username);
	$templateParams["followerList"] = $mysqli->follows()->getAllFollowersByFollowedUsername($username);
	$templateParams["followedList"] = $mysqli->follows()->getAllFollowedByFollowerUsername($username);
}
if ($templateParams["username"] != $templateParams["loggedUsername"]) {
	if ($templateParams["followerList"] && $mysqli->follows()->checkFollow($templateParams["username"])) {
		$templateParams["isFollowing"] = true;
	} else {
		$templateParams["isFollowing"] = false;
	}
}
if (isset($_POST["unfollowing"])) {
	$mysqli->follows()->deleteFollow($_POST["unfollowing"]);
	header("location: user.php?username=" . $templateParams["username"]);
}
if (isset($_POST["following"])) {
	$mysqli->follows()->insertFollow($_POST["following"]);
	header("location: user.php?username=" . $templateParams["username"]);
}

require "postSettings.php";
require "../template/logged-base-view.php";
