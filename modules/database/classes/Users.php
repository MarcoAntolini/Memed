<?php

class Users
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertUser($username, $email, $password, $passwordSalt): void
	{
		$sql = "INSERT INTO users (Username, Email, Password, PasswordSalt, FileName, Bio) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$fileName = 'default-pic.png';
		$bio = '';
		$stmt->bind_param("ssssss", $username, $email, $password, $passwordSalt, $fileName, $bio);
		$stmt->execute();
	}

	public function getUserByUsername($username): array
	{
		$sql = "SELECT * FROM users WHERE Username = ? LIMIT 1";
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

	public function getUserByEmail($email): array
	{
		$sql = "SELECT * FROM users WHERE Email = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}

	// public function ottieniUtenteLoggato($username, $password)
	// {
	//     $sql = "SELECT * FROM utente WHERE Username = ? AND Password = ?";
	//     $stmt = $this->db->prepare($sql);
	//     $stmt->bind_param("ss", $username, $password);
	//     $stmt->execute();
	//     $result = $stmt->get_result();
	//     if ($result->num_rows > 0) {
	//         return $result->fetch_all(MYSQLI_ASSOC);
	//     } else {
	//         return false;
	//     }
	// }

	public function getUserLikeUsername($username): array
	{
		$sql = "SELECT Username, Email, FileName, Bio FROM users WHERE Username LIKE ?";
		$stmt = $this->db->prepare($sql);
		$username = "%" . $username . "%";
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		// TODO if ($result->num_rows > 0)
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function updateUser($fileName, $bio, $username): void
	{
		$sql = "UPDATE users SET FileName = ? Bio = ? WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("sss", $fileName, $bio, $username);
		$stmt->execute();
	}

	public function getFileNameByUsername($username): array
	{
		$sql = "SELECT FileName FROM users WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		// TODO if ($result->num_rows > 0)
		return $result->fetch_row();
	}

	public function getAverageReactionByUsername($username): int
	{
		$sql = "SELECT AVG(post_reactions.ReactionID) FROM posts, post_reactions
				WHERE posts.PostID=post_reactions.PostID AND posts.Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		// TODO if ($result->num_rows > 0)
		return $result->fetch_row();
	}
}
