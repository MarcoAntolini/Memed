<?php

class Categories
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertCategory(int $categoryId, string $name): void
	{
		$sql = "INSERT INTO categories (CategoryID, Name) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $categoryId, $name);
		$stmt->execute();
	}

	public function getCategories(): array
	{
		$sql = "SELECT * FROM categories";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}
}
