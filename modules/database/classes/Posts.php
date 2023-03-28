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

	public function insertPost($fileName, $textContent, $dateAndTime, $username)
	{
		$sql = "INSERT INTO posts (FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ssss", $fileName, $textContent, $dateAndTime, $username);
		$stmt->execute();
	}

	public function getPostById($postId)
	{
		$sql = "SELECT * FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_row();
		} else {
			// TODO: return false?
			return false;
		}
	}

	public function getPostsByUsername($username)
	{
		$sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: return false?
			return false;
		}
	}

	public function getPostsForHomeByUsername($username)
	{
		$sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE Username = ?) ORDER BY DateAndTime DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: return false?
			return false;
		}
	}

	public function getPostsByCategoryIdAndUsername($categoryId, $username)
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("is", $categoryId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: perchè return false?
			return false;
		}
	}

	public function getPostsForExploreByUsername($username)
	{
		$sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			// TODO: perchè return false?
			return false;
		}
	}

	public function updatePost($postId, $textContent)
	{
		$query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("si", $textContent, $postId);
		$stmt->execute();
	}

	public function deletePostById($postId)
	{
		$this->postCategories->deleteAllCategoriesFromPost($postId);
		$this->postReactions->deleteAllReactionsFromPost($postId);
		$this->comments->deleteAllCommentsFromPost($postId);
		$this->savedPosts->deleteSavedPostById($postId);
		// TODO delete post from notifications
		$sql = "DELETE FROM posts WHERE PostID = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $postId);
		$stmt->execute();
	}

	// public function getLastPostId()
	// {
	// 	$sql = "SELECT PostID FROM posts ORDER BY PostID DESC LIMIT 1";
	// 	$stmt = $this->db->prepare($sql);
	// 	$stmt->execute();
	// 	$result = $stmt->get_result();
	// 	if ($result->num_rows > 0) {
	// 		return $result->fetch_row();
	// 	} else {
	// 		return array(0);
	// 	}
	// }

	public function countPostsByUsername($username)
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
