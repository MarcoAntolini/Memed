<?php

require_once "database/DatabaseHelper.php";
require_once "functions/authentication.php";
require_once "functions/upload.php";

session_start();
define("UPLOAD_DIR", "./upload/");
define("INDEX", "location: index.php");
define("LOGIN", "location: login.php");

$mysqli = new DatabaseHelper("localhost", "root", "", "memed", 3306);
