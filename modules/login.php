<?php

require_once "bootstrap.php";

$templateParams["title"] = "Memed - Login";
$templateParams["page"] = "../template/login.php";

if (isset($_POST["email"], $_POST["password"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	if (login($email, $password, $mysqli)) {
		header(INDEX);
	} else {
		$templateParams["loginErrorMessage"] = "email o password errati";
	}
}

function login(string $email, string $password, DatabaseHelper $mysqli): bool
{
	$user = $mysqli->users()->getUserByEmail($email);
	if (empty($user)) {
		return false;
	}
	$username = $user["Username"];
	$userPassword = $user["Password"];
	$userSalt = $user["PasswordSalt"];
	$password = hash("sha512", $password . $userSalt);
	if ($userPassword != $password) {
		return false;
	}
	$browser = $_SERVER["HTTP_USER_AGENT"];
	$_SESSION["loggedUser"] = $username;
	$_SESSION["login_string"] = hash("sha512", $password . $browser);
	return true;
}

require "../template/baseUnlogged.php";
