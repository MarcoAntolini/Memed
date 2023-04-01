<?php

require_once "bootstrap.php";

$notification = $mysqli->notifications()->getNotificationByUsername();

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($notification);
