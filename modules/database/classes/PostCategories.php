<?php

class PostCategories
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertPostCategory($postId, $categoryId): void
	{
		$sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $postId, $categoryId);
		$stmt->execute();
	}

	public function getCategoriesByPostId($postId): array
	{
		$sql = "SELECT * FROM post_categories WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}

	public function deleteCategoryFromPost($postId, $categoryId): void
	{
		$sql = "DELETE FROM post_categories WHERE PostID = ? AND CategoryID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $postId, $categoryId);
		$stmt->execute();
	}

	public function deleteAllCategoriesFromPost($postId): void
	{
		$sql = "DELETE FROM post_categories WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
