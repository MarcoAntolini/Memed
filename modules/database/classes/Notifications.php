<?php

class Notifications
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertNotification(string $username, string $message): void
	{
		$sql =  "INSERT INTO notifications (Username, Message, DateAndTime, `Read`) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$dateAndTime = date("Y-m-d H:i:s");
		$read = 0;
		$stmt->bind_param("sssi", $username, $message, $dateAndTime, $read);
		$stmt->execute();
	}

	public function deleteNotificationById(int $notificationId): void
	{
		$sql = "DELETE FROM notifications WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	public function readNotificationById(int $notificationId): void
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	public function deleteAllNotificationsByUsername(string $username): void
	{
		$sql = "DELETE FROM notifications WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function readAllNotificationsByUsername(string $username): void
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function getNotificationByUsername(string $username): array
	{
		$sql = "SELECT * FROM notifications WHERE Username = ? ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array(0);
	}

	public function countNotificationsByUsername(string $username): int
	{
		$sql = "SELECT COUNT(*) FROM notifications WHERE Username = ? and `Read` = ?";
		$stmt = $this->db->prepare($sql);
		$read = 0;
		$stmt->bind_param("si", $username, $read);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row()[0] ?? 0;
	}
}
