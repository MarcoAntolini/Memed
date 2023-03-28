<?php

class SavedPosts
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertSavedPost($username, $postId)
	{
		$sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $postId, $username);
		$stmt->execute();
	}

	public function checkSavedPost($username, $postId)
	{
		$sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function deleteSavedPost($username, $postId)
	{
		$sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
	}

	public function getSavedPostsByUsername($username)
	{
		$sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?) ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: return false?
			return false;
		}
	}

	public function deleteSavedPostById($postId)
	{
		$sql = "DELETE FROM saved_posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
