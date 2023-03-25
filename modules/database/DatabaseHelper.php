<?php

require_once "classes/*";

class DatabaseHelper
{
	private $db;
	private $categories;
	private $postCategories;
	private $comments;
	private $notifications;
	private $posts;
	private $reactions;
	private $postReactions;
	private $savedPosts;
	private $follows;
	private $users;

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

	public function categories()
	{
		return $this->categories;
	}

	public function postCategories()
	{
		return $this->postCategories;
	}

	public function comments()
	{
		return $this->comments;
	}

	public function notifications()
	{
		return $this->notifications;
	}

	public function posts()
	{
		return $this->posts;
	}

	public function reactions()
	{
		return $this->reactions;
	}

	public function postReactions()
	{
		return $this->postReactions;
	}

	public function savedPosts()
	{
		return $this->savedPosts;
	}

	public function follows()
	{
		return $this->follows;
	}

	public function users()
	{
		return $this->users;
	}
}
