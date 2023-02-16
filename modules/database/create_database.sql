-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

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
  `PostID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `CommentID` int(11) NOT NULL,
  `TextContent` varchar(150) NOT NULL,
  `DateAndTime` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `notifica` (
  `Username` varchar(30) NOT NULL,
  `idnotifica` int(11) NOT NULL,
  `mesaggio` varchar(150) NOT NULL,
  `DateAndTime` datetime NOT NULL,
  `letto` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `post` (
  `PostID` int(11) NOT NULL,
  `nomefile` varchar(100) DEFAULT NULL,
  `TextContent` varchar(250) DEFAULT NULL,
  `DateAndTime` datetime NOT NULL,
  `Username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `reazione` (`idreazione` int(11) NOT NULL) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `reazione_pu` (
  `idreazione` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `PostID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `salva` (
  `PostID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `segue` (
  `Fol_username` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `utenti` (
  `Username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `nomefile` varchar(100) DEFAULT NULL,
  `bio` varchar(150) NOT NULL
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

ALTER TABLE `notifica`
ADD PRIMARY KEY (`Username`, `idnotifica`),
  ADD UNIQUE KEY `ID_NOTIFICA_IND` (`Username`, `idnotifica`);

ALTER TABLE `post`
ADD PRIMARY KEY (`PostID`),
  ADD UNIQUE KEY `ID_POST_IND` (`PostID`),
  ADD KEY `FKcrea_IND` (`Username`);

ALTER TABLE `reazione`
ADD PRIMARY KEY (`idreazione`),
  ADD UNIQUE KEY `ID_REAZIONE_IND` (`idreazione`);

ALTER TABLE `reazione_pu`
ADD PRIMARY KEY (`idreazione`, `Username`, `PostID`),
  ADD UNIQUE KEY `ID_REAZIONE_PU_IND` (`idreazione`, `Username`, `PostID`),
  ADD KEY `FKhareazione_IND` (`PostID`),
  ADD KEY `FKreagisce_IND` (`Username`);

ALTER TABLE `salva`
ADD PRIMARY KEY (`PostID`, `Username`),
  ADD UNIQUE KEY `ID_salva_IND` (`PostID`, `Username`),
  ADD KEY `FKsal_UTE_IND` (`Username`);

ALTER TABLE `segue`
ADD PRIMARY KEY (`Username`, `Fol_username`),
  ADD UNIQUE KEY `ID_segue_IND` (`Username`, `Fol_username`),
  ADD KEY `FKfollower_IND` (`Fol_username`);

ALTER TABLE `utenti`
ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `ID_UTENTI_IND` (`Username`);

ALTER TABLE `post_categories`
ADD CONSTRAINT `FKa_FK` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`),
  ADD CONSTRAINT `FKs` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`);

ALTER TABLE `comments`
ADD CONSTRAINT `FKfa_FK` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `FKriceve` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`);

ALTER TABLE `notifica`
ADD CONSTRAINT `FKnortifiche` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);

ALTER TABLE `post`
ADD CONSTRAINT `FKcrea_FK` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);

ALTER TABLE `reazione_pu`
ADD CONSTRAINT `FKhareazione_FK` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `FKreagisce_FK` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `FKtipo` FOREIGN KEY (`idreazione`) REFERENCES `reazione` (`idreazione`);

ALTER TABLE `salva`
ADD CONSTRAINT `FKsal_POS` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `FKsal_UTE_FK` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);

ALTER TABLE `segue`
ADD CONSTRAINT `FKfollower_FK` FOREIGN KEY (`Fol_username`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `FKseg_UTE` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);
  
COMMIT;

INSERT INTO `reazione` (`idreazione`)
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