<?php
require("bootstrap.php");
$post = $mysqli->ottieniPostPerHome($_SESSION["username"]);

for($i=0; $i<count($post); $i++){
    $post[$i]["imgarticolo"] = UPLOAD_DIR.$post[$i]["imgarticolo"];
}

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($post);

?>