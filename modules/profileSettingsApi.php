<?php

require_once "bootstrap.php";

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mysqli->users()->updateUser($data["profilePic"], $data["bio"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$encodedImage = $data["encodedImage"];
	$format = explode(";", explode("/", $encodedImage)[1])[0];
	$encodedImage = str_replace(
		array("data:image/jpeg;base64,", "data:image/jpg;base64,", "data:image/png;base64,"),
		"",
		$encodedImage
	);
	$encodedImage = str_replace(" ", "+", $encodedImage);
	$encodedImage = base64_decode($encodedImage);
	$pathFile = "./upload/" . $data["profilePic"];
	$sourceImg = imagecreatefromstring($encodedImage);
	imagedestroy($sourceImg);
}
