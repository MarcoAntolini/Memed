<?php
require("bootstrap.php");

if (isset($_GET["url"])) {
	switch ($_GET["url"]) {
		case "index.php":
			$post = $mysqli->getPostsForHomeByUsername($_SESSION["LoggedUser"]);
			break;
		case "user.php":
			$post = $mysqli->getPostsByUsername($_SESSION["utente"]);
			break;
		case "explore.php":
			if (isset($_SESSION["category"]) && $_SESSION["category"] != 0) {
				$post = $mysqli->getPostsByCategoryIdAndUsername($_SESSION["category"], $_SESSION["LoggedUser"]);
			} else {
				$post = $mysqli->getPostsForExploreByUsername($_SESSION["LoggedUser"]);
			}
			break;
		case "saved.php":
			$post = $mysqli->getSavedPostsByUsername($_SESSION["LoggedUser"]);
			break;
		default:
			$post = NULL;
			break;
	}

	if ($post != NULL) {
		for ($i = 0; $i < count($post); $i++) {
			$post[$i]["FileName"] = UPLOAD_DIR . $post[$i]["FileName"];
			$post[$i]["commenti"]  = $mysqli->getCommentsByPostId($post[$i]["PostID"]);
			$post[$i]["reazione1"] = $mysqli->countPostReactionsByReactionIdAndPostId(1, $post[$i]["PostID"]);
			$post[$i]["reazione2"] = $mysqli->countPostReactionsByReactionIdAndPostId(2, $post[$i]["PostID"]);
			$post[$i]["reazione3"] = $mysqli->countPostReactionsByReactionIdAndPostId(3, $post[$i]["PostID"]);
			$post[$i]["reazione4"] = $mysqli->countPostReactionsByReactionIdAndPostId(4, $post[$i]["PostID"]);
			$post[$i]["reazione5"] = $mysqli->countPostReactionsByReactionIdAndPostId(5, $post[$i]["PostID"]);
			$post[$i]["session-username"] = $_SESSION["LoggedUser"];
			$post[$i]["checkSavedPost"] = $mysqli->checkSavedPost($_SESSION["LoggedUser"], $post[$i]["PostID"]);
			$post[$i]["reazione-attiva"] = $mysqli->getPostReactionByPostIdAndUsername($post[$i]["PostID"], $_SESSION["LoggedUser"]);
		}
	}

	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($post);
}
