<?php

require_once "bootstrap.php";

$notice = $mysqli->notifications()->getNotificationByUsername($_SESSION["LoggedUser"]);

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notice);
