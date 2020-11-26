-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Stř 25. lis 2020, 10:58
-- Verze serveru: 10.1.41-MariaDB-0+deb9u1
-- Verze PHP: 7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `7ep_jarolimek`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_dotazniky`
--

CREATE TABLE `eval_dotazniky` (
  `id` int(4) NOT NULL,
  `ucitel_id` int(2) NOT NULL,
  `predmet_id` int(2) NOT NULL,
  `trida_id` int(2) NOT NULL,
  `skupina` int(1) NOT NULL,
  `datum` date NOT NULL,
  `skolniHodina` int(1) NOT NULL,
  `temaHodiny` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zruseno` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_odpovedi`
--

CREATE TABLE `eval_odpovedi` (
  `id` int(4) NOT NULL,
  `otazka_id` int(4) NOT NULL,
  `odpoved_text` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `odpoved_vyber` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_otazky`
--

CREATE TABLE `eval_otazky` (
  `id` int(4) NOT NULL,
  `text` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `dotaznik_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_predmety`
--

CREATE TABLE `eval_predmety` (
  `id` int(2) NOT NULL,
  `nazev` varchar(100) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_tridy`
--

CREATE TABLE `eval_tridy` (
  `id` int(2) NOT NULL,
  `trida` varchar(5) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_ucitele`
--

CREATE TABLE `eval_ucitele` (
  `id` int(2) NOT NULL,
  `email` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `eval_dotazniky`
--
ALTER TABLE `eval_dotazniky`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_otazky`
--
ALTER TABLE `eval_otazky`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_predmety`
--
ALTER TABLE `eval_predmety`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazev` (`nazev`);

--
-- Klíče pro tabulku `eval_tridy`
--
ALTER TABLE `eval_tridy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trida` (`trida`);

--
-- Klíče pro tabulku `eval_ucitele`
--
ALTER TABLE `eval_ucitele`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `eval_otazky`
--
ALTER TABLE `eval_otazky`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `eval_predmety`
--
ALTER TABLE `eval_predmety`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `eval_tridy`
--
ALTER TABLE `eval_tridy`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `eval_ucitele`
--
ALTER TABLE `eval_ucitele`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
