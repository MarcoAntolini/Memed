<?php

require_once "bootstrap.php";

if (!checkLogin($mysqli)) {
	header("location: login.php");
} else {
	$templateParams["loggedUsername"] = $_SESSION["LoggedUser"];
}
