<?php

require_once "bootstrap.php";

$notice = $mysqli->notifications()->getNotificationByUsername();

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notice);
