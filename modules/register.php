<?php

require_once "bootstrap.php";

$templateParams["title"] = "Memed - Registrati";
$templateParams["page"] = "../template/register-view.php";

if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirm-password"])) {
	if ($mysqli->users()->getUserByUsername($_POST["username"])) {
		$templateParams["registrationErrorMessage"] = "Username già esistente";
	} elseif ($mysqli->users()->getUserByEmail($_POST["email"])) {
		$templateParams["registrationErrorMessage"] = "Email già esistente";
	} elseif ($_POST["password"] != $_POST["confirm-password"]) {
		$templateParams["registrationErrorMessage"] = "Le password non coincidono";
	} else {
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$random_salt = hash("sha512", uniqid(mt_rand(1, mt_getrandmax()), true));
		$password = hash("sha512", $password . $random_salt);
		$mysqli->users()->insertUser($username, $email, $password, $random_salt);
		header("Location: ../modules/login.php");
	}
}

require "../template/unlogged-base-view.php";
