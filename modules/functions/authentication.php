<?php

function registerLoggedUser(string $user): void
{
	$_SESSION["LoggedUser"] = $user["Username"];
}

function login(string $email, string $password, DatabaseHelper $mysqli): bool
{
	if (!$user = $mysqli->users()->getUserByEmail($email)) {
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
	$_SESSION["LoggedUser"] = $username;
	$_SESSION["login_string"] = hash("sha512", $password . $browser);
	return true;
}

function checkLogin(DatabaseHelper $mysqli): bool
{
	if (!isset($_SESSION["LoggedUser"], $_SESSION["login_string"])) {
		return false;
	}
	$loginString = $_SESSION["login_string"];
	$username = $_SESSION["LoggedUser"];
	$browser = $_SERVER["HTTP_USER_AGENT"];
	if (!$user = $mysqli->users()->getUserByUsername($username)) {
		return false;
	}
	$password = $user["Password"];
	$checkLogin = hash("sha512", $password . $browser);
	if ($checkLogin != $loginString) {
		return false;
	}
	return true;
}

function logout(): void
{
	$params = session_get_cookie_params();
	setcookie(
		session_name(),
		"",
		time() - 42000,
		$params["path"],
		$params["domain"],
		$params["secure"],
		$params["httponly"]
	);
	session_destroy();
}
