-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 24 Lis 2013, 01:21
-- Wersja serwera: 5.5.24-log
-- Wersja PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `windykacja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_zaspokojenia`
--

DROP TABLE IF EXISTS `kategorie_zaspokojenia`;
CREATE TABLE `kategorie_zaspokojenia` (
  `id_kategorii_zaspokojenia` int(11) NOT NULL AUTO_INCREMENT,
  `numer` varchar(5) NOT NULL,
  `priorytet` int(11) NOT NULL,
  PRIMARY KEY (`id_kategorii_zaspokojenia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `kategorie_zaspokojenia`
--

INSERT INTO `kategorie_zaspokojenia` (`id_kategorii_zaspokojenia`, `numer`, `priorytet`) VALUES
(1, 'I', 1),
(2, 'II', 2),
(3, 'III', 3),
(4, 'IV', 4),
(5, 'V', 5),
(6, 'VI', 6),
(7, 'VII', 7),
(8, 'VIII', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oplaty_komornicze`
--

DROP TABLE IF EXISTS `oplaty_komornicze`;
CREATE TABLE `oplaty_komornicze` (
  `id_oplaty` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `kwota_oplaty` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_oplaty`),
  KEY `oplaty_wplaty_fk` (`id_wplaty`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprawy`
--

DROP TABLE IF EXISTS `sprawy`;
CREATE TABLE `sprawy` (
  `id_sprawy` int(11) NOT NULL AUTO_INCREMENT,
  `nr_sprawy` varchar(10) DEFAULT NULL,
  `data_odbioru_akt` date DEFAULT NULL,
  `data_nadania_akt` date DEFAULT NULL,
  `data_odbioru_postanowienia_org` date DEFAULT NULL,
  `data_postanowienia_org` date DEFAULT NULL,
  `przyczyna_zakonczenia` enum('egzekucja aktywna','nieskuteczna egzekucja','przekazanie innemu organowi','zaspokojenie wierzycieli','umorzenie na żądanie') DEFAULT NULL,
  `data_zakonczenia` date DEFAULT NULL,
  `data_odbioru` date DEFAULT NULL,
  `data_wezwania` date DEFAULT NULL,
  `data_wplywu` date DEFAULT NULL,
  `sygn_akt` varchar(15) NOT NULL,
  `data_postanowienia` date DEFAULT NULL,
  `id_dluznika` int(11) NOT NULL,
  `archiwalna` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sprawy`),
  KEY `fk_sprawy_users` (`id_dluznika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stopy_procentowe`
--

DROP TABLE IF EXISTS `stopy_procentowe`;
CREATE TABLE `stopy_procentowe` (
  `id_stopy_procentowej` int(11) NOT NULL AUTO_INCREMENT,
  `referencyjna` decimal(6,2) NOT NULL,
  `lombardowa` decimal(6,2) NOT NULL,
  `podatkowa` decimal(6,2) NOT NULL,
  `data_od` date NOT NULL,
  PRIMARY KEY (`id_stopy_procentowej`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Zrzut danych tabeli `stopy_procentowe`
--

INSERT INTO `stopy_procentowe` (`id_stopy_procentowej`, `referencyjna`, `lombardowa`, `podatkowa`, `data_od`) VALUES
(1, '2.50', '4.00', '13.00', '2013-07-04'),
(2, '24.00', '27.00', '35.00', '1998-02-26'),
(3, '23.00', '27.00', '33.00', '1998-04-23'),
(4, '21.50', '26.00', '33.00', '1998-05-21'),
(5, '19.00', '24.00', '33.00', '1998-07-17'),
(6, '18.00', '24.00', '33.00', '1998-09-10'),
(7, '17.00', '22.00', '33.00', '1998-10-29'),
(8, '15.50', '20.00', '33.00', '1998-12-10'),
(9, '13.00', '17.00', '33.00', '1999-01-21'),
(10, '14.00', '17.00', '21.00', '1999-09-23'),
(11, '16.00', '20.00', '21.00', '1999-11-18'),
(12, '17.00', '21.00', '21.00', '2000-02-24'),
(13, '19.00', '23.00', '21.00', '2000-08-31'),
(14, '18.00', '22.00', '30.00', '2001-03-01'),
(15, '17.00', '21.00', '30.00', '2001-03-29'),
(16, '15.00', '19.00', '30.00', '2001-06-28'),
(17, '14.00', '18.00', '30.00', '2001-08-23'),
(18, '13.00', '17.00', '30.00', '2001-10-26'),
(19, '11.50', '15.50', '30.00', '2001-11-29'),
(20, '11.50', '15.50', '30.00', '2001-12-01'),
(21, '10.00', '13.50', '20.00', '2002-01-31'),
(22, '9.50', '12.50', '20.00', '2002-04-26'),
(23, '9.00', '12.00', '20.00', '2002-05-30'),
(24, '8.50', '11.50', '20.00', '2002-06-27'),
(25, '8.00', '10.50', '16.00', '2002-08-29'),
(26, '7.50', '10.00', '16.00', '2002-09-26'),
(27, '7.00', '9.00', '16.00', '2002-10-24'),
(28, '6.75', '8.75', '16.00', '2002-11-28'),
(29, '6.50', '8.50', '16.00', '2003-01-30'),
(30, '6.25', '8.00', '13.00', '2003-02-27'),
(31, '6.00', '7.75', '13.00', '2003-03-27'),
(32, '5.75', '7.25', '13.00', '2003-04-25'),
(33, '5.50', '7.00', '13.00', '2003-05-29'),
(34, '5.25', '6.75', '13.00', '2003-06-26'),
(35, '5.75', '7.25', '12.25', '2004-07-01'),
(36, '6.00', '7.50', '12.25', '2004-07-29'),
(37, '6.50', '8.00', '12.25', '2004-08-26'),
(38, '6.00', '7.50', '13.50', '2005-03-31'),
(39, '5.50', '7.00', '13.50', '2005-04-28'),
(40, '5.00', '6.50', '13.50', '2005-06-30'),
(41, '4.75', '6.25', '13.50', '2005-07-28'),
(42, '4.50', '6.00', '13.50', '2005-09-01'),
(43, '4.25', '5.75', '11.50', '2006-02-01'),
(44, '4.00', '5.50', '11.50', '2006-03-01'),
(45, '4.25', '5.75', '11.50', '2007-04-26'),
(46, '4.50', '6.00', '11.50', '2007-06-28'),
(47, '4.75', '6.25', '11.50', '2007-08-30'),
(48, '5.00', '6.50', '11.50', '2007-11-29'),
(49, '5.25', '6.75', '11.50', '2008-01-31'),
(50, '5.50', '7.00', '11.50', '2008-02-28'),
(51, '5.75', '7.25', '11.50', '2008-03-27'),
(52, '6.00', '7.50', '11.50', '2008-06-26'),
(53, '5.75', '7.25', '11.50', '2008-11-27'),
(54, '5.00', '6.50', '13.00', '2008-12-24'),
(55, '4.25', '5.75', '13.00', '2009-01-28'),
(56, '4.00', '5.50', '13.00', '2009-02-26'),
(57, '3.75', '5.25', '13.00', '2009-03-26'),
(58, '3.50', '5.00', '13.00', '2009-06-25'),
(59, '3.50', '5.00', '13.00', '2010-01-01'),
(60, '3.75', '5.25', '13.00', '2011-01-20'),
(61, '4.00', '5.50', '13.00', '2011-04-06'),
(62, '4.25', '5.75', '13.00', '2011-05-12'),
(63, '4.50', '6.00', '13.00', '2011-06-09'),
(64, '4.75', '6.25', '13.00', '2012-05-10'),
(65, '4.50', '6.00', '13.00', '2012-11-08'),
(66, '4.25', '5.75', '13.00', '2012-12-06'),
(67, '4.00', '5.50', '13.00', '2013-01-10'),
(68, '3.75', '5.25', '13.00', '2013-02-07'),
(69, '3.25', '4.75', '13.00', '2013-03-07'),
(70, '3.00', '4.50', '13.00', '2013-05-09'),
(71, '2.75', '4.25', '13.00', '2013-06-06'),
(82, '5.75', '7.25', '13.00', '2008-12-15'),
(83, '24.00', '27.00', '33.00', '1998-04-15'),
(84, '13.00', '17.00', '24.00', '1999-02-01'),
(85, '13.00', '17.00', '21.00', '1999-05-15'),
(86, '19.00', '23.00', '30.00', '2000-11-01'),
(87, '11.50', '15.50', '20.00', '2001-12-15'),
(88, '8.50', '11.50', '16.00', '2002-07-25'),
(89, '6.50', '8.50', '13.00', '2003-02-01'),
(90, '5.25', '6.75', '12.25', '2003-09-25'),
(91, '6.50', '8.00', '13.50', '2005-01-10'),
(92, '4.50', '6.00', '11.50', '2005-10-15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) NOT NULL,
  `id_users_typy` int(11) NOT NULL,
  PRIMARY KEY (`id_users`),
  KEY `fk_users_users_typy` (`id_users_typy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_users`, `nazwa`, `id_users_typy`) VALUES
(1, 'administrator', 1),
(11, 'operator', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_dane`
--

DROP TABLE IF EXISTS `users_dane`;
CREATE TABLE `users_dane` (
  `id_users_dane` int(11) NOT NULL AUTO_INCREMENT,
  `ulica` varchar(45) DEFAULT NULL,
  `nr_dom` varchar(5) DEFAULT NULL,
  `nr_lokal` varchar(5) DEFAULT NULL,
  `miasto` varchar(45) DEFAULT NULL,
  `kod` varchar(6) DEFAULT NULL,
  `nr_telefonu` varchar(9) DEFAULT NULL,
  `PESEL` varchar(11) DEFAULT NULL,
  `NIP` varchar(10) DEFAULT NULL,
  `nr_rachunku` varchar(26) DEFAULT NULL,
  `logowanie` tinyint(1) NOT NULL DEFAULT '0',
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id_users_dane`),
  UNIQUE KEY `NIP_UNIQUE` (`NIP`),
  KEY `fk_users_dane_users` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_login`
--

DROP TABLE IF EXISTS `users_login`;
CREATE TABLE `users_login` (
  `id_users_login` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `aktywny` tinyint(1) NOT NULL,
  `id_users` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id_users_login`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_login_users` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `users_login`
--

INSERT INTO `users_login` (`id_users_login`, `login`, `password`, `aktywny`, `id_users`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'admin@windykacja.com'),
(9, 'operator', '4b583376b2767b923c3e1da60d10de59', 1, 11, 'oper@windykacja.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_typy`
--

DROP TABLE IF EXISTS `users_typy`;
CREATE TABLE `users_typy` (
  `id_users_typy` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) NOT NULL,
  PRIMARY KEY (`id_users_typy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `users_typy`
--

INSERT INTO `users_typy` (`id_users_typy`, `nazwa`) VALUES
(1, 'administrator'),
(2, 'operator'),
(3, 'wierzyciel'),
(4, 'dłużnik zajętej wierzytelności'),
(5, 'dłużnik'),
(6, 'komornik'),
(7, 'pełnomocnik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wierzyciel`
--

DROP TABLE IF EXISTS `wierzyciel`;
CREATE TABLE `wierzyciel` (
  `id_wierzyciela` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelnomocnika` int(11) DEFAULT NULL,
  `id_kategorii_zaspokojenia` int(11) NOT NULL,
  `typ_stopy_procentowej` enum('referencyjna','podatkowa','lombardowa') NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_wierzyciela`),
  KEY `fk_wierzyciel_wierzyciel_typ` (`id_kategorii_zaspokojenia`),
  KEY `fk_wierzyciel_users` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wierzyciele_sprawy`
--

DROP TABLE IF EXISTS `wierzyciele_sprawy`;
CREATE TABLE `wierzyciele_sprawy` (
  `id_wierzyciele_sprawy` int(11) NOT NULL AUTO_INCREMENT,
  `id_sprawy` int(11) NOT NULL,
  `id_wierzyciela` int(11) NOT NULL,
  `KM` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_wierzyciele_sprawy`),
  KEY `fk_wierzyciele_sprawy_sprawy` (`id_sprawy`),
  KEY `fk_wierzyciele_sprawy_wierzyciel` (`id_wierzyciela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wnioski`
--

DROP TABLE IF EXISTS `wnioski`;
CREATE TABLE `wnioski` (
  `id_wniosku` int(11) NOT NULL AUTO_INCREMENT,
  `id_operatora` int(11) NOT NULL,
  `id_wnioskodawcy` int(11) NOT NULL,
  `id_sprawy` int(11) NOT NULL,
  `data_wplywu` date NOT NULL,
  `data_odpowiedzi` date DEFAULT NULL,
  `opis_wniosku` text,
  PRIMARY KEY (`id_wniosku`),
  KEY `fk_wnioski_users1` (`id_operatora`),
  KEY `fk_wnioski_users2` (`id_wnioskodawcy`),
  KEY `id_sprawy` (`id_sprawy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wplaty`
--

DROP TABLE IF EXISTS `wplaty`;
CREATE TABLE `wplaty` (
  `id_wplaty` int(11) NOT NULL AUTO_INCREMENT,
  `kwota_wplaty` decimal(10,2) NOT NULL,
  `data_wplaty` date NOT NULL,
  `id_dluznika` int(11) NOT NULL,
  PRIMARY KEY (`id_wplaty`),
  KEY `fk_wplaty_sprawy` (`id_dluznika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wplaty_dla_wierzycieli`
--

DROP TABLE IF EXISTS `wplaty_dla_wierzycieli`;
CREATE TABLE `wplaty_dla_wierzycieli` (
  `id_wplaty_dla_wierzycieli` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `id_wierzyciela` int(11) NOT NULL,
  `kwota_zadluzenia` decimal(10,2) NOT NULL,
  `odsetki` decimal(10,2) NOT NULL,
  `koszty_egzekucyjne` varchar(45) NOT NULL,
  `pozostala_kwota_zadluzenia` decimal(10,2) NOT NULL,
  `pozostale_odsetki` decimal(10,2) NOT NULL,
  `pozostale_koszty_egzekucyjne` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_wplaty_dla_wierzycieli`),
  KEY `fk_wplaty_dla_wierzycieli_wplaty` (`id_wplaty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadluzenie`
--

DROP TABLE IF EXISTS `zadluzenie`;
CREATE TABLE `zadluzenie` (
  `id_zadluzenia` int(11) NOT NULL AUTO_INCREMENT,
  `id_wierzyciele_sprawy` int(11) NOT NULL,
  `data` date NOT NULL,
  `kwota_zadluzenia` decimal(10,2) NOT NULL,
  `odsetki` decimal(10,2) NOT NULL,
  `koszty_egzekucyjne` decimal(10,2) NOT NULL,
  `pozostala_kwota_zadluzenia` decimal(10,2) NOT NULL,
  `pozostale_odsetki` decimal(10,2) NOT NULL,
  `pozostale_koszty_egzekucyjne` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_zadluzenia`),
  KEY `fk_zadluzenie_wierzyciele_sprawy` (`id_wierzyciele_sprawy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zajecia`
--

DROP TABLE IF EXISTS `zajecia`;
CREATE TABLE `zajecia` (
  `idZajęcia` int(11) NOT NULL,
  `id_sprawy` int(11) NOT NULL,
  `id_dluz_wierzyt` int(11) NOT NULL,
  PRIMARY KEY (`idZajęcia`),
  KEY `fk_zajecia_sprawy` (`id_sprawy`),
  KEY `fk_zajecia_users` (`id_dluz_wierzyt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwroty`
--

DROP TABLE IF EXISTS `zwroty`;
CREATE TABLE `zwroty` (
  `id_zwrotu` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `kwota_zwrotu` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id_zwrotu`),
  KEY `zwroty_wplaty_fk` (`id_wplaty`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `oplaty_komornicze`
--
ALTER TABLE `oplaty_komornicze`
  ADD CONSTRAINT `oplaty_komornicze_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`);

--
-- Ograniczenia dla tabeli `sprawy`
--
ALTER TABLE `sprawy`
  ADD CONSTRAINT `sprawy_ibfk_1` FOREIGN KEY (`id_dluznika`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_users_typy`) REFERENCES `users_typy` (`id_users_typy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users_dane`
--
ALTER TABLE `users_dane`
  ADD CONSTRAINT `users_dane_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wierzyciel`
--
ALTER TABLE `wierzyciel`
  ADD CONSTRAINT `wierzyciel_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wierzyciel_ibfk_3` FOREIGN KEY (`id_kategorii_zaspokojenia`) REFERENCES `kategorie_zaspokojenia` (`id_kategorii_zaspokojenia`);

--
-- Ograniczenia dla tabeli `wierzyciele_sprawy`
--
ALTER TABLE `wierzyciele_sprawy`
  ADD CONSTRAINT `wierzyciele_sprawy_ibfk_1` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wierzyciele_sprawy_ibfk_2` FOREIGN KEY (`id_wierzyciela`) REFERENCES `wierzyciel` (`id_wierzyciela`);

--
-- Ograniczenia dla tabeli `wnioski`
--
ALTER TABLE `wnioski`
  ADD CONSTRAINT `wnioski_ibfk_10` FOREIGN KEY (`id_operatora`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wnioski_ibfk_11` FOREIGN KEY (`id_wnioskodawcy`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wnioski_ibfk_5` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wplaty`
--
ALTER TABLE `wplaty`
  ADD CONSTRAINT `wplaty_ibfk_1` FOREIGN KEY (`id_dluznika`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wplaty_dla_wierzycieli`
--
ALTER TABLE `wplaty_dla_wierzycieli`
  ADD CONSTRAINT `wplaty_dla_wierzycieli_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zadluzenie`
--
ALTER TABLE `zadluzenie`
  ADD CONSTRAINT `zadluzenie_ibfk_1` FOREIGN KEY (`id_wierzyciele_sprawy`) REFERENCES `wierzyciele_sprawy` (`id_wierzyciele_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zajecia`
--
ALTER TABLE `zajecia`
  ADD CONSTRAINT `zajecia_ibfk_1` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zajecia_ibfk_2` FOREIGN KEY (`id_dluz_wierzyt`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zwroty`
--
ALTER TABLE `zwroty`
  ADD CONSTRAINT `zwroty_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
