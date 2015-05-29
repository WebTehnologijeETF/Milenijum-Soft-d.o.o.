-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 127.13.49.130:3306
-- Generation Time: May 29, 2015 at 02:00 AM
-- Server version: 5.5.41
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `milenijumsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admini`
--

CREATE TABLE IF NOT EXISTS `admini` (
  `idAdmina` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `alias` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`idAdmina`),
  UNIQUE KEY `Username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`idAdmina`, `username`, `password`, `mail`, `alias`) VALUES
(2, 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'fljuca1@etf.unsa.ba', 'Neki alias');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `idKomentari` int(11) NOT NULL AUTO_INCREMENT,
  `idNovosti` int(11) NOT NULL,
  `autor` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `mail` varchar(40) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `vrijemeObjave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idKomentari`),
  KEY `IndexIdNovosti` (`idNovosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=95 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`idKomentari`, `idNovosti`, `autor`, `mail`, `tekst`, `vrijemeObjave`) VALUES
(92, 19, 'Faruk', 'fljuca1@etf.unsa.ba', 'Ovaj jelen je preljep.', '2015-05-28 16:49:38'),
(93, 20, 'Baha', 'sferizovic1@etf.unsa.ba', 'Ova stranica je super', '2015-05-28 20:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `idNovosti` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` text COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `detaljnijiTekst` text COLLATE utf8_slovenian_ci,
  `autor` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `datumObjave` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slika` text COLLATE utf8_slovenian_ci,
  PRIMARY KEY (`idNovosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`idNovosti`, `naslov`, `tekst`, `detaljnijiTekst`, `autor`, `datumObjave`, `slika`) VALUES
(19, 'Lov na jelene je počeo', 'U subout ujutro je počeo lov na sve jelene u Jelenskoj visoravni.', 'Trajaće do daljnjeg. Informacije možete dobiti na broj 061/111-111', 'Fare', '2015-05-28 16:47:51', 'http://media1.santabanta.com/full1/Animals/Deers/deers-3a.jpg'),
(20, 'Samo naslovna vijest', 'Naravno ima i trkst, ali nema ni&scaron;ta ostalo.', NULL, 'Fare', '2015-05-28 16:48:31', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `StraniKljucIdNovosti` FOREIGN KEY (`idNovosti`) REFERENCES `novosti` (`idNovosti`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
