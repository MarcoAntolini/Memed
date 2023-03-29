<?php
require_once 'bootstrap.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
	if ($mysqli->getUserByUsername($_POST['username'])) {
		$templateParams['erroreregistrazione'] = 'Username già esistente';
	} else if ($mysqli->getUserByEmail($_POST['email'])) {
		$templateParams['erroreregistrazione'] = 'Email già esistente';
	} else if ($_POST['password'] != $_POST['confirm-password']) {
		$templateParams['erroreregistrazione'] = 'Le password non coincidono';
	} else {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$password = hash('sha512', $password . $random_salt);
		$mysqli->insertUser($username, $email, $password, $random_salt);
		header('Location: ../modules/login.php');
	}
}

$templateParams["title"] = "Memed - Registrati";
$templateParams["page"] = "../template/register-view.php";

require "../template/unlogged-base-view.php";
