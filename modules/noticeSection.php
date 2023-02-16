<?php
require("bootstrap.php");

$notice = $mysqli->ottieniNotifica($_SESSION["Username"]);

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notice);
