-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Úte 13. říj 2020, 10:31
-- Verze serveru: 10.1.41-MariaDB-0+deb9u1
-- Verze PHP: 7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `7ep_strnad`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `4ep_evaluace_temata`
--

CREATE TABLE `4ep_evaluace_temata` (
  `id` int(11) NOT NULL,
  `zruseno` int(1) NOT NULL,
  `datum` date NOT NULL,
  `ucitel` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `predmet` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `trida` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `skupina` int(1) NOT NULL,
  `tema` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `4ep_evaluace_temata`
--
ALTER TABLE `4ep_evaluace_temata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `4ep_evaluace_temata`
--
ALTER TABLE `4ep_evaluace_temata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
