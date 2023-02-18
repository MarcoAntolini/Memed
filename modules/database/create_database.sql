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

CREATE DATABASE IF NOT EXISTS `memed` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memed`;

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `Name` char(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `post_categories` (
  `PostID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `TextContent` varchar(150) NOT NULL,
  `DateAndTime` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Message` varchar(150) NOT NULL,
  `DateAndTime` datetime NOT NULL,
  `Read` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `posts` (
  `PostID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL
  `FileName` varchar(100) DEFAULT NULL,
  `TextContent` varchar(250) DEFAULT NULL,
  `DateAndTime` datetime NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `reactions` (
  `ReactionID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `post_reactions` (
  `ReactionID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL
  `Username` varchar(30) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `saved_posts` (
  `Username` varchar(30) NOT NULL
  `PostID` int(11) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `follows` (
  `FollowedUsername` varchar(30) NOT NULL,
  `FollowerUsername` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `users` (
  `Username` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` char(128) NOT NULL,
  `PasswordSalt` char(128) NOT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `Bio` varchar(150) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

ALTER TABLE `categories`
ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `ID_CATEGORIA_IND` (`CategoryID`);

ALTER TABLE `post_categories`
ADD PRIMARY KEY (`PostID`, `CategoryID`),
  ADD UNIQUE KEY `ID_post_categories_IND` (`PostID`, `CategoryID`),
  ADD KEY `FKa_IND` (`CategoryID`);

ALTER TABLE `comments`
ADD PRIMARY KEY (`PostID`, `Username`, `CommentID`),
  ADD UNIQUE KEY `ID_COMMENTO_IND` (`PostID`, `Username`, `CommentID`),
  ADD KEY `FKfa_IND` (`Username`);

ALTER TABLE `notifications`
ADD PRIMARY KEY (`Username`, `NotificationID`),
  ADD UNIQUE KEY `ID_NOTIFICA_IND` (`Username`, `NotificationID`);

ALTER TABLE `posts`
ADD PRIMARY KEY (`PostID`),
  ADD UNIQUE KEY `ID_POST_IND` (`PostID`),
  ADD KEY `FKcrea_IND` (`Username`);

ALTER TABLE `reactions`
ADD PRIMARY KEY (`ReactionID`),
  ADD UNIQUE KEY `ID_REAZIONE_IND` (`ReactionID`);

ALTER TABLE `post_reactions`
ADD PRIMARY KEY (`ReactionID`, `Username`, `PostID`),
  ADD UNIQUE KEY `ID_REAZIONE_PU_IND` (`ReactionID`, `Username`, `PostID`),
  ADD KEY `FKhareazione_IND` (`PostID`),
  ADD KEY `FKreagisce_IND` (`Username`);

ALTER TABLE `saved_posts`
ADD PRIMARY KEY (`PostID`, `Username`),
  ADD UNIQUE KEY `ID_salva_IND` (`PostID`, `Username`),
  ADD KEY `FKsal_UTE_IND` (`Username`);

ALTER TABLE `follows`
ADD PRIMARY KEY (`FollowerUsername`, `FollowedUsername`),
  ADD UNIQUE KEY `ID_segue_IND` (`FollowerUsername`, `FollowedUsername`),
  ADD KEY `FKfollower_IND` (`FollowedUsername`);

ALTER TABLE `users`
ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `ID_UTENTI_IND` (`Username`);

ALTER TABLE `post_categories`
ADD CONSTRAINT `FKa_FK` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`),
  ADD CONSTRAINT `FKs` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);

ALTER TABLE `comments`
ADD CONSTRAINT `FKfa_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`),
  ADD CONSTRAINT `FKriceve` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);

ALTER TABLE `notifications`
ADD CONSTRAINT `FKnortifiche` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

ALTER TABLE `posts`
ADD CONSTRAINT `FKcrea_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

ALTER TABLE `post_reactions`
ADD CONSTRAINT `FKhareazione_FK` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`),
  ADD CONSTRAINT `FKreagisce_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`),
  ADD CONSTRAINT `FKtipo` FOREIGN KEY (`ReactionID`) REFERENCES `reactions` (`ReactionID`);

ALTER TABLE `saved_posts`
ADD CONSTRAINT `FKsal_POS` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`),
  ADD CONSTRAINT `FKsal_UTE_FK` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

ALTER TABLE `follows`
ADD CONSTRAINT `FKfollower_FK` FOREIGN KEY (`FollowedUsername`) REFERENCES `users` (`FollowerUsername`),
  ADD CONSTRAINT `FKseg_UTE` FOREIGN KEY (`FollowerUsername`) REFERENCES `users` (`FollowerUsername`);
  
COMMIT;

INSERT INTO `reactions` (`ReactionID`)
VALUES (1),
  (2),
  (3),
  (4),
  (5);

INSERT INTO `categories` (`CategoryID`, `nome`)
VALUES (1, 'Freddura'),
  (2, 'Black Humor'),
  (3, 'Barzelletta'),
  (4, 'Meme');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;