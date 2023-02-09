-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 24, 2023 alle 22:03
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
--
-- Database: `memed`
--
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `memed` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memed`;
-- --------------------------------------------------------
--
-- Struttura della tabella `categoria`
--
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nome` char(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `categoria_post`
--
CREATE TABLE `categoria_post` (
  `idpost` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `commento`
--
CREATE TABLE `commento` (
  `idpost` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `idcommento` int(11) NOT NULL,
  `testo` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `notifica`
--
CREATE TABLE `notifica` (
  `username` varchar(30) NOT NULL,
  `idnotifica` int(11) NOT NULL,
  `mesaggio` varchar(150) NOT NULL,
  `data` datetime NOT NULL,
  `letto` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `post`
--
CREATE TABLE `post` (
  `idpost` int(11) NOT NULL,
  `nomefile` varchar(100) DEFAULT NULL,
  `testo` varchar(250) DEFAULT NULL,
  `data` datetime NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `reazione`
--
CREATE TABLE `reazione` (
  `idreazione` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `reazione_pu`
--
CREATE TABLE `reazione_pu` (
  `idreazione` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `idpost` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `salva`
--
CREATE TABLE `salva` (
  `idpost` int(11) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `segue`
--
CREATE TABLE `segue` (
  `Fol_username` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Struttura della tabella `utenti`
--
CREATE TABLE `utenti` (
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `nomefile` varchar(100) DEFAULT NULL,
  `bio` varchar(150) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Indici per le tabelle scaricate
--
--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
ADD PRIMARY KEY (`idcategoria`),
  ADD UNIQUE KEY `ID_CATEGORIA_IND` (`idcategoria`);
--
-- Indici per le tabelle `categoria_post`
--
ALTER TABLE `categoria_post`
ADD PRIMARY KEY (`idpost`, `idcategoria`),
  ADD UNIQUE KEY `ID_CATEGORIA_POST_IND` (`idpost`, `idcategoria`),
  ADD KEY `FKa_IND` (`idcategoria`);
--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
ADD PRIMARY KEY (`idpost`, `username`, `idcommento`),
  ADD UNIQUE KEY `ID_COMMENTO_IND` (`idpost`, `username`, `idcommento`),
  ADD KEY `FKfa_IND` (`username`);
--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
ADD PRIMARY KEY (`username`, `idnotifica`),
  ADD UNIQUE KEY `ID_NOTIFICA_IND` (`username`, `idnotifica`);
--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
ADD PRIMARY KEY (`idpost`),
  ADD UNIQUE KEY `ID_POST_IND` (`idpost`),
  ADD KEY `FKcrea_IND` (`username`);
--
-- Indici per le tabelle `reazione`
--
ALTER TABLE `reazione`
ADD PRIMARY KEY (`idreazione`),
  ADD UNIQUE KEY `ID_REAZIONE_IND` (`idreazione`);
--
-- Indici per le tabelle `reazione_pu`
--
ALTER TABLE `reazione_pu`
ADD PRIMARY KEY (`idreazione`, `username`, `idpost`),
  ADD UNIQUE KEY `ID_REAZIONE_PU_IND` (`idreazione`, `username`, `idpost`),
  ADD KEY `FKhareazione_IND` (`idpost`),
  ADD KEY `FKreagisce_IND` (`username`);
--
-- Indici per le tabelle `salva`
--
ALTER TABLE `salva`
ADD PRIMARY KEY (`idpost`, `username`),
  ADD UNIQUE KEY `ID_salva_IND` (`idpost`, `username`),
  ADD KEY `FKsal_UTE_IND` (`username`);
--
-- Indici per le tabelle `segue`
--
ALTER TABLE `segue`
ADD PRIMARY KEY (`username`, `Fol_username`),
  ADD UNIQUE KEY `ID_segue_IND` (`username`, `Fol_username`),
  ADD KEY `FKfollower_IND` (`Fol_username`);
--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `ID_UTENTI_IND` (`username`);
--
-- Limiti per le tabelle scaricate
--
--
-- Limiti per la tabella `categoria_post`
--
ALTER TABLE `categoria_post`
ADD CONSTRAINT `FKa_FK` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `FKs` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`);
--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
ADD CONSTRAINT `FKfa_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `FKriceve` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`);
--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
ADD CONSTRAINT `FKnortifiche` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);
--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `FKcrea_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);
--
-- Limiti per la tabella `reazione_pu`
--
ALTER TABLE `reazione_pu`
ADD CONSTRAINT `FKhareazione_FK` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`),
  ADD CONSTRAINT `FKreagisce_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `FKtipo` FOREIGN KEY (`idreazione`) REFERENCES `reazione` (`idreazione`);
--
-- Limiti per la tabella `salva`
--
ALTER TABLE `salva`
ADD CONSTRAINT `FKsal_POS` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`),
  ADD CONSTRAINT `FKsal_UTE_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);
--
-- Limiti per la tabella `segue`
--
ALTER TABLE `segue`
ADD CONSTRAINT `FKfollower_FK` FOREIGN KEY (`Fol_username`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `FKseg_UTE` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;