-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2023 at 06:07 AM
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
-- Database: `susg_2020-2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_advances`
--

DROP TABLE IF EXISTS `cash_advances`;
CREATE TABLE IF NOT EXISTS `cash_advances` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `date_of_sa` date NOT NULL,
  `ca_amount` decimal(11,2) NOT NULL,
  `ca_status` tinyint(4) NOT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advances`
--

INSERT INTO `cash_advances` (`id`, `internal_number`, `date_of_sa`, `ca_amount`, `ca_status`, `notes`) VALUES
(11, 'CA2020-1-001', '2020-08-18', '2000.00', 8, NULL),
(12, 'CA2020-1-002', '2020-08-18', '50000.00', 8, NULL),
(13, 'CA2020-1-003', '2020-08-18', '80000.00', 8, NULL),
(14, 'CA2020-1-004', '2020-09-04', '36640.00', 8, NULL),
(15, 'CA2020-1-005', '2020-09-22', '7980.00', 8, NULL),
(16, 'CA2020-1-006', '2020-10-19', '4158.00', 8, NULL),
(17, 'CA2020-1-007', '2020-10-19', '85000.00', 8, NULL),
(18, 'CA2020-1-008', '2020-10-26', '2250.00', 8, NULL),
(19, 'CA2020-1-009', '2020-11-09', '9074.00', 8, NULL),
(20, 'CA2020-1-010', '2020-11-17', '200000.00', 8, NULL),
(21, 'CA2020-1-011', '2020-11-17', '15000.00', 8, NULL),
(22, 'CA2020-2-001', '2021-01-25', '16362.00', 8, NULL),
(23, 'CA2020-2-002', '2021-02-08', '7865.00', 8, NULL),
(24, 'CA2020-2-003', '2021-02-22', '2470.00', 8, NULL),
(25, 'CA2020-2-004', '2021-03-08', '10890.00', 8, NULL),
(26, 'CA2020-2-005', '2021-03-22', '47883.00', 8, NULL),
(27, 'CA2020-2-006', '2021-04-19', '125000.00', 8, NULL),
(28, 'CA2020-2-007', '2021-04-19', '4200.00', 8, NULL),
(29, 'CA2020-2-008', '2021-04-19', '3000.00', 8, NULL),
(30, 'CA2020-2-009', '2021-05-03', '36675.00', 8, NULL),
(31, 'CA2020-2-010', '2021-05-28', '27000.00', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_generated`
--

DROP TABLE IF EXISTS `cash_generated`;
CREATE TABLE IF NOT EXISTS `cash_generated` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `date_received_by_finance` date NOT NULL,
  `execomm` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `amount_received` decimal(11,2) NOT NULL,
  `deposited_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_generated`
--

INSERT INTO `cash_generated` (`id`, `internal_number`, `date_received_by_finance`, `execomm`, `description`, `amount_received`, `deposited_amount`, `notes`) VALUES
(1, 'CG2020-1-001', '2020-08-29', '15 Execomms', '11 Days of Sharing', '93119.07', '0.00', 'used for 11 Days of Sharing'),
(2, 'CG2020-1-002', '2020-08-30', 'Special Projects', 'Horrace VII: Game Over', '400.00', '400.00', 'deposited to SG Account'),
(3, 'CG2020-1-003', '2020-12-05', 'TSI', 'TSI: Ulysses', '152205.65', '0.00', 'directly deposited to Kapit Pinas account'),
(4, 'CG2020-1-004', '2021-01-12', 'TSI', 'TSI: Negros Occidental', '1974.00', '0.00', 'directly deposited to NYLI account'),
(5, 'CG2020-2-001', '2021-07-30', 'Comelec', 'SUSG Virtual Halalan', '2500.00', '2500.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `com_advocacy`
--

DROP TABLE IF EXISTS `com_advocacy`;
CREATE TABLE IF NOT EXISTS `com_advocacy` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_advocacy`
--

INSERT INTO `com_advocacy` (`id`, `internal_number`, `description`, `amount`) VALUES
(3, 'REI2020-1-002', 'Advocacy Building Camp\r\n', '1825.00'),
(4, 'CA2020-2-003', 'Halwat 2021\r\n', '200.00'),
(5, 'PC2020-2-1', 'Juan, Makisagwan!\r\n', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_cheering`
--

DROP TABLE IF EXISTS `com_cheering`;
CREATE TABLE IF NOT EXISTS `com_cheering` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_cheering`
--

INSERT INTO `com_cheering` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2020-1-005', 'TeaCHEERS Day\r\n', '1891.50');

-- --------------------------------------------------------

--
-- Table structure for table `com_comso`
--

DROP TABLE IF EXISTS `com_comso`;
CREATE TABLE IF NOT EXISTS `com_comso` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_comso`
--

INSERT INTO `com_comso` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'REQ2020-1-001', 'Automatic Appropriations\r\n', '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_dorm_life`
--

DROP TABLE IF EXISTS `com_dorm_life`;
CREATE TABLE IF NOT EXISTS `com_dorm_life` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_dorm_life`
--

INSERT INTO `com_dorm_life` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2020-1-004', 'Kaagapay: Coping with the New Normal\r\n', '2345.75'),
(2, 'CA2020-1-005', '#IntheMaking: Before you Life the Cap\r\n', '849.00'),
(3, 'CA2020-1-005', 'Spooky Nights\r\n', '700.00'),
(4, 'CA2020-1-006', 'Clean and Green Revolution 1\r\n', '3141.35'),
(5, 'CA2020-1-009', '#IntheMaking: The In-Betweens\r\n', '1616.85'),
(6, 'CA2020-1-009', 'Take Cover\r\n', '5000.00'),
(7, 'CA2020-2-002', '#IntheMaking: Penny Pincher\r\n', '1650.00'),
(8, '1650.00', 'Clean and Green Revolution 2\r\n', '4290.00'),
(9, 'CA2020-2-007', '#IntheMaking: Walk your Path\r\n', '2200.00'),
(10, 'CA2020-2-007', 'Project Space Impact Cash Sponsorship\r\n', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_educational_services`
--

DROP TABLE IF EXISTS `com_educational_services`;
CREATE TABLE IF NOT EXISTS `com_educational_services` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_educational_services`
--

INSERT INTO `com_educational_services` (`id`, `internal_number`, `description`, `amount`) VALUES
(4, 'REQ2020-1-002', 'SUSG Scholarship Fund\r\n', '120000.00'),
(5, 'REQ2020-2-001', 'SUSG Scholarship Fund\r\n', '120000.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_environmental`
--

DROP TABLE IF EXISTS `com_environmental`;
CREATE TABLE IF NOT EXISTS `com_environmental` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_environmental`
--

INSERT INTO `com_environmental` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'CA2020-2-005', 'Project Resikad 2.0\r\n', '15482.50');

-- --------------------------------------------------------

--
-- Table structure for table `com_finance`
--

DROP TABLE IF EXISTS `com_finance`;
CREATE TABLE IF NOT EXISTS `com_finance` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_health`
--

DROP TABLE IF EXISTS `com_health`;
CREATE TABLE IF NOT EXISTS `com_health` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_health`
--

INSERT INTO `com_health` (`id`, `internal_number`, `description`, `amount`) VALUES
(5, 'REI2020-1-001', 'Pasigarbo: Instagram Challenge\r\n', '2077.60'),
(6, 'REI2020-1-001', 'Bloodline Hotline\r\n', '1600.00'),
(7, 'CA2020-2-002', 'RED Project\r\n', '1925.00'),
(8, 'CA2020-2-009', 'Psychological First Aid Webinar\r\n', '1045.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_hert`
--

DROP TABLE IF EXISTS `com_hert`;
CREATE TABLE IF NOT EXISTS `com_hert` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_high_school_affairs`
--

DROP TABLE IF EXISTS `com_high_school_affairs`;
CREATE TABLE IF NOT EXISTS `com_high_school_affairs` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_high_school_affairs`
--

INSERT INTO `com_high_school_affairs` (`id`, `internal_number`, `description`, `amount`) VALUES
(7, 'REI2020-1-002', 'Hibalag Fashion Week\r\n', '1500.00'),
(8, 'REI2020-1-002', 'OPM Song Cover Contest\r\n', '1500.00'),
(9, 'CA2020-2-004', 'Tatak Senior High\r\n', '2640.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_infomedia`
--

DROP TABLE IF EXISTS `com_infomedia`;
CREATE TABLE IF NOT EXISTS `com_infomedia` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_infomedia`
--

INSERT INTO `com_infomedia` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'REI2020-1-002', 'Hibalag Minecraft Booth Festival\r\n', '389.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_marketing`
--

DROP TABLE IF EXISTS `com_marketing`;
CREATE TABLE IF NOT EXISTS `com_marketing` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_miss_silliman`
--

DROP TABLE IF EXISTS `com_miss_silliman`;
CREATE TABLE IF NOT EXISTS `com_miss_silliman` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_research`
--

DROP TABLE IF EXISTS `com_research`;
CREATE TABLE IF NOT EXISTS `com_research` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_research`
--

INSERT INTO `com_research` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2020-1-001', 'LUWAS: A Webinar on Basic First Aid\r\n', '800.00'),
(2, 'CA2020-1-005', 'Wildlife Photography and Photo Editing Webinar\r\n', '1500.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_resolutions`
--

DROP TABLE IF EXISTS `com_resolutions`;
CREATE TABLE IF NOT EXISTS `com_resolutions` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_secretariat`
--

DROP TABLE IF EXISTS `com_secretariat`;
CREATE TABLE IF NOT EXISTS `com_secretariat` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_social_services`
--

DROP TABLE IF EXISTS `com_social_services`;
CREATE TABLE IF NOT EXISTS `com_social_services` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_social_services`
--

INSERT INTO `com_social_services` (`id`, `internal_number`, `description`, `amount`) VALUES
(4, 'REI2020-1-001', 'Kwentong Bayani\r\n', '3000.00'),
(5, 'CA2020-1-003', 'No Student Left Behind 1\r\n', '54880.00'),
(6, 'CA2020-1-007', 'No Student Left Behind 2\r\n', '63324.00'),
(7, 'CA2020-2-006', 'No Student Left Behind 3\r\n', '122093.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_socio_cultural`
--

DROP TABLE IF EXISTS `com_socio_cultural`;
CREATE TABLE IF NOT EXISTS `com_socio_cultural` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_socio_cultural`
--

INSERT INTO `com_socio_cultural` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2020-2-001', 'Paghulagway\r\n', '13000.00'),
(2, 'CA2020-2-009', 'Shutter Up\r\n', '6380.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_special_projects`
--

DROP TABLE IF EXISTS `com_special_projects`;
CREATE TABLE IF NOT EXISTS `com_special_projects` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_special_projects`
--

INSERT INTO `com_special_projects` (`id`, `internal_number`, `description`, `amount`) VALUES
(4, 'REI2020-1-002', 'Campus Virtual Tour\r\n', '700.00'),
(5, 'REI2020-1-002', 'HorRace VII: Game Over\r\n', '900.00'),
(6, 'CA2020-1-009', 'Adulting Basics\r\n', '1854.10'),
(7, 'CA2020-2-001', 'BS Org Start Pack\r\n', '3159.55'),
(8, 'CA2020-2-004', 'Soul Stories\r\n', '7500.00');

-- --------------------------------------------------------

--
-- Table structure for table `com_spiritual_life`
--

DROP TABLE IF EXISTS `com_spiritual_life`;
CREATE TABLE IF NOT EXISTS `com_spiritual_life` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_sports`
--

DROP TABLE IF EXISTS `com_sports`;
CREATE TABLE IF NOT EXISTS `com_sports` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_sports`
--

INSERT INTO `com_sports` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'CA2020-2-005', 'E-tramurals\r\n', '29858.25');

-- --------------------------------------------------------

--
-- Table structure for table `com_straw`
--

DROP TABLE IF EXISTS `com_straw`;
CREATE TABLE IF NOT EXISTS `com_straw` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_straw`
--

INSERT INTO `com_straw` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'REI2020-2-002', '(RYLF) The Queen in You: A Drag Make Up Competition\r\n', '4800.00');

-- --------------------------------------------------------

--
-- Table structure for table `fund_assembly_general`
--

DROP TABLE IF EXISTS `fund_assembly_general`;
CREATE TABLE IF NOT EXISTS `fund_assembly_general` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_assembly_general`
--

INSERT INTO `fund_assembly_general` (`id`, `internal_number`, `description`, `amount`) VALUES
(5, 'CA2020-1-008', 'Zoom Premium Fund\r\n', '1442.78'),
(6, 'CA2020-2-003', 'Zoom Premium Fund\r\n', '2183.58'),
(7, 'CA2020-2-009', 'SUSG Shirts\r\n', '7750.00');

-- --------------------------------------------------------

--
-- Table structure for table `fund_assembly_sponsorship`
--

DROP TABLE IF EXISTS `fund_assembly_sponsorship`;
CREATE TABLE IF NOT EXISTS `fund_assembly_sponsorship` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_assembly_sponsorship`
--

INSERT INTO `fund_assembly_sponsorship` (`id`, `internal_number`, `description`, `amount`) VALUES
(3, 'CA2020-1-011', 'Cash Donation to TSI\r\n', '15000.00'),
(4, 'CA2020-2-008', 'Project Space Impact\r\n', '3000.00');

-- --------------------------------------------------------

--
-- Table structure for table `fund_comelec`
--

DROP TABLE IF EXISTS `fund_comelec`;
CREATE TABLE IF NOT EXISTS `fund_comelec` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_comelec`
--

INSERT INTO `fund_comelec` (`id`, `internal_number`, `description`, `amount`) VALUES
(2, 'REI2020-2-003', 'Virtual Halalan 2021\r\n', '18814.90');

-- --------------------------------------------------------

--
-- Table structure for table `fund_gender_inclusivity`
--

DROP TABLE IF EXISTS `fund_gender_inclusivity`;
CREATE TABLE IF NOT EXISTS `fund_gender_inclusivity` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fund_initial_susg`
--

DROP TABLE IF EXISTS `fund_initial_susg`;
CREATE TABLE IF NOT EXISTS `fund_initial_susg` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_initial_susg`
--

INSERT INTO `fund_initial_susg` (`id`, `date`, `description`, `debit`, `credit`) VALUES
(11, '2020-09-02', 'Registrar\'s enrollee count for 1st sem\r\n', NULL, '382736.64'),
(12, '2020-11-04', 'adjustment to initial actual deposited amount\r\n', NULL, '114115.90'),
(13, '2020-11-04', 'adjustment for SY residency withdrawals\r\n', '7232.04', NULL),
(14, '2021-01-31', 'adjustment for late transfer of funds\r\n', NULL, '13950.76'),
(15, '2021-02-02', 'Registrar\'s enrollee count for 2nd sem\r\n', NULL, '386647.04'),
(16, '2021-04-20', 'adjustment to initial actual deposited amount\r\n', NULL, '99921.56'),
(17, '2021-04-20', 'adjustment for SY residency withdrawals\r\n', '3101.29', NULL),
(18, '2021-05-31', 'adjustment for SY residency withdrawals\r\n', '3291.60', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fund_last_administration`
--

DROP TABLE IF EXISTS `fund_last_administration`;
CREATE TABLE IF NOT EXISTS `fund_last_administration` (
  `last_fund` decimal(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_last_administration`
--

INSERT INTO `fund_last_administration` (`last_fund`) VALUES
('276783.96');

-- --------------------------------------------------------

--
-- Table structure for table `fund_president_discretionary`
--

DROP TABLE IF EXISTS `fund_president_discretionary`;
CREATE TABLE IF NOT EXISTS `fund_president_discretionary` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_president_discretionary`
--

INSERT INTO `fund_president_discretionary` (`id`, `internal_number`, `description`, `amount`) VALUES
(7, 'CA2020-2-009', 'SUSG Shirts\r\n', '12000.00');

-- --------------------------------------------------------

--
-- Table structure for table `fund_vice_president_discretionary`
--

DROP TABLE IF EXISTS `fund_vice_president_discretionary`;
CREATE TABLE IF NOT EXISTS `fund_vice_president_discretionary` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_vice_president_discretionary`
--

INSERT INTO `fund_vice_president_discretionary` (`id`, `internal_number`, `description`, `amount`) VALUES
(5, 'CA2020-2-009', 'SUSG Shirts\r\n', '9500.00');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash`
--

DROP TABLE IF EXISTS `petty_cash`;
CREATE TABLE IF NOT EXISTS `petty_cash` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `date_incurred` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petty_cash`
--

INSERT INTO `petty_cash` (`id`, `internal_number`, `date_incurred`) VALUES
(1, 'PC2020-1-001', '2020-10-26'),
(2, 'PC2020-2-001', '2021-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `reimbursements`
--

DROP TABLE IF EXISTS `reimbursements`;
CREATE TABLE IF NOT EXISTS `reimbursements` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `date_received_by_finance` date NOT NULL,
  `date_reimburse` date DEFAULT NULL,
  `reimbursed_to` varchar(200) DEFAULT NULL,
  `amount_incurred` decimal(11,2) NOT NULL DEFAULT '0.00',
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reimbursements`
--

INSERT INTO `reimbursements` (`id`, `internal_number`, `date_received_by_finance`, `date_reimburse`, `reimbursed_to`, `amount_incurred`, `notes`) VALUES
(9, 'REI2020-1-001', '2020-09-12', '2021-02-16', 'Ricmar Marcojos', '0.00', NULL),
(10, 'REI2020-1-002', '2020-09-12', '2021-02-16', 'Ricmar Marcojos', '0.00', NULL),
(11, 'REI2020-2-001', '2021-07-30', '2021-08-19', 'Ricmar Marcojos', '0.00', NULL),
(12, 'REI2020-2-002', '2021-08-06', '2021-08-19', 'Ricmar Marcojos', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
CREATE TABLE IF NOT EXISTS `requisitions` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `requisition_number` int(10) NOT NULL,
  `date_of_requisition` date NOT NULL,
  `paid_to_what_department` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `internal_number`, `requisition_number`, `date_of_requisition`, `paid_to_what_department`) VALUES
(14, 'REQ2020-1-001', 513, '2020-08-18', 'ComSO'),
(15, 'REQ2020-1-002', 3080, '2020-10-26', 'Business and Finance'),
(16, 'REQ2020-2-001', 3685, '2021-02-22', 'Business and Finance');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

DROP TABLE IF EXISTS `sponsorships`;
CREATE TABLE IF NOT EXISTS `sponsorships` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `internal_number` varchar(20) NOT NULL,
  `date_received_by_finance` date NOT NULL,
  `execomm` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `sponsor` varchar(200) NOT NULL,
  `cash` decimal(11,2) DEFAULT NULL,
  `kind` varchar(200) DEFAULT NULL,
  `deposited_value` decimal(11,2) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `internal_number`, `date_received_by_finance`, `execomm`, `description`, `sponsor`, `cash`, `kind`, `deposited_value`, `notes`) VALUES
(5, 'SPO2020-1-001', '2020-07-02', 'Health', 'SUMSA Sponsorship', 'SUMSA', '1000.00', NULL, '1000.00', 'SUMSA Sponsorship for Health Committee'),
(6, 'SPO2020-1-002', '2020-08-29', 'ComSO', 'Hibalag', 'Globe Telecom (GNP1 Marketing Corp)', '8000.00', NULL, '0.00', 'deposited to ComSO account'),
(7, 'SPO2020-1-003', '2020-08-30', 'Special Projects', 'HorRace VII: Game Over', 'Family Tree Dental Care', '1000.00', NULL, '1000.00', 'deposited to SG Account'),
(8, 'SPO2020-1-004', '2020-09-02', 'Advocacy, Enviro, STRAW', '11 Days of Sharing', 'Phl Dental Association - NegOr Chapter', NULL, '50pcs Hygiene Kits\r\n', NULL, 'sent to Talay Youth Home\r\n'),
(9, 'SPO2020-1-005', '2020-09-19', 'Special Projects', 'HorRace VII: Game Over', 'NDC Marketing Bacolod', NULL, 'Two Hawk Bags\r\n', NULL, 'prize for Champions of event'),
(10, 'SPO2020-1-006', '2020-12-03', 'Health\r\n', 'Pasundayag og Panalipod', 'Ma\'am Edna through OSS', '594.00', NULL, '0.00', 'cash directly given to Health Comm\r\n'),
(11, 'SPO2020-2-001', '2021-01-23', 'Sports and Recreation\r\n', 'MLBB Tournament\r\n', 'AcadArena Alliance\r\n', NULL, 'In game Currency\r\n', NULL, 'Around 3,500 worth of Diamond-Prizepool\r\n'),
(12, 'SPO2020-2-002', '2021-02-08', 'Health\r\n', 'RED Project\r\n', 'Danielle Navarro\r\n', NULL, 'Frames for Certificate\r\n', NULL, 'Certificate for Panelists\r\n'),
(13, 'SPO2020-2-003', '2021-02-22', 'Enviro\r\n', 'Resikad: Photo Challenge\r\n', '-\r\n', NULL, 'Cutlery & Load\r\n', NULL, '2 sets of Bamboo Cutlery, Php50 Load\r\n'),
(14, 'SPO2020-2-004', '2021-04-10', 'Dorm Life\r\n', 'Back to Basics\r\n', '-', '2000.00', NULL, '0.00', 'given directly to Dorm Life\r\n'),
(15, 'SPO2020-2-005', '2021-07-20', 'Marketing\r\n', '-', '-', '19850.00', NULL, '19850.00', 'from previous school year\'s sponsorships\r\n');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
