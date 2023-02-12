<?php
require("bootstrap.php");

$notice = $mysqli->ottieniNotifica($_SESSION["username"]);

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notice);
