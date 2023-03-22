<?php
require_once("bootstrap.php");

if (isset($_POST["delete-post"])) {
    $mysqli->deletePostById($_POST["post-id"]);
}
if (isset($_POST["edit-post"])) {
    $mysqli->updatePost($_POST["post-id"], $_POST["description"]);
}
if (isset($_POST["save-post"])) {
    $mysqli->insertSavedPost($_SESSION["Username"], $_POST["post-id"]);
}
if (isset($_POST["unsave-post"])) {
    $mysqli->deleteSavedPost($_SESSION["Username"], $_POST["post-id"]);
}
if (isset($_POST["submit-comment"])) {
    if (empty($_POST["comment-text"]) || $_POST["comment-text"] == "" || preg_match("/^[\s]+$/", $_POST["comment-text"])) {
        return;
    } else {
        $mysqli->insertComment(
            $mysqli->getLastCommentIdByPost($_POST["post-id"])[0] + 1,
            $_POST["comment-text"],
            date("Y-m-d H:i:s"),
            $_SESSION["Username"],
            $_POST["post-id"]
        );
    }
}
