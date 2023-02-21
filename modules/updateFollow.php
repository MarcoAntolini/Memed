<?php
require_once "../modules/bootstrap.php";
$currUser = $_SESSION["Username"];
$username = $_POST["Username"];
if ($mysqli->checkFollow($username, $currUser)) {
    $mysqli->deleteFollow($username, $currUser);
    echo "unfollow";
} else {
    $mysqli->insertFollow($username, $currUser);
    echo "follow";
}
