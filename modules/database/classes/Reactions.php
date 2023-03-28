<?php

class Reactions
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	// public function ottieniReazione($reactionId)
	// {
	//     $sql = "SELECT * FROM reactions WHERE ReactionID = ?";
	//     $stmt = $this->db->prepare($sql);
	//     $stmt->bind_param("i", $reactionId);
	//     $stmt->execute();
	//     $result = $stmt->get_result();
	//     if ($result->num_rows > 0) {
	//         return $result->fetch_all(MYSQLI_ASSOC);
	//     } else {
	//         return false;
	//     }
	// }
}
