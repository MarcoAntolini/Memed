<?php

require_once "classes/*";

class DatabaseHelper
{
	private mysqli $db;
	private Categories $categories;
	private PostCategories $postCategories;
	private Comments $comments;
	private Notifications $notifications;
	private Posts $posts;
	private Reactions $reactions;
	private PostReactions $postReactions;
	private SavedPosts $savedPosts;
	private Follows $follows;
	private Users $users;

	public function __construct($servername, $username, $password, $dbname, $port)
	{
		$this->db = new mysqli($servername, $username, $password, $dbname, $port);
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
		}
		$this->categories = new Categories($this->db);
		$this->postCategories = new PostCategories($this->db);
		$this->comments = new Comments($this->db);
		$this->notifications = new Notifications($this->db);
		$this->posts = new Posts($this->db);
		$this->reactions = new Reactions($this->db);
		$this->postReactions = new PostReactions($this->db);
		$this->savedPosts = new SavedPosts($this->db);
		$this->follows = new Follows($this->db);
		$this->users = new Users($this->db);
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
