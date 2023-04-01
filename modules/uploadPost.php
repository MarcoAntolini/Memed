<?php

require_once "bootstrap.php";

if ((isset($_POST["description-input"]) && !empty($_POST["description-input"])) ||
	(isset($_POST["image-input"]) && !empty($_POST["image-input"]["name"]))
) {
	$textContent = htmlspecialchars($_POST["description-input"]);
	$categories = $mysqli->categories()->getCategories();
	$selectedCategories = array();
	foreach ($categories as $category) {
		if (isset($_POST["category_" . $category["CategoryID"]])) {
			array_push($selectedCategories, $category["CategoryID"]);
		}
	}
	if (isset($_FILES["image-input"]) && $_FILES["image-input"]["name"] != "") {
		list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["image-input"]);
		if ($result != 0) {
			$imgpost = $msg;
			$mysqli->posts()->insertPost($imgpost, $textContent);
			foreach ($selectedCategories as $category) {
				$mysqli->postCategories()->insertPostCategory($category, $mysqli->posts()->getLastPostId());
			}
			header(INDEX);
		} else {
			$mysqli->posts()->insertPost("", $textContent);
			foreach ($selectedCategories as $category) {
				$mysqli->postCategories()->insertPostCategory($category, $mysqli->posts()->getLastPostId());
			}
			header(INDEX);
		}
	} else {
		$mysqli->posts()->insertPost("", $textContent);
		foreach ($selectedCategories as $category) {
			$mysqli->postCategories()->insertPostCategory($category, $mysqli->posts()->getLastPostId());
		}
		header(INDEX);
	}
} else {
	header("location: newPost.php");
}
