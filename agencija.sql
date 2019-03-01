-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2019 at 04:34 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agencija`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivnosti`
--

DROP TABLE IF EXISTS `aktivnosti`;
CREATE TABLE IF NOT EXISTS `aktivnosti` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_korisnika` int(200) NOT NULL,
  `korisnik` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `naziv_aktivnosti` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vrijeme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aktivnosti`
--

INSERT INTO `aktivnosti` (`id`, `id_korisnika`, `korisnik`, `naziv_aktivnosti`, `datum`, `vrijeme`) VALUES
(20, 1, 'bakir', 'Odjava', '20/02/2019', '02:53:38pm'),
(21, 1, 'bakir', 'Prijava', '20/02/2019', '03:01:09pm'),
(22, 1, 'bakir', 'Odjava', '20/02/2019', '04:55:13pm'),
(23, 6, 'keno', 'Prijava', '20/02/2019', '10:57:24pm'),
(24, 6, 'keno', 'Prijava', '20/02/2019', '10:57:47pm'),
(25, 1, 'bakir', 'Prijava', '20/02/2019', '10:57:59pm'),
(26, 1, 'bakir', 'Prijava', '21/02/2019', '08:59:29am'),
(27, 2, 'admin', 'Prijava', '21/02/2019', '12:57:16pm'),
(28, 2, 'admin', 'Dodana destinacija', '21/02/2019', '12:58:56pm'),
(29, 2, 'admin', 'Odjava', '21/02/2019', '01:02:05pm'),
(30, 1, 'bakir', 'Prijava', '21/02/2019', '01:10:43pm'),
(31, 1, 'bakir', 'Odjava', '21/02/2019', '01:11:21pm'),
(32, 1, 'bakir', 'Prijava', '21/02/2019', '01:12:35pm'),
(33, 1, 'bakir', 'Odjava', '21/02/2019', '01:12:43pm'),
(34, 1, 'bakir', 'Prijava', '21/02/2019', '01:12:51pm'),
(35, 6, 'keno', 'Prijava', '21/02/2019', '04:22:48pm'),
(36, 6, 'keno', 'Rezervacija od korisnika 6', '21/02/2019', '04:31:12pm'),
(37, 1, 'bakir', 'Prijava', '21/02/2019', '04:53:33pm'),
(38, 1, 'bakir', 'Prijava', '21/02/2019', '04:54:20pm'),
(39, 1, 'bakir', 'Odjava', '21/02/2019', '04:54:31pm'),
(40, 1, 'bakir', 'Prijava', '21/02/2019', '07:36:56pm'),
(41, 1, 'bakir', 'Odjava', '21/02/2019', '08:17:31pm'),
(42, 1, 'bakir', 'Prijava', '21/02/2019', '08:18:11pm'),
(43, 1, 'bakir', 'Prijava', '21/02/2019', '09:52:49pm');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id_bloga` int(200) NOT NULL AUTO_INCREMENT,
  `id_korisnika` int(200) NOT NULL,
  `ime_korisnika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `naziv_bloga` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `kratki_opis` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text_bloga` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `datum_postavljanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vrijeme_postavljanja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_bloga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_bloga`, `id_korisnika`, `ime_korisnika`, `naziv_bloga`, `kratki_opis`, `text_bloga`, `datum_postavljanja`, `vrijeme_postavljanja`, `slika`) VALUES
(1, 1, 'bakir', 'Putovanje u Kinu', 'Opis putovanja.', 'Opis putovanja u kinu, Opis putovanja u kinu , Opis putovanja u kinu', '18/02/2019', '02:01:45pm', 'china.jpg'),
(2, 1, 'bakir', 'Putovanje u Jerusalem', 'Opis putovanja.', 'Opis putovanja u kinu, Opis putovanja u kinu , Opis putovanja u kinu', '18/02/2019', '02:02:38pm', 'jerusalem.jpg'),
(3, 1, 'bakir', 'Jos jedan blog', 'asa', 'Ovo je jejos jedan blog. Ovo je jejos jedan blog. Ovo je jejos jedan blog. Ovo je jejos jedan blog.Ovo je jejos jedan blog. Ovo je jejos jedan blog.Ovo je jejos jedan blog. Ovo je jejos jedan blog.', '20/02/2019', '01:56:10pm', 'baner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dani`
--

DROP TABLE IF EXISTS `dani`;
CREATE TABLE IF NOT EXISTS `dani` (
  `id_dana` int(100) NOT NULL AUTO_INCREMENT,
  `id_destinacije` int(100) NOT NULL,
  `broj_dana` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `opis_dana` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_dana`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dani`
--

INSERT INTO `dani` (`id_dana`, `id_destinacije`, `broj_dana`, `opis_dana`) VALUES
(1, 3, '1. dan', 'Polazak sa odredista.'),
(2, 3, '2. dan', 'dolazak na odrediste.');

-- --------------------------------------------------------

--
-- Table structure for table `destinacije`
--

DROP TABLE IF EXISTS `destinacije`;
CREATE TABLE IF NOT EXISTS `destinacije` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `naziv_destinacije` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `brojDanaPansiona` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cijena_destinacije` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datum_destinacije` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `let_destinacije` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Opis` varchar(200) CHARACTER SET ucs2 COLLATE ucs2_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `destinacije`
--

INSERT INTO `destinacije` (`id`, `naziv_destinacije`, `brojDanaPansiona`, `cijena_destinacije`, `datum_destinacije`, `let_destinacije`, `slika`, `Opis`) VALUES
(1, 'Budva', '7', '1000', '09.02.2019', 'Tuzla', 'budva.jpg', 'Neki opis destinacije!'),
(2, 'China', '5', '1000', '09.03.2019', 'Zenica', 'china.jpg', 'Neki opis destinacije!'),
(3, 'Maldivi', '2', '450', '02.12.2019', 'Sarajevo', 'maldivi.jpg', 'Opis destinacije'),
(4, 'Jerusalem', '5', '1500', '03.03.2019', 'Bihac', 'jerusalem.jpg', 'Jerusalem je najveÄ‡i grad na podruÄju Izraela.');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id_komentara` int(100) NOT NULL AUTO_INCREMENT,
  `id_bloga` int(100) NOT NULL,
  `id_korisnika` int(100) NOT NULL,
  `naziv_korisnika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `komentar` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vrijeme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_komentara`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id_komentara`, `id_bloga`, `id_korisnika`, `naziv_korisnika`, `komentar`, `datum`, `vrijeme`) VALUES
(1, 2, 1, 'bakir', 'Probni komentar!', '18/02/2019', '02:08:05pm'),
(2, 3, 1, 'bakir', 'Zanimljivo !!!!!', '20/02/2019', '01:57:42pm');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `id_korisnika` int(100) NOT NULL AUTO_INCREMENT,
  `ime` text COLLATE utf8_unicode_ci NOT NULL,
  `prezime` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `korisnicko_ime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'administrator',
  PRIMARY KEY (`id_korisnika`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `ime`, `prezime`, `email`, `korisnicko_ime`, `sifra`, `tip`) VALUES
(1, 'Bakir', 'Malkoc', 'bakir.malkoc@gmail.com', 'bakir', '123', 'GlavniAdministrator'),
(2, 'Admin', 'Admin', 'admin@gmail.com', 'admin', 'admin', 'administrator'),
(3, 'Emir ', 'Sulic', 'emir@gmail.com', 'emir', '123', 'administrator'),
(6, 'Kenan', 'Malkoc', 'kenan.malkoc@gmail.com', 'keno', '123', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

DROP TABLE IF EXISTS `rezervacije`;
CREATE TABLE IF NOT EXISTS `rezervacije` (
  `id_rezervacije` int(100) NOT NULL AUTO_INCREMENT,
  `id_destinacije` int(100) NOT NULL,
  `id_korisnika` int(100) NOT NULL,
  `broj_putnika` int(25) NOT NULL,
  `pitanja` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Na cekanju',
  PRIMARY KEY (`id_rezervacije`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id_rezervacije`, `id_destinacije`, `id_korisnika`, `broj_putnika`, `pitanja`, `status`) VALUES
(1, 4, 6, 6, 's', 'Potvrdjena'),
(2, 1, 2, 3, 'nema pitanja', 'Ponistena');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
