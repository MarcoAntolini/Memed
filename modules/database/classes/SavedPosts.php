<?php

class SavedPosts
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertSavedPost(int $postId): void
	{
		$sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("is", $postId, $username);
		$stmt->execute();
	}

	public function getSavedPostsByUsername(): array
	{
		$sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?)
				ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array(0);
	}

	public function checkSavedPost(int $postId): bool
	{
		$sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function deleteSavedPost(int $postId): void
	{
		$sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
	}

	public function deleteAllSavedPostsById(int $postId): void
	{
		$sql = "DELETE FROM saved_posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
