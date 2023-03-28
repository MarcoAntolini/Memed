<?php

class Notifications
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertNotification($message, $notificationId, $username, $dateAndTime)
	{
		$sql =  "INSERT INTO notifications (Username, NotificationID, Message, DateAndTime, `Read`) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$read = 0;
		$stmt->bind_param("sissi", $username, $notificationId, $message, $dateAndTime, $read);
		$stmt->execute();
	}

	public function deleteNotificationById($notificationId)
	{
		$sql = "DELETE FROM notifications WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	public function deleteAllNotificationsByUsername($username)
	{
		$sql = "DELETE FROM notifications WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function readAllNotificationsByUsername($username)
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
	}

	public function getNotificationByUsername($username)
	{
		$sql = "SELECT * FROM notifications WHERE Username = ? ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}

	public function readNotificationById($notificationId)
	{
		$sql = "UPDATE notifications SET `Read` = '1' WHERE NotificationID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $notificationId);
		$stmt->execute();
	}

	// public function getLastNotificationId()
	// {
	// 	$sql = "SELECT NotificationID FROM notifications ORDER BY NotificationID DESC LIMIT 1";
	// 	$stmt = $this->db->prepare($sql);
	// 	$stmt->execute();
	// 	$result = $stmt->get_result();
	// 	if ($result->num_rows > 0) {
	// 		return $result->fetch_row();
	// 	} else {
	// 		return array(0);
	// 	}
	// }

	public function countNotificationsByUsername($username)
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
