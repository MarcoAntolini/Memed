<?php

class PostCategories
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertPostCategory(int $postId, int $categoryId): void
	{
		$sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $postId, $categoryId);
		$stmt->execute();
	}

	public function getCategoriesByPostId(int $postId): array
	{
		$sql = "SELECT * FROM post_categories WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array(0);
	}

	public function deleteCategoryFromPost(int $postId, int $categoryId): void
	{
		$sql = "DELETE FROM post_categories WHERE PostID = ? AND CategoryID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $postId, $categoryId);
		$stmt->execute();
	}

	public function deleteAllCategoriesFromPost(int $postId): void
	{
		$sql = "DELETE FROM post_categories WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
