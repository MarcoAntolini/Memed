<?php
sec_session_start();
define("UPLOAD_DIR", "./upload/");
require_once("utils/functions.php");
require_once("database/database.php");
$mysqli = new DatabaseHelper("localhost", "root", "", "memed", 3306);