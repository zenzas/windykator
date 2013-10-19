SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `oplaty_komornicze`;
CREATE TABLE `oplaty_komornicze` (
  `id_oplaty` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `kwota_oplaty` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_oplaty`),
  KEY `oplaty_wplaty_fk` (`id_wplaty`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

INSERT INTO `oplaty_komornicze` (`id_oplaty`, `id_wplaty`, `kwota_oplaty`) VALUES
(41, 42, '3.53'),
(42, 43, '5.00');

DROP TABLE IF EXISTS `sprawy`;
CREATE TABLE `sprawy` (
  `id_sprawy` int(11) NOT NULL AUTO_INCREMENT,
  `nr_sprawy` varchar(10) DEFAULT NULL,
  `data_wplywu` date NOT NULL,
  `sygn_akt` varchar(15) NOT NULL,
  `data_postanowienia` date NOT NULL,
  `id_dluznika` int(11) NOT NULL,
  `archiwalna` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sprawy`),
  KEY `fk_sprawy_users` (`id_dluznika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

INSERT INTO `sprawy` (`id_sprawy`, `nr_sprawy`, `data_wplywu`, `sygn_akt`, `data_postanowienia`, `id_dluznika`, `archiwalna`) VALUES
(15, NULL, '2008-06-11', 'IICo1597/08', '2008-06-11', 74, 0),
(16, '', '2006-11-24', 'IICo3082/06', '2006-11-24', 75, 0),
(17, NULL, '2012-04-10', 'EA-1/234/12', '2012-03-19', 81, 0),
(18, '', '2012-09-20', 'IICo9882/06', '2012-09-11', 85, 0),
(19, NULL, '2013-09-24', 'ICo4312/13', '2013-03-20', 88, 0),
(20, '', '2013-10-10', 'IICo9866/06', '2013-10-01', 91, 0);

DROP TABLE IF EXISTS `stopy_procentowe`;
CREATE TABLE `stopy_procentowe` (
  `id_stopy_procentowej` int(11) NOT NULL AUTO_INCREMENT,
  `referencyjna` decimal(6,2) NOT NULL,
  `lombardowa` decimal(6,2) NOT NULL,
  `podatkowa` decimal(6,2) NOT NULL,
  `data_od` date NOT NULL,
  PRIMARY KEY (`id_stopy_procentowej`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) NOT NULL,
  `id_users_typy` int(11) NOT NULL,
  PRIMARY KEY (`id_users`),
  KEY `fk_users_users_typy` (`id_users_typy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

INSERT INTO `users` (`id_users`, `nazwa`, `id_users_typy`) VALUES
(1, 'administrator', 1),
(11, 'operator', 2),
(74, 'Krawczyk Edmund', 5),
(75, 'Jeżyna Kazimierz', 5),
(76, 'URBAN', 3),
(77, 'PTC', 3),
(78, 'Wojciech Gąska', 3),
(79, 'Janicka Wioletta', 3),
(80, 'Bank Handlowy w Warszawie', 3),
(81, 'Konkordia', 5),
(82, 'Trzeci Urząd Skarbowy w Lublinie', 3),
(83, 'Bank Zachodni WBK S.A.', 3),
(84, 'KOMEKO', 3),
(85, 'Zielińska', 5),
(86, 'Lukas Bank', 3),
(87, 'BEST', 3),
(88, 'Matrix', 5),
(89, 'szkoła podstawowa lotnicza', 3),
(90, 'skrugow', 3),
(91, 'Val Kilmer', 5),
(92, 'Trzeci Urząd Skarbowy', 3),
(93, 'PEKAO S.A.', 3);

DROP TABLE IF EXISTS `users_dane`;
CREATE TABLE `users_dane` (
  `id_users_dane` int(11) NOT NULL AUTO_INCREMENT,
  `ulica` varchar(45) NOT NULL,
  `nr_dom` varchar(5) NOT NULL,
  `nr_lokal` varchar(5) DEFAULT NULL,
  `miasto` varchar(45) NOT NULL,
  `kod` varchar(6) NOT NULL,
  `nr_telefonu` varchar(9) DEFAULT NULL,
  `PESEL` varchar(11) DEFAULT NULL,
  `NIP` varchar(10) DEFAULT NULL,
  `nr_rachunku` varchar(26) DEFAULT NULL,
  `logowanie` tinyint(1) NOT NULL DEFAULT '0',
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id_users_dane`),
  UNIQUE KEY `NIP_UNIQUE` (`NIP`),
  KEY `fk_users_dane_users` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

INSERT INTO `users_dane` (`id_users_dane`, `ulica`, `nr_dom`, `nr_lokal`, `miasto`, `kod`, `nr_telefonu`, `PESEL`, `NIP`, `nr_rachunku`, `logowanie`, `id_users`) VALUES
(52, 'Wolciechowska', '4', '14', 'Lublin', '20-950', '', '45032403355', '7121023156', NULL, 0, 74),
(53, 'Topolowa', '3', '', 'Lublin', '20-950', '', '52050809290', '7121269638', NULL, 0, 75),
(54, 'Potok', '214', '', 'Sosnowiec', '42-001', '', NULL, NULL, '10202139876543213443225674', 0, 76),
(55, 'Jerozolimskie', '123', '', 'Warszawa', '00-950', '', NULL, NULL, '30124088123456888888123456', 0, 77),
(56, 'Furmańska', '15', '7', 'Lublin', '20-950', '', NULL, NULL, '53102021398765432134432256', 0, 78),
(57, 'Walecznych', '4', '6', 'Lublin', '20-950', '', NULL, NULL, '10124088123456888888123456', 0, 79),
(58, 'Senatorska', '23', '', 'Warszawa', '00-950', '', NULL, NULL, '22222222222222222222222221', 0, 80),
(59, 'Smoluchowskiego', '23', '', 'Lublin', '20-950', '', '', '7121262238', NULL, 0, 81),
(60, 'Narutowicza', '56', '', 'Lublin', '20-016', '', NULL, NULL, '10203400000001234555486321', 0, 82),
(61, 'Poturzyckiego', '23', '', 'Wrocław', '40-987', '', NULL, NULL, '65102065980000000812328787', 0, 83),
(62, 'Nowowiejska', '54', '', 'Sulęcin', '00-900', '', NULL, '7121242321', '65222222222222200000008765', 0, 84),
(63, 'Kolo', '3', '', 'Lomza', '20-950', '', '', '5908321093', NULL, 0, 85),
(64, 'sienko', '2', '', 'Lublin', '', '', NULL, NULL, '65102011111111111111111111', 0, 86),
(65, 'Chopina', '1', '', 'Lublin', '20-950', '', NULL, '7123457654', '92102038229876543210987654', 0, 87),
(66, 'neo', '1', '', 'koluszki', '00-000', '118912341', '', '7123452999', '10205555555555555555551234', 0, 88),
(67, 'Bursaki', '99', '1', 'Tczewo', '00-900', '558912341', '', '2341255888', '10205555555555555555559999', 0, 89),
(68, 'Chopina f', '123a', '', 'Wawa', '20-608', '404232133', '', '2341251234', '10205555555555555555551234', 0, 90),
(69, 'Rodeo drivee', '2w', '6e', 'Bychawa', '21-950', '404232214', '45032403888', '', NULL, 0, 91),
(70, 'Naruto', '56', '', 'Lublin', '20-016', '', '', '7121232736', '32123412345678901234567890', 0, 92),
(71, 'Zimowa', '1', '', 'Lublin', '20-950', '', '', '7121242543', '10209876543215432198765987', 0, 93);

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

INSERT INTO `users_login` (`id_users_login`, `login`, `password`, `aktywny`, `id_users`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'admin@windykacja.com'),
(9, 'operator', '4b583376b2767b923c3e1da60d10de59', 1, 11, 'oper@windykacja.com');

DROP TABLE IF EXISTS `users_typy`;
CREATE TABLE `users_typy` (
  `id_users_typy` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) NOT NULL,
  PRIMARY KEY (`id_users_typy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `users_typy` (`id_users_typy`, `nazwa`) VALUES
(1, 'administrator'),
(2, 'operator'),
(3, 'wierzyciel'),
(4, 'dłużnik zajętej wierzytelności'),
(5, 'dłużnik'),
(6, 'komornik');

DROP TABLE IF EXISTS `wierzyciel`;
CREATE TABLE `wierzyciel` (
  `id_wierzycieli` int(11) NOT NULL AUTO_INCREMENT,
  `id_wierzyciel_typ` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_wierzycieli`),
  KEY `fk_wierzyciel_wierzyciel_typ` (`id_wierzyciel_typ`),
  KEY `fk_wierzyciel_users` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

INSERT INTO `wierzyciel` (`id_wierzycieli`, `id_wierzyciel_typ`, `id_user`) VALUES
(27, 4, 76),
(28, 4, 77),
(29, 3, 78),
(30, 3, 79),
(31, 4, 80),
(32, 3, 82),
(33, 4, 83),
(34, 3, 84),
(35, 4, 86),
(36, 3, 87),
(37, 4, 89),
(38, 4, 90),
(39, 3, 92),
(40, 4, 93);

DROP TABLE IF EXISTS `wierzyciele_sprawy`;
CREATE TABLE `wierzyciele_sprawy` (
  `id_wierzyciele_sprawy` int(11) NOT NULL AUTO_INCREMENT,
  `id_sprawy` int(11) NOT NULL,
  `id_wierzyciela` int(11) NOT NULL,
  `KM` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_wierzyciele_sprawy`),
  KEY `fk_wierzyciele_sprawy_sprawy` (`id_sprawy`),
  KEY `fk_wierzyciele_sprawy_wierzyciel` (`id_wierzyciela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

INSERT INTO `wierzyciele_sprawy` (`id_wierzyciele_sprawy`, `id_sprawy`, `id_wierzyciela`, `KM`) VALUES
(12, 15, 27, '342/09'),
(13, 15, 28, '876/07'),
(14, 16, 29, '342/11'),
(15, 16, 30, '34/00'),
(16, 16, 31, '769/12'),
(17, 17, 32, ''),
(18, 17, 33, ''),
(19, 17, 34, ''),
(20, 18, 35, '34/12'),
(21, 18, 36, '654/12'),
(22, 18, 39, '458/09'),
(23, 18, 40, '');

DROP TABLE IF EXISTS `wierzyciel_typ`;
CREATE TABLE `wierzyciel_typ` (
  `id_wierzyciel_typ` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(45) NOT NULL,
  `priorytet` varchar(45) NOT NULL,
  PRIMARY KEY (`id_wierzyciel_typ`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `wierzyciel_typ` (`id_wierzyciel_typ`, `nazwa`, `priorytet`) VALUES
(1, 'alimentacyjny', '1'),
(2, 'pracowniczy', '2'),
(3, 'podatkowy', '3'),
(4, 'cywilny', '4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `wnioski` (`id_wniosku`, `id_operatora`, `id_wnioskodawcy`, `id_sprawy`, `data_wplywu`, `data_odpowiedzi`, `opis_wniosku`) VALUES
(1, 11, 78, 16, '2013-07-09', NULL, 'Stan postępowania'),
(2, 11, 82, 17, '2013-08-11', NULL, 'stan'),
(3, 11, 77, 16, '2013-08-01', NULL, 'stan'),
(4, 11, 89, 16, '2013-10-01', '2013-10-10', 'stan');

DROP TABLE IF EXISTS `wplaty`;
CREATE TABLE `wplaty` (
  `id_wplaty` int(11) NOT NULL AUTO_INCREMENT,
  `kwota_wplaty` decimal(10,2) NOT NULL,
  `data_wplaty` date NOT NULL,
  `id_dluznika` int(11) NOT NULL,
  PRIMARY KEY (`id_wplaty`),
  KEY `fk_wplaty_sprawy` (`id_dluznika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

INSERT INTO `wplaty` (`id_wplaty`, `kwota_wplaty`, `data_wplaty`, `id_dluznika`) VALUES
(42, '70.63', '2013-09-03', 75),
(43, '100.00', '2013-10-07', 85);

DROP TABLE IF EXISTS `wplaty_dla_wierzycieli`;
CREATE TABLE `wplaty_dla_wierzycieli` (
  `id_wplaty_dla_wierzycieli` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `id_wierzyciela` int(11) NOT NULL,
  `kwota_zadluzenia` decimal(10,2) NOT NULL,
  `odsetki` decimal(10,2) NOT NULL,
  `koszty_egzekucyjne` varchar(45) NOT NULL,
  PRIMARY KEY (`id_wplaty_dla_wierzycieli`),
  KEY `fk_wplaty_dla_wierzycieli_wplaty` (`id_wplaty`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

INSERT INTO `wplaty_dla_wierzycieli` (`id_wplaty_dla_wierzycieli`, `id_wplaty`, `id_wierzyciela`, `kwota_zadluzenia`, `odsetki`, `koszty_egzekucyjne`) VALUES
(43, 42, 36, '0.00', '0.00', '0'),
(44, 43, 36, '0.00', '0.00', '0');

DROP TABLE IF EXISTS `zadluzenie`;
CREATE TABLE `zadluzenie` (
  `id_zadluzenia` int(11) NOT NULL AUTO_INCREMENT,
  `id_wierzyciele_sprawy` int(11) NOT NULL,
  `data` date NOT NULL,
  `kwota_zadluzenia` decimal(10,2) NOT NULL,
  `odsetki` decimal(10,2) NOT NULL,
  `koszty_egzekucyjne` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_zadluzenia`),
  KEY `fk_zadluzenie_wierzyciele_sprawy` (`id_wierzyciele_sprawy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

INSERT INTO `zadluzenie` (`id_zadluzenia`, `id_wierzyciele_sprawy`, `data`, `kwota_zadluzenia`, `odsetki`, `koszty_egzekucyjne`) VALUES
(4, 14, '2011-09-20', '5671.00', '742.31', '0.00'),
(5, 15, '2012-06-18', '9234.00', '2103.81', '0.00'),
(6, 16, '2013-06-18', '10210.00', '4300.00', '0.00'),
(7, 17, '2011-08-16', '3276.18', '0.00', '0.00'),
(8, 18, '2011-09-20', '4399.00', '6471.44', '98.00'),
(9, 17, '2012-08-09', '1058.83', '0.00', '0.00'),
(11, 12, '2010-09-17', '2000.00', '804.00', '0.00'),
(12, 21, '2011-09-15', '2673.18', '604.82', '0.00'),
(13, 20, '2011-09-15', '2804.46', '3873.30', '1.00'),
(14, 12, '2013-10-08', '1800.00', '300.00', '1.00'),
(15, 13, '2013-10-09', '700.00', '456.00', '0.00'),
(16, 13, '2013-08-14', '600.00', '50.00', '0.00');

DROP TABLE IF EXISTS `zajecia`;
CREATE TABLE `zajecia` (
  `idZajęcia` int(11) NOT NULL,
  `id_sprawy` int(11) NOT NULL,
  `id_dluz_wierzyt` int(11) NOT NULL,
  PRIMARY KEY (`idZajęcia`),
  KEY `fk_zajecia_sprawy` (`id_sprawy`),
  KEY `fk_zajecia_users` (`id_dluz_wierzyt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `zwroty`;
CREATE TABLE `zwroty` (
  `id_zwrotu` int(11) NOT NULL AUTO_INCREMENT,
  `id_wplaty` int(11) NOT NULL,
  `kwota_zwrotu` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id_zwrotu`),
  KEY `zwroty_wplaty_fk` (`id_wplaty`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

INSERT INTO `zwroty` (`id_zwrotu`, `id_wplaty`, `kwota_zwrotu`) VALUES
(40, 42, '67.10'),
(41, 43, '95.00');


ALTER TABLE `oplaty_komornicze`
  ADD CONSTRAINT `oplaty_komornicze_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`);

ALTER TABLE `sprawy`
  ADD CONSTRAINT `sprawy_ibfk_1` FOREIGN KEY (`id_dluznika`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_users_typy`) REFERENCES `users_typy` (`id_users_typy`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users_dane`
  ADD CONSTRAINT `users_dane_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wierzyciel`
  ADD CONSTRAINT `wierzyciel_ibfk_1` FOREIGN KEY (`id_wierzyciel_typ`) REFERENCES `wierzyciel_typ` (`id_wierzyciel_typ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wierzyciel_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wierzyciele_sprawy`
  ADD CONSTRAINT `wierzyciele_sprawy_ibfk_1` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wierzyciele_sprawy_ibfk_2` FOREIGN KEY (`id_wierzyciela`) REFERENCES `wierzyciel` (`id_wierzycieli`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wnioski`
  ADD CONSTRAINT `wnioski_ibfk_10` FOREIGN KEY (`id_operatora`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wnioski_ibfk_11` FOREIGN KEY (`id_wnioskodawcy`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wnioski_ibfk_5` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wplaty`
  ADD CONSTRAINT `wplaty_ibfk_1` FOREIGN KEY (`id_dluznika`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `wplaty_dla_wierzycieli`
  ADD CONSTRAINT `wplaty_dla_wierzycieli_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `zadluzenie`
  ADD CONSTRAINT `zadluzenie_ibfk_1` FOREIGN KEY (`id_wierzyciele_sprawy`) REFERENCES `wierzyciele_sprawy` (`id_wierzyciele_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `zajecia`
  ADD CONSTRAINT `zajecia_ibfk_1` FOREIGN KEY (`id_sprawy`) REFERENCES `sprawy` (`id_sprawy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zajecia_ibfk_2` FOREIGN KEY (`id_dluz_wierzyt`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `zwroty`
  ADD CONSTRAINT `zwroty_ibfk_1` FOREIGN KEY (`id_wplaty`) REFERENCES `wplaty` (`id_wplaty`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
