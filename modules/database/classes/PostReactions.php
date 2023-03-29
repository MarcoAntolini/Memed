<?php

class PostReactions
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertReactionOfPost(int $reactionId, string $username, int $postId): void
	{
		// TODO spostare questo if nel file che chiama questa funzione
		if ($this->checkReaction($reactionId, $username, $postId)) {
			$this->deleteReactionOfUserFromPost($username, $postId);
			return;
		}
		$this->deleteReactionOfUserFromPost($username, $postId);
		$sql = "INSERT INTO post_reactions (ReactionID, Username, PostID) VALUES (?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		// username = session["LoggedUser"]
		$stmt->bind_param("isi", $reactionId, $username, $postId);
		$stmt->execute();
	}

	public function getPostReactionByPostIdAndUsername(int $postId): int
	{
		$sql = "SELECT ReactionID FROM post_reactions WHERE PostID = ? AND Username = ?";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["LoggedUser"];
		$stmt->bind_param("is", $postId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		// TODO serve il controllo?
		if ($result == null) {
			return 0;
		} else {
			return $result->fetch_row()[0] ?? 0;
		}
	}

	public function checkReaction(int $reactionId, string $username, int $postId): bool
	{
		$sql = "SELECT * FROM post_reactions WHERE ReactionID = ? AND Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("isi", $reactionId, $username, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function deleteReactionOfUserFromPost(string $username, int $postId): void
	{
		$sql = "DELETE FROM post_reactions WHERE Username = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("si", $username, $postId);
		$stmt->execute();
	}

	public function deleteAllReactionsFromPost(int $postId): void
	{
		$sql = "DELETE FROM post_reactions WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}

	public function countPostReactionsByReactionIdAndPostId(int $reactionId, int $postId): int
	{
		$sql = "SELECT COUNT(*) FROM post_reactions WHERE ReactionID = ? AND PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ii", $reactionId, $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row()[0] ?? 0;
	}
}
