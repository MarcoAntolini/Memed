<?php

require_once "bootstrap.php";

if (!checkLogin($mysqli)) {
	header(LOGIN);
}


function checkLogin(DatabaseHelper $mysqli): bool
{
	if (!isset($_SESSION["loggedUser"], $_SESSION["login_string"])) {
		return false;
	}
	$loginString = $_SESSION["login_string"];
	$username = $_SESSION["loggedUser"];
	$browser = $_SERVER["HTTP_USER_AGENT"];
	if ($user = $mysqli->users()->getUserByUsername($username) == null) {
		return false;
	}
	$password = $user["Password"];
	$checkLogin = hash("sha512", $password . $browser);
	if ($checkLogin != $loginString) {
		return false;
	}
	return true;
}
