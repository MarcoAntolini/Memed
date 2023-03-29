<?php

require_once "bootstrap.php";

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mysqli->postReactions()->insertReactionOfPost($data["Username"], (int) $data["post-id"], $data["ReactionID"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
	$port[1] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(1, $_GET["post-id"]);
	$port[2] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(2, $_GET["post-id"]);
	$port[3] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(3, $_GET["post-id"]);
	$port[4] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(4, $_GET["post-id"]);
	$port[5] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(5, $_GET["post-id"]);
	$port["reazione-attiva"] = $mysqli->postReactions()->getPostReactionByPostIdAndUsername($_GET["post-id"], $_SESSION["LoggedUser"]);
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($port);
}
