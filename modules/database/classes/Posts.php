<?php

class Posts
{
	private mysqli $db;
	private PostCategories $postCategories;
	private PostReactions $postReactions;
	private Comments $comments;
	private SavedPosts $savedPosts;

	public function __construct(
		mysqli $db,
		PostCategories $postCategories,
		PostReactions $postReactions,
		Comments $comments,
		SavedPosts $savedPosts
	) {
		$this->db = $db;
		$this->postCategories = $postCategories;
		$this->postReactions = $postReactions;
		$this->comments = $comments;
		$this->savedPosts = $savedPosts;
	}

	public function insertPost($fileName, $textContent, $dateAndTime, $username): void
	{
		$sql = "INSERT INTO posts (FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ssss", $fileName, $textContent, $dateAndTime, $username);
		$stmt->execute();
	}

	public function getPostById($postId): array
	{
		$sql = "SELECT * FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return array(0);
		}
	}

	public function getPostsByUsername($username): array
	{
		$sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
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

	public function getPostsForHomeByUsername($username)
	{
		$sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE Username = ?)
				ORDER BY DateAndTime DESC";
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

	public function getPostsByCategoryIdAndUsername($categoryId, $username): array
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID
				IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID
				ORDER BY AVG(post_reactions.ReactionID) DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $categoryId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			return array(0);
		}
	}

	public function getPostsForExploreByUsername($username): array
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ?
				GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
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

	public function updatePost($textContent, $postId): void
	{
		$query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("si", $textContent, $postId);
		$stmt->execute();
	}

	public function deletePostById($postId): void
	{
		$this->postCategories->deleteAllCategoriesFromPost($postId);
		$this->postReactions->deleteAllReactionsFromPost($postId);
		$this->comments->deleteAllCommentsFromPost($postId);
		$this->savedPosts->deleteAllSavedPostsById($postId);
		// TODO delete post from notifications
		$sql = "DELETE FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}

	public function countPostsByUsername($username): int
	{
		$sql = "SELECT COUNT(*) FROM posts WHERE Username = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			return 0;
		}
	}
}
