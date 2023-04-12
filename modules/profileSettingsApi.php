<?php

require_once "bootstrap.php";

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mysqli->users()->updateUser($data["profilePic"], $data["bio"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$encodedImage = $data["encodedImage"];
	$encodedImage = str_replace(
		array("data:image/jpeg;base64,", "data:image/jpg;base64,", "data:image/png;base64,"),
		"",
		$encodedImage
	);
	$encodedImage = str_replace(" ", "+", $encodedImage);
	$decodedImage = base64_decode($encodedImage);
	$sourceImg = imagecreatefromstring($decodedImage);
	if (imagesavealpha($sourceImg, true)) {
		$background = imagecolorallocatealpha($sourceImg, 255, 255, 255, 127);
		imagefill($sourceImg, 0, 0, $background);
	}
	$pathFile = UPLOAD_DIR . $data["profilePic"];
	imagejpeg($sourceImg, $pathFile, 100);
	imagedestroy($sourceImg);
}
