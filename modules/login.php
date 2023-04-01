<?php

require_once "bootstrap.php";

$templateParams["title"] = "Memed - Login";
$templateParams["page"] = "../template/login-view.php";

if (isset($_POST["email"], $_POST["password"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	if (login($email, $password, $mysqli)) {
		header("Location: ../modules/index.php");
	} else {
		$templateParams["loginErrorMessage"] = "email o password errati";
	}
}

require "../template/unlogged-base-view.php";
