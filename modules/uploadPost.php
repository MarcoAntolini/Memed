<?php

require_once "bootstrap.php";

if ((isset($_POST["description-input"]) && !empty($_POST["description-input"])) ||
	(isset($_FILES["image-input"]) && !empty($_FILES["image-input"]["name"]))
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
				$mysqli->postCategories()->insertPostCategory($mysqli->posts()->getLastPostId(), $category);
			}
			header(INDEX);
		} else {
			$mysqli->posts()->insertPost("", $textContent);
			foreach ($selectedCategories as $category) {
				$mysqli->postCategories()->insertPostCategory($mysqli->posts()->getLastPostId(), $category);
			}
			header(INDEX);
		}
	} else {
		$mysqli->posts()->insertPost("", $textContent);
		foreach ($selectedCategories as $category) {
			$mysqli->postCategories()->insertPostCategory($mysqli->posts()->getLastPostId(), $category);
		}
		header(INDEX);
	}
} else {
	header("location: newPost.php");
}

function uploadImage(string $path, array $image): array
{
	$imageName = basename($image["name"]);
	$fullPath = $path . $imageName;
	$maxKB = 10000;
	$acceptedExtensions = array("jpg", "jpeg", "png", "gif");
	$result = 0;
	$msg = "";
	$imageSize = getimagesize($image["tmp_name"]);
	if ($imageSize === false) {
		$msg .= "File caricato non è un'immagine! ";
	}
	if ($image["size"] > $maxKB * 1024) {
		$msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
	}
	$imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
	if (!in_array($imageFileType, $acceptedExtensions)) {
		$msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
	}
	if (file_exists($fullPath)) {
		$i = 1;
		do {
			$i++;
			$imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $imageFileType;
		} while (file_exists($path . $imageName));
		$fullPath = $path . $imageName;
	}
	if (strlen($msg) == 0) {
		if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
			$msg .= "Errore nel caricamento dell'immagine.";
		} else {
			$result = 1;
			$msg = $imageName;
		}
	}
	return array($result, $msg);
}
