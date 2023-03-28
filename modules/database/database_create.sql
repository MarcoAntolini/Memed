-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Server version: 10.4.25-MariaDB
-- PHP version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

CREATE DATABASE IF NOT EXISTS memed DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE memed;

CREATE TABLE categories (
  CategoryID int(11) NOT NULL,
  Name char(30) NOT NULL,
  CONSTRAINT CATEGORY_ID PRIMARY KEY (CategoryID)
);

CREATE TABLE post_categories (
  PostID int(11) NOT NULL,
  CategoryID int(11) NOT NULL,
  CONSTRAINT POST_CATEGORY_ID PRIMARY KEY (PostID, CategoryID)
);

CREATE TABLE comments (
  CommentID int(11) NOT NULL AUTOINCREMENT,
  PostID int(11) NOT NULL,
  Username varchar(30) NOT NULL,
  TextContent varchar(150) NOT NULL,
  DateAndTime datetime NOT NULL,
  CONSTRAINT COMMENT_ID PRIMARY KEY (PostID, Username, CommentID)
);

CREATE TABLE notifications (
  NotificationID int(11) NOT NULL AUTOINCREMENT,
  Username varchar(30) NOT NULL,
  Message varchar(150) NOT NULL,
  DateAndTime datetime NOT NULL,
  `Read` tinyint(1) NOT NULL,
  CONSTRAINT NOTIFICATION_ID PRIMARY KEY (Username, NotificationID)
);

CREATE TABLE posts (
  PostID int(11) NOT NULL AUTOINCREMENT,
  Username varchar(30) NOT NULL,
  FileName varchar(100) DEFAULT NULL,
  TextContent varchar(250) DEFAULT NULL,
  DateAndTime datetime NOT NULL,
  CONSTRAINT POST_ID PRIMARY KEY (PostID)
);

CREATE TABLE reactions (
  ReactionID int(11) NOT NULL,
  CONSTRAINT REACTION_ID PRIMARY KEY (ReactionID)
);

CREATE TABLE post_reactions (
  ReactionID int(11) NOT NULL,
  PostID int(11) NOT NULL,
  Username varchar(30) NOT NULL,
  CONSTRAINT POST_REACTION_ID PRIMARY KEY (ReactionID, Username, PostID)
);

CREATE TABLE saved_posts (
  Username varchar(30) NOT NULL,
  PostID int(11) NOT NULL,
  CONSTRAINT SAVED_POST_ID PRIMARY KEY (PostID, Username)
);

CREATE TABLE follows (
  FollowedUsername varchar(30) NOT NULL,
  FollowerUsername varchar(30) NOT NULL,
  CONSTRAINT FOLLOW_ID PRIMARY KEY (FollowerUsername, FollowedUsername)
);

CREATE TABLE users (
  Username varchar(30) NOT NULL,
  Email varchar(30) NOT NULL,
  Password char(128) NOT NULL,
  PasswordSalt char(128) NOT NULL,
  FileName varchar(100) DEFAULT NULL,
  Bio varchar(150) NOT NULL,
  CONSTRAINT USER_ID PRIMARY KEY (Username)
);

ALTER TABLE post_categories
  ADD CONSTRAINT FK_CATEGORY_CATEGORY_ID FOREIGN KEY (CategoryID) REFERENCES categories (CategoryID),
  ADD CONSTRAINT FK_CATEGORY_POST_ID FOREIGN KEY (PostID) REFERENCES posts (PostID);

ALTER TABLE comments
  ADD CONSTRAINT FK_COMMENT_USERNAME FOREIGN KEY (Username) REFERENCES users (Username),
  ADD CONSTRAINT FK_COMMENT_POST_ID FOREIGN KEY (PostID) REFERENCES posts (PostID);

ALTER TABLE notifications
  ADD CONSTRAINT FK_NOTIFICATION_USERNAME FOREIGN KEY (Username) REFERENCES users (Username);

ALTER TABLE posts
  ADD CONSTRAINT FK_POST_USERNAME FOREIGN KEY (Username) REFERENCES users (Username);

ALTER TABLE post_reactions
  ADD CONSTRAINT FK_REACTION_POST_ID FOREIGN KEY (PostID) REFERENCES posts (PostID),
  ADD CONSTRAINT FK_REACTION_USERNAME FOREIGN KEY (Username) REFERENCES users (Username),
  ADD CONSTRAINT FK_REACTION_REACTION_ID FOREIGN KEY (ReactionID) REFERENCES reactions (ReactionID);

ALTER TABLE saved_posts
  ADD CONSTRAINT FK_SAVED_POST_ID FOREIGN KEY (PostID) REFERENCES posts (PostID),
  ADD CONSTRAINT FK_SAVED_USERNAME FOREIGN KEY (Username) REFERENCES users (Username);

ALTER TABLE follows
  ADD CONSTRAINT FK_FOLLOWED_USERNAME FOREIGN KEY (FollowedUsername) REFERENCES users (Username),
  ADD CONSTRAINT FK_FOLLOWER_USERNAME FOREIGN KEY (FollowerUsername) REFERENCES users (Username);

COMMIT;

INSERT INTO reactions (ReactionID)
VALUES
  (1),
  (2),
  (3),
  (4),
  (5);

INSERT INTO categories (CategoryID, Name)
VALUES
  (1, 'Freddura'),
  (2, 'Black Humor'),
  (3, 'Barzelletta'),
  (4, 'Meme');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;