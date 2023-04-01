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
	$utente = $_GET["username"];
	$_SESSION["utente"] = $utente;
	$templateParams["utente"] = $utente;
	$templateParams["profilo"] = $mysqli->users()->getUserByUsername($utente);
	$templateParams["nFol"] = $mysqli->follows()->countFollowersByFollowedUsername($utente);
	$templateParams["nSeguiti"] = $mysqli->follows()->countFollowedByFollowerUsername($utente);
	$templateParams["follower"] = $mysqli->follows()->getAllFollowersByFollowedUsername($utente);
	$templateParams["seguiti"] = $mysqli->follows()->getAllFollowedByFollowerUsername($utente);
	$templateParams["nPost"] = $mysqli->posts()->countPostsByUsername($utente);
}
if ($templateParams["utente"] != $templateParams["loggedUsername"]) {
	if ($templateParams["follower"] && $mysqli->follows()->checkFollow($templateParams["utente"])) {
		$templateParams["isFollowing"] = true;
	} else {
		$templateParams["isFollowing"] = false;
	}
}
if (isset($_POST["unfollowing"])) {
	$mysqli->follows()->deleteFollow($_POST["unfollowing"]);
	header("location: user.php?username=" . $templateParams["utente"]);
}
if (isset($_POST["following"])) {
	$mysqli->follows()->insertFollow($_POST["following"]);
	header("location: user.php?username=" . $templateParams["utente"]);
}

require "postSettings.php";
require "../template/logged-base-view.php";
