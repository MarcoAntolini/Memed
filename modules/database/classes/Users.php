<?php

class Users
{
	private mysqli $db;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function insertUser(string $username, string $email, string $password, string $passwordSalt): void
	{
		$sql = "INSERT INTO users (Username, Email, Password, PasswordSalt, FileName, Bio) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$fileName = "default-pic.png";
		$bio = "";
		$stmt->bind_param("ssssss", $username, $email, $password, $passwordSalt, $fileName, $bio);
		$stmt->execute();
	}

	public function getUserByUsername(string $username): array
	{
		$sql = "SELECT * FROM users WHERE Username = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC)[0] ?? array();
	}

	public function getUserByEmail(string $email): array
	{
		$sql = "SELECT * FROM users WHERE Email = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC)[0] ?? array();
	}

	public function getUserLikeUsername(string $username): array
	{
		$sql = "SELECT Username, Email, FileName, Bio FROM users WHERE Username LIKE ?";
		$stmt = $this->db->prepare($sql);
		$username = "%" . $username . "%";
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array();
	}

	public function updateUser(string $fileName, string $bio): void
	{
		$sql = "UPDATE users SET FileName = ?, Bio = ? WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("sss", $fileName, $bio, $username);
		$stmt->execute();
	}

	public function getFileNameByUsername(string $username): string
	{
		$sql = "SELECT FileName FROM users WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$defaultFileName = "default-pic.png";
		return $result->fetch_row()[0] ?? $defaultFileName;
	}

	public function getAverageReactionByUsername(string $username): int
	{
		$sql = "SELECT AVG(post_reactions.ReactionID) FROM posts, post_reactions
				WHERE posts.PostID=post_reactions.PostID AND posts.Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row()[0] ?? 0;
	}
}
