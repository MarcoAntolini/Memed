<?php
require("bootstrap.php");

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli->modificaProfilo($_SESSION["username"], $data["profilePic"], $data["bio"]);
    header("location: user.php?username=" . $_SESSION["username"]);
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
    $profilo = $mysqli->ottieniUtente($_SESSION["username"]);
    $data["nomefile"] = $profilo[0]["nomefile"];
    $data["bio"] = $profilo[0]["bio"];
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($data);
}
