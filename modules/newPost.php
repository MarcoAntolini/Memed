<?php
require_once 'bootstrap.php';

if (checkLogin($mysqli) == true) {
	$templateParams["titolo"] = "Memed - Crea Post";
	$templateParams["nome"] = "newPost-view.php";
	$templateParams["Username"] = $_SESSION["LoggedUsername"];
	$templateParams["categorie"] = $mysqli->getCategories();
	$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "../public/assets/js/noticeSection.js");
	require '../template/logged-base-view.php';
} else {
	header("location: login.php");
}
