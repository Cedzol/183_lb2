-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 08. Feb 2024 um 18:09
-- Server-Version: 10.6.15-MariaDB
-- PHP-Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `m183_lb2`
--
USE m183_lb2;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

CREATE TABLE `permissions` (
  `ID` bigint(20) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `roleID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

CREATE TABLE `roles` (
  `ID` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasks`
--

CREATE TABLE `tasks` (
  `ID` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `state` enum('open','in progress','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `to_delete` boolean NOT NULL,
  `delete_date` DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `permissions`
--
ALTER TABLE `permissions`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

-- Adding a foreign key constraint to relate tasks with users
ALTER TABLE `tasks`
    ADD CONSTRAINT `fk_user_tasks`
        FOREIGN KEY (`userID`) REFERENCES `users` (`ID`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

-- Adding a foreign key constraint to relate permissions with users
ALTER TABLE `permissions`
    ADD CONSTRAINT `fk_user_permissions`
        FOREIGN KEY (`userID`) REFERENCES `users` (`ID`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

-- Adding a foreign key constraint to relate permissions with roles
ALTER TABLE `permissions`
    ADD CONSTRAINT `fk_role_permissions`
        FOREIGN KEY (`roleID`) REFERENCES `roles` (`ID`)
            ON DELETE CASCADE
            ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

insert into roles (ID, title) values (2, 'User');
insert into roles (ID, title) values (1, 'Admin');


insert into users (ID, username, password, to_delete, delete_date) values (1, 'admin1', '$2y$10$0kUb4I3Ja0AJWGLsDBg7N.pf1kv0NVlZhFY.vKz9tY.QHy.wDbb3e', 'false', Null);
insert into users (ID, username, password, to_delete, delete_date) values (2, 'user1', '$2y$10$s/ECsRxoC7G2DzJm.7IOzOElI7Jl57mktQtLKW4leyfPO8jxPyRxi', 'false', NULL);

insert into permissions(ID, userID, roleID) values(null, 1, 1);
insert into permissions(ID, userID, roleID) values(null, 2, 2);