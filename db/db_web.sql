-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 19, 2023 alle 17:12
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `IDuser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `idcommento` int(11) NOT NULL,
  `testo` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `N_C_IDuser` int(11) NOT NULL,
  `N_C_idpost` int(11) NOT NULL,
  `N_C_idcommento` int(11) NOT NULL,
  `messaggio` varchar(100) NOT NULL,
  `IDuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `idpost` int(11) NOT NULL,
  `nomefile` varchar(100) DEFAULT NULL,
  `testo` varchar(250) DEFAULT NULL,
  `data` datetime NOT NULL,
  `IDuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `reazione`
--

CREATE TABLE `reazione` (
  `idreazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `reazione_pu`
--

CREATE TABLE `reazione_pu` (
  `IDuser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `idreazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `salva`
--

CREATE TABLE `salva` (
  `idpost` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `segue`
--

CREATE TABLE `segue` (
  `Fol_IDuser` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL,
  `messaggio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `IDuser` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `emal` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`IDuser`,`idpost`,`idcommento`),
  ADD UNIQUE KEY `ID_COMMENTO_IND` (`IDuser`,`idpost`,`idcommento`),
  ADD KEY `FKriceve_IND` (`idpost`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`N_C_IDuser`,`N_C_idpost`,`N_C_idcommento`),
  ADD UNIQUE KEY `FKnot_COM_IND` (`N_C_IDuser`,`N_C_idpost`,`N_C_idcommento`),
  ADD KEY `FKnot_UTE_IND` (`IDuser`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`),
  ADD UNIQUE KEY `ID_POST_IND` (`idpost`),
  ADD KEY `FKcrea_IND` (`IDuser`);

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
  ADD PRIMARY KEY (`IDuser`,`idpost`,`idreazione`),
  ADD UNIQUE KEY `ID_REAZIONE_PU_IND` (`IDuser`,`idpost`,`idreazione`),
  ADD KEY `FKvaluta_IND` (`idreazione`),
  ADD KEY `FKrutente_IND` (`idpost`);

--
-- Indici per le tabelle `salva`
--
ALTER TABLE `salva`
  ADD PRIMARY KEY (`idpost`,`IDuser`),
  ADD UNIQUE KEY `ID_salva_IND` (`idpost`,`IDuser`),
  ADD KEY `FKsal_UTE_IND` (`IDuser`);

--
-- Indici per le tabelle `segue`
--
ALTER TABLE `segue`
  ADD PRIMARY KEY (`Fol_IDuser`,`IDuser`),
  ADD UNIQUE KEY `ID_segue_IND` (`Fol_IDuser`,`IDuser`),
  ADD KEY `FKsegue_1_IND` (`IDuser`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IDuser`),
  ADD UNIQUE KEY `ID_UTENTE_IND` (`IDuser`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `FKfa` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`),
  ADD CONSTRAINT `FKriceve_FK` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`);

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKnot_COM_FK` FOREIGN KEY (`N_C_IDuser`,`N_C_idpost`,`N_C_idcommento`) REFERENCES `commento` (`IDuser`, `idpost`, `idcommento`),
  ADD CONSTRAINT `FKnot_UTE_FK` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`);

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FKcrea_FK` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`);

--
-- Limiti per la tabella `reazione_pu`
--
ALTER TABLE `reazione_pu`
  ADD CONSTRAINT `FKrpost` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`),
  ADD CONSTRAINT `FKrutente_FK` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`),
  ADD CONSTRAINT `FKvaluta_FK` FOREIGN KEY (`idreazione`) REFERENCES `reazione` (`idreazione`);

--
-- Limiti per la tabella `salva`
--
ALTER TABLE `salva`
  ADD CONSTRAINT `FKsal_POS` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`),
  ADD CONSTRAINT `FKsal_UTE_FK` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`);

--
-- Limiti per la tabella `segue`
--
ALTER TABLE `segue`
  ADD CONSTRAINT `FKfollower` FOREIGN KEY (`Fol_IDuser`) REFERENCES `utente` (`IDuser`),
  ADD CONSTRAINT `FKsegue_1_FK` FOREIGN KEY (`IDuser`) REFERENCES `utente` (`IDuser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
