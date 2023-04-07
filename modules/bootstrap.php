<?php

require_once "database/DatabaseHelper.php";

session_start();
define("UPLOAD_DIR", "./upload/");
define("INDEX", "location: index.php");
define("LOGIN", "location: login.php");

$mysqli = new DatabaseHelper("localhost", "root", "", "memed", 3306);
