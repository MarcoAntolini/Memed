<?php

class Comments
{
	private mysqli $db;
	private Notifications $notifications;
	private Posts $posts;

	public function __construct(mysqli $db, Notifications $notifications, Posts $posts)
	{
		$this->db = $db;
		$this->notifications = $notifications;
		$this->posts = $posts;
	}

	public function insertComment($commentId, $textContent, $dateAndTime, $username, $postId)
	{
		$sql = "INSERT INTO comments (PostID, Username, CommentID, TextContent, DateAndTime) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("isiss", $postId, $username, $commentId, $textContent, $dateAndTime);
		$stmt->execute();
		// if ($stmt->execute() === TRUE) {
		$post = $this->posts->getPostById($postId);
		$this->notifications->insertNotification(
			"<a href=\"user.php?Username=$username\" class=\"fw-bold\">$username</a> ha commentato un tuo post.",
			(int)$this->getLastNotificationId()[0] + 1,
			$post[4],
			$dateAndTime
		);
		// return true;
		// } else {
		// return false;
		// }
	}

	public function getCommentsByPostId($postId)
	{
		$sql = "SELECT * FROM comments WHERE PostID = ? ORDER BY DateAndTime ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: perchè return false?
			return false;
		}
	}

	public function deleteAllCommentsFromPost($postId)
	{
		$sql = "DELETE FROM comments WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}

	// public function getLastCommentIdByPost($postId)
	// {
	// 	$sql = "SELECT CommentID FROM comments WHERE PostID = ? ORDER BY CommentID DESC LIMIT 1";
	// 	$stmt = $this->db->prepare($sql);
	// 	$stmt->bind_param("i", $postId);
	// 	$stmt->execute();
	// 	$result = $stmt->get_result();
	// 	if ($result->num_rows > 0) {
	// 		return $result->fetch_row();
	// 	} else {
	// 		return array(0);
	// 	}
	// }
}
