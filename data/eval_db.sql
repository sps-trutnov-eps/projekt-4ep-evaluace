-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Stř 16. pro 2020, 11:13
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
-- Struktura tabulky `eval_formulare`
--

CREATE TABLE `eval_formulare` (
  `id` int(11) NOT NULL,
  `idVzoru` int(11) NOT NULL,
  `idHodiny` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- --------------------------------------------------------

--
-- Struktura tabulky `eval_formulare_vzory`
--

CREATE TABLE `eval_formulare_vzory` (
  `id` int(11) NOT NULL,
  `otazka` text COLLATE utf8_czech_ci NOT NULL,
  `idUcitel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_hodiny`
--

CREATE TABLE `eval_hodiny` (
  `id` int(11) NOT NULL,
  `ucitel_id` int(11) NOT NULL,
  `predmet_id` int(11) NOT NULL,
  `trida_id` int(11) NOT NULL,
  `skupina` int(1) NOT NULL,
  `datum` date NOT NULL,
  `skolniHodina` int(1) NOT NULL,
  `temaHodiny` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `zruseno` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_nezarazene`
--

CREATE TABLE `eval_nezarazene` (
  `id` int(11) NOT NULL,
  `povoleno_od` date NOT NULL,
  `povoleno_do` date NOT NULL,
  `idVzoru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_odpovedi`
--

CREATE TABLE `eval_odpovedi` (
  `id` int(11) NOT NULL,
  `idFormulare` int(11) NOT NULL,
  `odpoved` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_predmety`
--

CREATE TABLE `eval_predmety` (
  `id` int(11) NOT NULL,
  `nazev` varchar(100) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `eval_predmety`
--

INSERT INTO `eval_predmety` (`nazev`) VALUES
('ANG'),
('APS'),
('ATT'),
('AZA'),
('CEK'),
('CIT'),
('CJL'),
('CMT'),
('CNC'),
('DEJ'),
('ECM'),
('EKA'),
('ELE'),
('ELN'),
('ELT'),
('ESP'),
('EZA'),
('FYZ'),
('HAE'),
('ICT'),
('INS'),
('KOM'),
('MAM'),
('MAT'),
('MEC'),
('MIT'),
('MUL'),
('MZA'),
('NEM'),
('OBN'),
('ODV'),
('OPS'),
('PELK'),
('PGR'),
('POS'),
('PRA'),
('PRO'),
('PSY'),
('PUK'),
('PVA'),
('PVY'),
('PXE'),
('RZA'),
('SAZ'),
('SPS'),
('SPZ'),
('STR'),
('STT'),
('TEC'),
('TEK'),
('TEV'),
('UAD'),
('ZEL'),
('ZPV');

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_tridy`
--

CREATE TABLE `eval_tridy` (
  `id` int(11) NOT NULL,
  `trida` varchar(5) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `eval_tridy`
--

INSERT INTO `eval_tridy` (`nazev`) VALUES
('1.A'),
('2.A'),
('3.A'),
('1.B'),
('2.B'),
('3.B'),
('1.C'),
('2.C'),
('3.C'),
('1.EP'),
('2.EP'),
('3.EP'),
('4.EP'),
('1.IT'),
('2.IT'),
('3.IT'),
('4.IT'),
('1.S'),
('2.S'),
('3.S'),
('4.S'),
('1.ST'),
('2.ST'),
('3.ST'),
('4.ST');

-- --------------------------------------------------------

--
-- Struktura tabulky `eval_ucitele`
--

CREATE TABLE `eval_ucitele` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `auth_code` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `eval_formulare`
--
ALTER TABLE `eval_formulare`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_formulare_vzory`
--
ALTER TABLE `eval_formulare_vzory`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_hodiny`
--
ALTER TABLE `eval_hodiny`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_nezarazene`
--
ALTER TABLE `eval_nezarazene`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `eval_odpovedi`
--
ALTER TABLE `eval_odpovedi`
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
-- AUTO_INCREMENT pro tabulku `eval_formulare`
--
ALTER TABLE `eval_formulare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `eval_formulare_vzory`
--
ALTER TABLE `eval_formulare_vzory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `eval_hodiny`
--
ALTER TABLE `eval_hodiny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `eval_nezarazene`
--
ALTER TABLE `eval_nezarazene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `eval_odpovedi`
--
ALTER TABLE `eval_odpovedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `eval_predmety`
--
ALTER TABLE `eval_predmety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `eval_tridy`
--
ALTER TABLE `eval_tridy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pro tabulku `eval_ucitele`
--
ALTER TABLE `eval_ucitele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
