<?php

class PostCategories
{
	private mysqli $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function insertPostCategory($categoryId, $postId)
	{
		$sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $postId, $categoryId);
		$stmt->execute();
	}

	// public function ottienicategoriePost($postId)
	// {
	//     $sql = "SELECT * FROM post_categories WHERE PostID = ?";
	//     $stmt = $this->db->prepare($sql);
	//     $stmt->bind_param("i", $postId);
	//     $stmt->execute();
	//     $result = $stmt->get_result();
	//     if ($result->num_rows > 0) {
	//         return $result->fetch_all(MYSQLI_ASSOC);
	//     } else {
	//         return false;
	//     }
	// }

	public function deleteAllCategoriesFromPost($postId)
	{
		$sql = "DELETE FROM post_categories WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
