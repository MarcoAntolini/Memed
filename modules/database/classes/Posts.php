<?php

class Posts
{
	private mysqli $db;
	private PostCategories $postCategories;
	private PostReactions $postReactions;
	private Comments $comments;
	private SavedPosts $savedPosts;
	private Notifications $notifications;

	public function __construct(mysqli $db)
	{
		$this->db = $db;
	}

	public function linkColumns(
		PostCategories $postCategories,
		PostReactions $postReactions,
		Comments $comments,
		SavedPosts $savedPosts,
		Notifications $notifications
	): void {
		$this->postCategories = $postCategories;
		$this->postReactions = $postReactions;
		$this->comments = $comments;
		$this->savedPosts = $savedPosts;
		$this->notifications = $notifications;
	}

	public function insertPost(string $fileName, string $textContent): void
	{
		$sql = "INSERT INTO posts (FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$dateAndTime = date("Y-m-d H:i:s");
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("ssss", $fileName, $textContent, $dateAndTime, $username);
		$stmt->execute();
	}

	public function getPostById(int $postId): array
	{
		$sql = "SELECT * FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row() ?? array();
	}

	public function getPostsByUsername(string $username): array
	{
		$sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array();
	}

	public function getPostsForHomeByUsername()
	{
		$sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE FollowerUsername = ?)
				ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array();
	}

	public function getPostsByCategoryIdAndUsername(int $categoryId): array
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID
				IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID
				ORDER BY AVG(post_reactions.ReactionID) DESC";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("is", $categoryId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array();
	}

	public function getPostsForExploreByUsername(): array
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ?
				GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
		$stmt = $this->db->prepare($sql);
		$username = $_SESSION["loggedUser"];
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC) ?? array();
	}

	public function updatePost(string $textContent, int  $postId): void
	{
		$query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("si", $textContent, $postId);
		$stmt->execute();
	}

	public function deletePostById(int $postId): void
	{
		$this->postCategories->deleteAllCategoriesFromPost($postId);
		$this->postReactions->deleteAllReactionsFromPost($postId);
		$this->comments->deleteAllCommentsFromPost($postId);
		$this->savedPosts->deleteAllSavedPostsById($postId);
		$this->notifications->deleteNotificationsRegardingPost($postId);
		$sql = "DELETE FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}

	public function countPostsByUsername(string $username): int
	{
		$sql = "SELECT COUNT(*) FROM posts WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row()[0] ?? 0;
	}

	public function getLastPostId(): int
	{
		$sql = "SELECT PostID FROM posts ORDER BY PostID DESC LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_row()[0] ?? 0;
	}
}
