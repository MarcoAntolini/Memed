<?php
require_once "../modules/bootstrap.php";
$currUser = $_SESSION["Username"];
$username = $_POST["Username"];
if ($mysqli->controllaSegue($username, $currUser)) {
    $mysqli->cancellaSegui($username, $currUser);
    echo "unfollow";
} else {
    $mysqli->inserisciSegue($username, $currUser);
    echo "follow";
}
