<?php
require_once 'bootstrap.php';

if (checkLogin($mysqli) == true) {
	$templateParams["titolo"] = "Memed - Impostazioni";
	$templateParams["nome"] = "settings-view.php";
	$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/settings.js", "../public/assets/js/noticeSection.js");
	$templateParams["Username"] = $_SESSION["LoggedUsername"];
	$templateParams["profilo"] = $mysqli->getUserByUsername($_SESSION["LoggedUsername"]);
	if (isset($_POST["logout"])) {
		logout();
		header('location: login.php');
	}
	require "../template/logged-base-view.php";
} else {
	header("location: login.php");
}
