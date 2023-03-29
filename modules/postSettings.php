<?php

require_once "bootstrap.php";

if (isset($_POST["delete-post"])) {
	$mysqli->posts()->deletePostById($_POST["post-id"]);
}
if (isset($_POST["edit-post"])) {
	$mysqli->posts()->updatePost($_POST["post-id"], $_POST["description"]);
}
if (isset($_POST["save-post"])) {
	$mysqli->savedPosts()->insertSavedPost($_SESSION["LoggedUser"], $_POST["post-id"]);
}
if (isset($_POST["unsave-post"])) {
	$mysqli->savedPosts()->deleteSavedPost($_SESSION["LoggedUser"], $_POST["post-id"]);
}
if (isset($_POST["submit-comment"])) {
	if (empty($_POST["comment-text"]) || $_POST["comment-text"] == "" || preg_match("/^[\s]+$/", $_POST["comment-text"])) {
		return;
	} else {
		$mysqli->comments()->insertComment(
			$_POST["post-id"],
			$_SESSION["LoggedUser"],
			$_POST["comment-text"]
		);
	}
}
