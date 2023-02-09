<?php
require("bootstrap.php");

$data = json_decode(file_get_contents("php://input"), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    list($result, $filename) = uploadImage(UPLOAD_DIR, $data["profilePic"]);
    if ($result != 0) {
        $mysqli->modificaProfilo($_SESSION["username"], $filename, $data["bio"]);
    }
    header("location: user.php?username=" . $_SESSION["username"]);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $profilo = $mysqli->ottieniUtente($_SESSION["username"]);
    $data["nomefile"] = $profilo[0]["nomefile"];
    $data["bio"] = $profilo[0]["bio"];
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($data);
}
