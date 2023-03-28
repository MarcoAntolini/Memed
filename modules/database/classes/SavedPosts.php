<?php

class SavedPosts
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertSavedPost($postId, $username): void
	{
		$sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $postId, $username);
		$stmt->execute();
	}

	public function getSavedPostsByUsername($username): array
	{
		$sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?)
				ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}

	public function checkSavedPost($username, $postId): bool
	{
		$sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function deleteSavedPost($username, $postId): void
	{
		$sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
	}

	public function deleteAllSavedPostsById($postId): void
	{
		$sql = "DELETE FROM saved_posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
