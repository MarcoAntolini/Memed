<?php

require_once "bootstrap.php";

if (isset($_GET["url"])) {
	switch ($_GET["url"]) {
		case "index.php":
			$post = $mysqli->posts()->getPostsForHomeByUsername();
			break;
		case "user.php":
			$post = $mysqli->posts()->getPostsByUsername($_SESSION["userProfile"]);
			break;
		case "explore.php":
			if (isset($_SESSION["selectedCategory"]) && $_SESSION["selectedCategory"] != 0) {
				$post = $mysqli->posts()->getPostsByCategoryIdAndUsername($_SESSION["selectedCategory"]);
			} else {
				$post = $mysqli->posts()->getPostsForExploreByUsername();
			}
			break;
		case "savedPosts.php":
			$post = $mysqli->savedPosts()->getSavedPostsByUsername();
			break;
		default:
			$post = null;
			break;
	}

	if ($post != null) {
		for ($i = 0; $i < count($post); $i++) {
			$post[$i]["FileName"] = UPLOAD_DIR . $post[$i]["FileName"];
			$post[$i]["comments"]  = $mysqli->comments()->getCommentsByPostId($post[$i]["PostID"]);
			$post[$i]["reaction1"] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(1, $post[$i]["PostID"]);
			$post[$i]["reaction2"] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(2, $post[$i]["PostID"]);
			$post[$i]["reaction3"] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(3, $post[$i]["PostID"]);
			$post[$i]["reaction4"] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(4, $post[$i]["PostID"]);
			$post[$i]["reaction5"] = $mysqli->postReactions()->countPostReactionsByReactionIdAndPostId(5, $post[$i]["PostID"]);
			$post[$i]["loggedUser"] = $_SESSION["loggedUser"];
			$post[$i]["checkSavedPost"] = $mysqli->savedPosts()->checkSavedPost($post[$i]["PostID"]);
			$post[$i]["activeReaction"] = $mysqli->postReactions()->getPostReactionByPostIdAndUsername($post[$i]["PostID"]);
		}
	}

	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($post);
}
