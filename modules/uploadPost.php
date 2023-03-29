<?php

require_once "bootstrap.php";

if ((isset($_POST["description-input"]) && !empty($_POST["description-input"])) || (isset($_POST["image-input"]) && !empty($_POST["image-input"]["name"]))) {
	$testopost = htmlspecialchars($_POST["description-input"]);
	$datapost = date("Y-m-d H:i:s");
	$autore = $_SESSION["LoggedUser"];

	$categorie = $mysqli->categories()->getCategories();
	$categorie_inserite = array();
	foreach ($categorie as $categoria) {
		if (isset($_POST["categoria_" . $categoria["CategoryID"]])) {
			array_push($categorie_inserite, $categoria["CategoryID"]);
		}
	}
	if (isset($_FILES["image-input"]) && $_FILES["image-input"]["name"] != "") {
		list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["image-input"]);
		if ($result != 0) {
			$imgpost = $msg;
			// TODO: togliere il cast a int
			$id = $mysqli->posts()->insertPost($imgpost, $testopost, $datapost, $autore);
			// TODO: togliere l'if qui e sotto
			if ($id) {
				foreach ($categorie_inserite as $categoria) {
					// TODO: non serve $ris
					$ris = $mysqli->postCategories()->insertPostCategory((int) $categoria, (int) $mysqli->getLastPostId()[0]);
				}
				header(INDEX);
			}
		} else {
			$id = $mysqli->posts()->insertPost(null, $testopost, $datapost, $autore);
			if ($id) {
				foreach ($categorie_inserite as $categoria) {
					$ris = $mysqli->postCategories()->insertPostCategory($categoria, $mysqli->getLastPostId()[0]);
				}
				header(INDEX);
			}
		}
	} else {
		$id = $mysqli->posts()->insertPost(null, $testopost, $datapost, $autore);
		if ($id) {
			foreach ($categorie_inserite as $categoria) {
				$ris = $mysqli->postCategories()->insertPostCategory($categoria, $mysqli->getLastPostId()[0]);
			}
			header(INDEX);
		}
	}
} else {
	header("location: newPost.php");
}
