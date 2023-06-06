-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2023 at 05:56 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susg_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

DROP TABLE IF EXISTS `committees`;
CREATE TABLE IF NOT EXISTS `committees` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `comm` varchar(100) NOT NULL,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `comm`, `internal_number`, `description`, `amount`) VALUES
(1, 'advocacy', 'REI2020-1-002', 'Advocacy Building Camp', '1825.00'),
(2, 'advocacy', 'CA2020-2-003', 'Halwat 2021\r\n', '200.00'),
(3, 'advocacy', 'PC2020-2-1', 'Juan, Makisagwan!', '500.00'),
(4, 'advocacy', 'CA2020-1-001', 'Hello 2022', '100.00'),
(5, 'cheering', 'CA2020-1-005', 'TeaCHEERS Day\r\n', '1891.50'),
(6, 'cheering', 'CA2020-1-001', 'TeaCHEERS Dayssss\r\n', '200.00'),
(7, 'comso', 'REQ2020-1-001', 'Automatic Appropriations\r\n', '20000.00'),
(8, 'dorm life', 'CA2020-1-004', 'Kaagapay: Coping with the New Normal\r\n', '2345.75'),
(9, 'dorm life', 'CA2020-1-005', '#IntheMaking: Before your Life the Cap\r\n', '849.00'),
(10, 'dorm life', 'CA2020-1-005', 'Spooky Nights\r\n', '700.00'),
(11, 'dorm life', 'CA2020-1-006', 'Clean and Green Revolution 1\r\n', '3141.35'),
(12, 'dorm life', 'CA2020-1-009', '#IntheMaking: The In-Betweens\r\n', '1616.85'),
(13, 'dorm life', 'CA2020-1-009', 'Take Cover\r\n', '5000.00'),
(14, 'dorm life', 'CA2020-2-002', '#IntheMaking: Penny Pincher\r\n', '1650.00'),
(15, 'dorm life', 'CA2020-2-002', 'Clean and Green Revolution 2\r\n', '4290.00'),
(16, 'dorm life', 'CA2020-2-007', '#IntheMaking: Walk your Path\r\n', '2200.00'),
(17, 'dorm life', 'CA2020-2-007', 'Project Space Impact Cash Sponsorship\r\n', '2000.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
