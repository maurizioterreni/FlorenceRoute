-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 15, 2014 alle 10:39
-- Versione del server: 5.5.37-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `florenceroutes`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Monument`
--

CREATE TABLE IF NOT EXISTS `Monument` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL,
  `ID_Fs` varchar(100) NOT NULL,
  `Lat` varchar(200) NOT NULL,
  `Lon` varchar(200) NOT NULL,
  `Text` varchar(5000) NOT NULL,
  `Url_Img` varchar(300) NOT NULL,
  `Apertura` varchar(50) NOT NULL,
  `Prezzo` varchar(20) NOT NULL,
  `Web_site` varchar(200) NOT NULL,
  `Tel` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dump dei dati per la tabella `Monument`
--

INSERT INTO `Monument` (`ID`, `Nome`, `ID_Fs`, `Lat`, `Lon`, `Text`, `Url_Img`, `Apertura`, `Prezzo`, `Web_site`, `Tel`) VALUES
(1, 'Cattedrale di Santa Maria del Fiore', '4bd00cdb046076b00a576f71', '43.773139094429', '11.255643367767', 'The cathedral of Florence is built as a basilica, having a wide central nave of four square bays, with an aisle on either side. The chancel and transepts are of identical polygonal plan, separated by two smaller polygonal chapels. The whole plan forms a Latin cross. The nave and aisles are separated by wide pointed Gothic arches resting on composite piers.\r\n\r\nThe dimensions of the building are enormous: length 153 metres (502 ft), width 38 metres (124 ft), width at the crossing 90 metres (295 ft). The height of the arches in the aisles is 23 metres (75 ft). The height of the dome is 114.5 m', 'img/smdf/', '10:00 - 17:00', '10&euro;', 'http://www.museumflorence.com/en/', '+39 055 230 2885'),
(2, 'Galleria degli Uffizi', '51191cdfb0ed67c8fff5610b', '43.769985930354', '11.255310773849', 'This is one of the most famous museums of paintings and sculpture in the world. Its collection of Primitive and Renaissance paintings comprises several universally acclaimed masterpieces of all time, including works by Giotto, Simone Martini, Piero della Francesca, Fra Angelico, Filippo Lippi,', 'img/gdu/', '8:15 - 18:50 ', '6,50&euro;', 'http://www.polomuseale.firenze.it/en/musei/index.php?m=uffizi', '+39 055 238 8651'),
(3, 'Piazzale Michelangelo', '4b3276d5f964a520620c25e3', '43.762765', '11.264988', 'Piazzale Michelangelo (Michelangelo Square) is a famous square with a magnificent panoramic view of Florence, Italy, and is a popular tourist destination in the Oltrarno district of the city. The famous view from this observation point overlooking the city has been reproduced on countless postcards and snapshots over the years.', 'img/pm/', '0:00 - 24:00', '0&euro;', '', ''),
(4, 'Giardino di Boboli', '4bc97abcfb84c9b6f62e1b3e', '43.762649', '11.249496 ', 'The Boboli Gardens is a park in Florence, Italy, that is home to a collection of sculptures dating from the 16th through the 18th centuries, with some Roman antiquities.', 'img/gdb/', '8:15 - 16:30', '10&euro;', 'https://www.polomuseale.firenze.it/en/musei/index.php?m=boboli', '+39 055 294 883'),
(5, 'Ponte Vecchio', '4b6ed35df964a52038cc2ce3', '43.76799', '11.25317', 'The bridge spans the Arno at its narrowest point[3] where it is believed that a bridge was first built in Roman times,[4] when the via Cassia crossed the river at this point.[3] The Roman piers were of stone, the superstructure of wood. The bridge first appears in a document of 996.[3] After being destroyed by a flood in 1117 it was reconstructed in stone but swept away again in 1333[4] save two of its central piers, as noted by Giovanni Villani in his Nuova Cronica.[5] It was rebuilt in 1345,[6', 'img/pv/', '0:00 - 24:00', '', '', ''),
(6, 'Basilica di Santa Maria Novella', '', '43.7742271', '11.2493334', ' The Basilica of Santa Maria Novella is one of the most important churches of Florence and stands in the homonymous  square.', 'img/bsmn/', '9:00-17:00', '', '', ''),
(7, 'Basilica di Santo Spirito', '', '43.7671013', '11.2481117', 'The church of Santo Spirito is one of the main churches of the city of Florence. It is located in the Oltrarno district, the southern part of the historic center, with its simple facade overlooking the main square.', 'img/bss/', '9:00-18:00', '', '', ''),
(8, 'Palazzo Vecchio', '', '43.7695007', '11.2560024', 'Originally called "Palazzo dei Priori" or "Novo palace" became in the fifteenth century "Palazzo della Signoria", in 1540 it became the Palazzo Ducale and finally "Palazzo Vecchio".', 'img/palv/', '9:00-19:00', '', '', ''),
(9, 'Basilica di San Lorenzo', '', '43.7749481', '11.2534494', 'The Basilica of San Lorenzo is one of the main Catholic places of worship of Florence, located in the square in the historic center of the city, whose side is held on the characteristic San Lorenzo market. Has the rank of a minor basilica.', 'img/bsp/', '13:00-18:00', '', '', ''),
(10, 'Casa Buonarroti', '', '43.7698441', '11.2635994', 'The building was a property owned by the sculptor Michelangelo. The house was converted into a museum dedicated to the artist, Michelangelo Buonarroti.', 'img/cbr/', '10:00-17:00', '', '', ''),
(32, 'Palazzo Medici Riccardi', '', '43.7750130', '11.2557917', 'Palazzo Medici Riccardi in Florence is situated in what was called for its breadth Via Larga, now Via Cavour, at number 3 and is the current seat of the Provincial Council.', '', '9:00-18:00', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
