<?php

require_once "bootstrap.php";

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mysqli->postReactions()->insertReactionOfPost($data["ReactionID"], $data["Username"], $data["PostID"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
	$port[1] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(1, $_GET["PostID"]);
	$port[2] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(2, $_GET["PostID"]);
	$port[3] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(3, $_GET["PostID"]);
	$port[4] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(4, $_GET["PostID"]);
	$port[5] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(5, $_GET["PostID"]);
	$port["reazione-attiva"] = $mysqli->postReactions()->getPostReactionByPostIdAndUsername($_GET["PostID"]);
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($port);
}
