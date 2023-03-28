<?php

class Follows
{
	private mysqli $db;
	private Notifications $notifications;

	public function __construct(mysqli $db, Notifications $notifications)
	{
		$this->db = $db;
		$this->notifications = $notifications;
	}

	public function insertFollow($followedUsername, $followerUsername)
	{
		$sql = "INSERT INTO follows (FollowedUsername, FollowerUsername) VALUES (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ss", $followedUsername, $followerUsername);
		$stmt->execute();
		// if ($stmt->execute() === TRUE) {
		$this->notifications->insertNotification(
			"<a href=\"user.php?Username=$followerUsername\" class=\"fw-bold\">$followerUsername</a> ha iniziato a seguirti.",
			(int)$this->getLastNotificationId()[0] + 1,
			$followedUsername,
			date("Y-m-d H:i:s")
		);
		//     return true;
		// } else {
		//     return false;
		// }
	}

	public function checkFollow($followedUsername, $followerUsername)
	{
		$sql = "SELECT * FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ss", $followedUsername, $followerUsername);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}

	public function deleteFollow($followedUsername, $followerUsername)
	{
		$sql = "DELETE FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ss", $followedUsername, $followerUsername);
		$stmt->execute();
	}

	public function getAllFollowedByFollowerUsername($followerUsername)
	{
		$sql = "SELECT FollowedUsername FROM follows WHERE FollowerUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $followerUsername);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}

	public function getAllFollowersByFollowedUsername($followedUsername)
	{
		$sql = "SELECT FollowerUsername FROM follows WHERE FollowedUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $followedUsername);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}

	public function countFollowedByFollowerUsername($followerUsername)
	{
		$sql = "SELECT COUNT(*) FROM follows WHERE FollowerUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $followerUsername);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}

	public function countFollowersByFollowedUsername($followedUsername)
	{
		$sql = "SELECT COUNT(*) FROM follows WHERE FollowedUsername = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $followedUsername);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}
}
