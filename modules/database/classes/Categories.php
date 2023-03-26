<?php

class Categories
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	// public function inserisciCategoria($Name, $categoryId)
	// {
	//     $sql = "INSERT INTO categories (CategoryID, Name) VALUES (?, ?)";
	//     $stmt = $this->db->prepare($sql);
	//     $stmt->bind_param("is", $categoryId, $Name);
	//     $stmt->execute();
	// }

	public function getCategories()
	{
		$sql = "SELECT * FROM categories";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		// if ($result->num_rows > 0) {
		return $result->fetch_all(MYSQLI_ASSOC);
		// } else {
		//     return false;
		// }
	}
}
