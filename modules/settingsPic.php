<?php
require("bootstrap.php");

$profilo = $mysqli->ottieniUtente($_SESSION["username"]);
$nomefile = $profilo[0]["nomefile"];

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($nomefile);
