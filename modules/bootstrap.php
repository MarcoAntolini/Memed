<?php

session_start();
define("UPLOAD_DIR", "./upload/");

require_once("utils/*");
require_once("database/DatabaseHelper.php");

$mysqli = new DatabaseHelper("localhost", "root", "", "memed", 3306);
