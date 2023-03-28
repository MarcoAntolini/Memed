<?php
require_once 'bootstrap.php';

if ((isset($_POST["description-input"]) && !empty($_POST["description-input"])) || (isset($_POST["image-input"]) && !empty($_POST["image-input"]["name"]))) {
	$testopost = htmlspecialchars($_POST["description-input"]);
	$datapost = date("Y-m-d H:i:s");
	$autore = $_SESSION["LoggedUsername"];

	$categorie = $mysqli->getCategories();
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
			$id = $mysqli->insertPost((int) $mysqli->getLastPostId()[0] + 1, $imgpost, $testopost, $datapost, $autore);
			// TODO: togliere l'if qui e sotto
			if ($id != false) {
				foreach ($categorie_inserite as $categoria) {
					// TODO: non serve $ris
					$ris = $mysqli->insertPostCategory((int) $categoria, (int) $mysqli->getLastPostId()[0]);
				}
				header("location: index.php");
			}
		} else {
			$id = $mysqli->insertPost($mysqli->getLastPostId()[0] + 1, NULL, $testopost, $datapost, $autore);
			if ($id != false) {
				foreach ($categorie_inserite as $categoria) {
					$ris = $mysqli->insertPostCategory($categoria, $mysqli->getLastPostId()[0]);
				}
				header("location: index.php");
			}
		}
	} else {
		$id = $mysqli->insertPost($mysqli->getLastPostId()[0] + 1, NULL, $testopost, $datapost, $autore);
		if ($id != false) {
			foreach ($categorie_inserite as $categoria) {
				$ris = $mysqli->insertPostCategory($categoria, $mysqli->getLastPostId()[0]);
			}
			header("location: index.php");
		}
	}
} else {
	header("location: newPost.php");
}
