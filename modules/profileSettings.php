<?php
require("bootstrap.php");

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mysqli->updateUser($_SESSION["LoggedUser"], $data["profilePic"], $data["Bio"]);
	header("location: user.php?username=" . $_SESSION["LoggedUser"]);
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$encodedImage = $data["encodedImage"];
	$format = explode(";", explode("/", $encodedImage)[1])[0];
	$encodedImage = str_replace(
		array('data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,'),
		'',
		$encodedImage
	);
	$encodedImage = str_replace(' ', '+', $encodedImage);
	$encodedImage = base64_decode($encodedImage);
	$pathFile = "./upload/" . $data["profilePic"];
	$sourceImg = imagecreatefromstring($encodedImage);
	imagedestroy($sourceImg);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$profilo = $mysqli->getUserByUsername($_SESSION["LoggedUser"]);
	$data["FileName"] = $profilo[0]["FileName"];
	$data["Bio"] = $profilo[0]["Bio"];
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($data);
}
