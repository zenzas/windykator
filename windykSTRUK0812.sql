-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 08 Gru 2013, 08:22
-- Wersja serwera: 5.5.24-log
-- Wersja PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wierzyciel`
--

DROP TABLE IF EXISTS `wierzyciel`;
CREATE TABLE `wierzyciel` (
  `id_wierzyciela` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelnomocnika` int(11) DEFAULT NULL,
  `id_kategorii_zaspokojenia` int(11) NOT NULL,
  `typ_stopy_procentowej` enum('referencyjna','podatkowa','lombardowa','stopa z wyroku') NOT NULL,
  `stopa_z_wyroku` decimal(10,2) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id_wierzyciela`),
  KEY `fk_wierzyciel_wierzyciel_typ` (`id_kategorii_zaspokojenia`),
  KEY `fk_wierzyciel_users` (`id_users`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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
  `oplata_komornicza` decimal(6,2) NOT NULL,
  `koszty_egzekucyjne` varchar(45) NOT NULL,
  `pozostala_kwota_zadluzenia` decimal(10,2) NOT NULL,
  `pozostale_odsetki` decimal(10,2) NOT NULL,
  `pozostale_koszty_egzekucyjne` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_wplaty_dla_wierzycieli`),
  KEY `fk_wplaty_dla_wierzycieli_wplaty` (`id_wplaty`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
  `id_zajęcia` int(11) NOT NULL,
  `id_sprawy` int(11) NOT NULL,
  `id_dluz_wierzyt` int(11) NOT NULL,
  PRIMARY KEY (`id_zajęcia`),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Ograniczenia dla zrzutów tabel
--

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
  ADD CONSTRAINT `wierzyciel_ibfk_3` FOREIGN KEY (`id_kategorii_zaspokojenia`) REFERENCES `kategorie_zaspokojenia` (`id_kategorii_zaspokojenia`),
  ADD CONSTRAINT `wierzyciel_ibfk_4` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
