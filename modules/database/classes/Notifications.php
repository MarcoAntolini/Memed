<?php

class Notifications
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertNotification($username, $message, $dateAndTime): void
	{
		$sql =  "INSERT INTO notifications (Username, Message, DateAndTime, `Read`) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$read = 0;
		$stmt->bind_param("sssi", $username, $message, $dateAndTime, $read);
		$stmt->execute();
	}

	public function deleteNotificationById($notificationId): void
	{
		$sql = "DELETE FROM notifications WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	public function readNotificationById($notificationId): void
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	public function deleteAllNotificationsByUsername($username): void
	{
		$sql = "DELETE FROM notifications WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function readAllNotificationsByUsername($username): void
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function getNotificationByUsername($username): array
	{
		$sql = "SELECT * FROM notifications WHERE Username = ? ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}

	public function countNotificationsByUsername($username): int
	{
		$sql = "SELECT COUNT(*) FROM notifications WHERE Username = ? and `Read` = ?";
		$stmt = $this->db->prepare($sql);
		$read = 0;
		$stmt->bind_param("si", $username, $read);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}
}
