<?php
require("bootstrap.php");

$notice = $mysqli->getNotificationByUsername($_SESSION["LoggedUser"]);

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notice);
