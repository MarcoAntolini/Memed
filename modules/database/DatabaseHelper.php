<?php

require_once "classes/Categories.php";
require_once "classes/PostCategories.php";
require_once "classes/Comments.php";
require_once "classes/Notifications.php";
require_once "classes/Posts.php";
require_once "classes/Reactions.php";
require_once "classes/PostReactions.php";
require_once "classes/SavedPosts.php";
require_once "classes/Follows.php";
require_once "classes/Users.php";

class DatabaseHelper
{
	private mysqli $db;
	private Categories $categories;
	private PostCategories $postCategories;
	private Notifications $notifications;
	private Reactions $reactions;
	private PostReactions $postReactions;
	private SavedPosts $savedPosts;
	private Users $users;
	private Follows $follows;
	private Posts $posts;
	private Comments $comments;

	public function __construct(string $servername, string $username, string $password, string $dbname, int $port)
	{
		$this->db = new mysqli($servername, $username, $password, $dbname, $port);
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
		}
		$this->categories = new Categories($this->db);
		$this->postCategories = new PostCategories($this->db);
		$this->notifications = new Notifications($this->db);
		$this->reactions = new Reactions($this->db);
		$this->postReactions = new PostReactions($this->db);
		$this->savedPosts = new SavedPosts($this->db);
		$this->users = new Users($this->db);
		$this->follows = new Follows($this->db);
		$this->posts = new Posts($this->db);
		$this->comments = new Comments($this->db);
		$this->follows->linkColumns($this->notifications);
		$this->posts->linkColumns(
			$this->postCategories,
			$this->postReactions,
			$this->comments,
			$this->savedPosts,
			$this->notifications
		);
		$this->comments->linkColumns($this->notifications, $this->posts);
	}

	public function categories(): Categories
	{
		return $this->categories;
	}

	public function postCategories(): PostCategories
	{
		return $this->postCategories;
	}

	public function comments(): Comments
	{
		return $this->comments;
	}

	public function notifications(): Notifications
	{
		return $this->notifications;
	}

	public function posts(): Posts
	{
		return $this->posts;
	}

	public function reactions(): Reactions
	{
		return $this->reactions;
	}

	public function postReactions(): PostReactions
	{
		return $this->postReactions;
	}

	public function savedPosts(): SavedPosts
	{
		return $this->savedPosts;
	}

	public function follows(): Follows
	{
		return $this->follows;
	}

	public function users(): Users
	{
		return $this->users;
	}
}
