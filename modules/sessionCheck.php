<?php

require_once "bootstrap.php";

if (!checkLogin($mysqli)) {
	header(LOGIN);
} else {
	$templateParams["loggedUsername"] = $_SESSION["loggedUser"];
}
