<?php

class Comments
{
	private mysqli $db;
	private Notifications $notifications;
	private Posts $posts;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function linkColumns(Notifications $notifications, Posts $posts): void
	{
		$this->notifications = $notifications;
		$this->posts = $posts;
	}

	public function insertComment(int $postId, string $textContent): void
	{
		$sql = "INSERT INTO comments (PostID, Username, TextContent, DateAndTime) VALUES (?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$dateAndTime = date("Y-m-d H:i:s");
		$username = $_SESSION["LoggedUser"];
		$stmt->bind_param("isss", $postId, $username, $textContent, $dateAndTime);
		$stmt->execute();
		$post = $this->posts->getPostById($postId);
		if ($username != $_SESSION["LoggedUser"]) {
			$this->notifications->insertNotification(
				"<a href=\"user.php?Username=$username\" class=\"fw-bold\">$username</a> ha commentato un tuo post.",
				$post[4],
				$dateAndTime
			);
		}
	}

	public function getCommentsByPostId(int $postId): array
	{
		$sql = "SELECT * FROM comments WHERE PostID = ? ORDER BY DateAndTime ASC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array(0);
	}

	public function deleteAllCommentsFromPost(int $postId): void
	{
		$sql = "DELETE FROM comments WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}
}
