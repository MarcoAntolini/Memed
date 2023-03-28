<?php

class PostReactions
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function deleteReactionOfUserFromPost($username, $postId)
	{
		$sql = "DELETE FROM post_reactions WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
	}

	public function checkReaction($username, $postId, $reactionId)
	{
		$sql = "SELECT * FROM post_reactions WHERE Username = ? AND PostID = ? AND ReactionID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("sii", $username, $postId, $reactionId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function insertReactionOfPost($username, $postId, $reactionId)
	{
		if ($this->checkReaction($username, $postId, $reactionId)) {
			$this->deleteReactionOfUserFromPost($username, $postId);
			return true;
		}
		$this->deleteReactionOfUserFromPost($username, $postId);
		$sql = "INSERT INTO post_reactions (ReactionID, Username, PostID) VALUES (?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("isi", $reactionId, $username, $postId);
		$stmt->execute();
	}

	public function deleteAllReactionsFromPost($postId)
	{
		$sql = "DELETE FROM post_reactions WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
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

	public function countPostReactionsByReactionIdAndPostId($reactionId, $postId)
	{
		$sql = "SELECT COUNT(*) FROM post_reactions WHERE ReactionID = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $reactionId, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}

	public function getPostReactionByPostIdAndUsername($postId, $username)
	{
		$sql = "SELECT ReactionID FROM post_reactions WHERE PostID = ? AND Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $postId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result == null) {
			return 0;
		} elseif ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}
}
