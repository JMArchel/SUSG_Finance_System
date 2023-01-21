-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2023 at 01:31 PM
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
-- Database: `susg_2019-2020`
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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advances`
--

INSERT INTO `cash_advances` (`id`, `internal_number`, `date_of_sa`, `ca_amount`, `ca_status`, `notes`) VALUES
(1, 'CA2020-1-001', '2020-08-18', '2000.00', 9, NULL),
(2, 'CA2020-1-002', '2020-08-18', '50000.00', 9, NULL),
(3, 'CA2020-1-003', '2020-08-18', '80000.00', 9, 'if there is a will, there will always be ways'),
(4, 'CA2020-1-004', '2020-09-04', '36640.00', 9, NULL),
(5, 'CA2020-1-005', '2020-09-22', '7980.00', 9, NULL),
(6, 'CA2020-1-006', '2020-10-19', '4158.00', 9, NULL),
(7, 'CA2020-1-007', '2020-10-19', '85000.00', 9, NULL),
(8, 'CA2020-1-008', '2020-10-26', '2250.00', 9, NULL),
(9, 'CA2020-1-009', '2020-11-09', '9074.00', 9, NULL),
(10, 'CA2020-1-010', '2020-11-17', '200000.00', 9, NULL),
(11, 'CA2020-1-011', '2020-11-17', '15000.00', 9, NULL),
(12, 'CA2020-2-001', '2021-01-25', '16362.00', 9, NULL),
(13, 'CA2020-2-002', '2021-02-08', '7865.00', 9, NULL),
(14, 'CA2020-2-003', '2021-02-22', '2470.00', 9, NULL),
(15, 'CA2020-2-004', '2021-03-08', '10890.00', 9, NULL),
(16, 'CA2020-2-005', '2021-03-22', '47883.00', 9, NULL),
(17, 'CA2020-2-006', '2021-04-19', '125000.00', 9, NULL),
(18, 'CA2020-2-007', '2021-04-19', '4200.00', 9, NULL),
(19, 'CA2020-2-008', '2021-04-19', '3000.00', 9, NULL),
(20, 'CA2020-2-009', '2021-05-03', '36675.00', 9, NULL),
(21, 'CA2020-2-010', '2021-05-28', '27000.00', 9, NULL);

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
-- Table structure for table `committee_fund`
--

DROP TABLE IF EXISTS `committee_fund`;
CREATE TABLE IF NOT EXISTS `committee_fund` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `comm_fund` varchar(100) NOT NULL,
  `internal_number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_fund`
--

INSERT INTO `committee_fund` (`id`, `comm_fund`, `internal_number`, `description`, `amount`) VALUES
(1, 'assembly general', 'CA2020-1-008', 'Zoom Premium Fund', '1442.78'),
(2, 'assembly general', 'CA2020-2-003', 'Zoom Premium Fund', '2183.58'),
(3, 'assembly general', 'CA2020-2-009', 'SUSG Shirts\r\n', '7750.00'),
(4, 'assembly sponsorship', 'CA2020-1-011', 'Cash Donation to TSI', '15000.00'),
(5, 'assembly sponsorship', 'CA2020-2-008', 'Project Space Impact', '3000.00'),
(6, 'presidents discretionary', 'CA2020-2-009', 'SUSG Shirts', '12000.00'),
(7, 'vice presidents discretionary', 'CA2020-2-009', 'SUSG Shirts\r\n', '9500.00'),
(8, 'comelec', 'REI2020-2-003', 'Virtual Halalan 2021', '18814.90'),
(9, 'advocacy', 'REI2020-1-002', 'Advocacy Building Camp', '1825.00'),
(10, 'advocacy', 'CA2020-2-003', 'Halwat 2021', '200.00'),
(11, 'advocacy', 'PC2020-2-001', 'Juan, Makisagwan!\r\n', '500.00'),
(12, 'cheering', 'CA2020-1-005', 'TeaCHEERS Day\r\n', '1891.50'),
(13, 'comso', 'REQ2020-1-001', 'Automatic Appropriations', '20000.00'),
(14, 'dorm life', 'CA2020-1-004', 'Kaagapay: Coping with the New Normal', '2345.75'),
(15, 'dorm life', 'CA2020-1-005', '#IntheMaking: Before you Life the Cap', '849.00'),
(16, 'dorm life', 'CA2020-2-007', 'Project Space Impact Cash Sponsorship', '2000.00'),
(17, 'dorm life', 'CA2020-1-005', 'Spooky Nights', '700.00'),
(18, 'dorm life', 'CA2020-1-006', 'Clean and Green Revolution 1', '3141.35'),
(19, 'dorm life', 'CA2020-1-009', '#IntheMaking: The In-Betweens', '1616.85'),
(20, 'dorm life', 'CA2020-1-009', 'Take Cover', '5000.00'),
(21, 'dorm life', 'CA2020-2-002', '#IntheMaking: Penny Pincher', '1650.00'),
(22, 'dorm life', 'CA2020-2-002', 'Clean and Green Revolution 2', '4290.00'),
(23, 'dorm life', 'CA2020-2-007', '#IntheMaking: Walk your Path', '2200.00'),
(24, 'educational services', 'REQ2020-1-002', 'SUSG Scholarship Fund', '120000.00'),
(25, 'educational services', 'REQ2020-2-001', 'SUSG Scholarship Fund', '120000.00'),
(26, 'environment', 'CA2020-2-005', 'Project Resikad 2.0', '15482.50'),
(27, 'health', 'REI2020-1-001', 'Pasigarbo: Instagram Challenge', '2077.60'),
(28, 'health', 'REI2020-1-001', 'Bloodline Hotline', '1600.00'),
(29, 'health', 'CA2020-2-002', 'RED Project', '1925.00'),
(30, 'health', 'CA2020-2-009', 'Psychological First Aid Webinar', '1045.00'),
(31, 'high school affairs', 'REI2020-1-002', 'Hibalag Fashion Week\r\n', '1500.00'),
(32, 'high school affairs', 'REI2020-1-002', 'OPM Song Cover Contest', '1500.00'),
(33, 'high school affairs', 'CA2020-2-004', 'Tatak Senior High', '2640.00'),
(34, 'infomedia', 'REI2020-1-002', 'Hibalag Minecraft Booth Festival', '389.00'),
(35, 'research', 'REI2020-1-001', 'LUWAS: A Webinar on Basic First Aid', '800.00'),
(36, 'research', 'CA2020-1-005', 'Wildlife Photography and Photo Editing Webinar', '1500.00'),
(37, 'social services', 'REI2020-1-001', 'Kwentong Bayani', '3000.00'),
(38, 'social services', 'CA2020-1-003', 'No Student Left Behind 1', '54880.00'),
(39, 'social services', 'CA2020-1-007', 'No Student Left Behind 2', '63324.00'),
(40, 'social services', 'CA2020-2-006', 'No Student Left Behind 3', '122093.00'),
(41, 'socio cultural', 'CA2020-2-001', 'Paghulagway', '13000.00'),
(42, 'socio cultural', 'CA2020-2-009', 'Shutter Up', '6380.00'),
(43, 'special projects', 'REI2020-1-002', 'Campus Virtual Tour', '700.00'),
(44, 'special projects', 'REI2020-1-002', 'HorRace VII: Game Over', '900.00'),
(45, 'special projects', 'CA2020-1-009', 'Adulting Basics', '1854.10'),
(46, 'special projects', 'CA2020-2-004', 'Soul Stories', '7500.00'),
(47, 'special projects', 'CA2020-2-001', 'BS Org Start Pack', '3159.55'),
(48, 'sports', 'CA2020-2-005', 'E-tramurals', '29858.25'),
(49, 'straw', 'REI2020-2-002', '(RYLF) The Queen in You: A Drag Make Up Competition', '4800.00');

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
(1, '2020-09-02', 'Registrar\'s enrollee count for 1st sem\r\n', NULL, '382736.64'),
(2, '2020-11-04', 'adjustment to initial actual deposited amount\r\n', NULL, '114115.90'),
(3, '2020-11-04', 'adjustment for SY residency withdrawals\r\n', '7232.04', NULL),
(4, '2021-01-31', 'adjustment for late transfer of funds\r\n', NULL, '13950.76'),
(5, '2021-02-02', 'Registrar\'s enrollee count for 2nd sem\r\n', NULL, '386647.04'),
(6, '2021-04-20', 'adjustment to initial actual deposited amount\r\n', NULL, '99921.56'),
(7, '2021-04-20', 'adjustment for SY residency withdrawals\r\n', '3101.29', NULL),
(8, '2021-05-31', 'adjustment for SY residency withdrawals\r\n', '3291.60', NULL);

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
(1, 'REI2020-1-001', '2020-09-12', '2021-02-16', 'Ricmar Marcojos', '0.00', NULL),
(2, 'REI2020-1-002', '2020-09-12', '2021-02-16', 'Ricmar Marcojos', '0.00', NULL),
(3, 'REI2020-2-001', '2021-07-30', '2021-08-19', 'Ricmar Marcojos', '0.00', NULL),
(4, 'REI2020-2-002', '2021-08-06', '2021-08-19', 'Ricmar Marcojos', '0.00', NULL);

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
(1, 'REQ2020-1-001', 513, '2020-08-18', 'ComSO'),
(2, 'REQ2020-1-002', 3080, '2020-10-26', 'Business and Finance'),
(3, 'REQ2020-2-001', 3685, '2021-02-22', 'Business and Finance');

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
(1, 'SPO2020-1-001', '2020-07-02', 'Health', 'SUMSA Sponsorship', 'SUMSA', '1000.00', NULL, '1000.00', 'SUMSA Sponsorship for Health Committee'),
(2, 'SPO2020-1-002', '2020-08-29', 'ComSO', 'Hibalag', 'Globe Telecom (GNP1 Marketing Corp)', '8000.00', NULL, '0.00', 'deposited to ComSO account'),
(3, 'SPO2020-1-003', '2020-08-30', 'Special Projects', 'HorRace VII: Game Over', 'Family Tree Dental Care', '1000.00', NULL, '1000.00', 'deposited to SG Account'),
(4, 'SPO2020-1-004', '2020-09-02', 'Advocacy, Enviro, STRAW', '11 Days of Sharing', 'Phl Dental Association - NegOr Chapter', NULL, '50pcs Hygiene Kits\r\n', NULL, 'sent to Talay Youth Home\r\n'),
(5, 'SPO2020-1-005', '2020-09-19', 'Special Projects', 'HorRace VII: Game Over', 'NDC Marketing Bacolod', NULL, 'Two Hawk Bags\r\n', NULL, 'prize for Champions of event'),
(6, 'SPO2020-1-006', '2020-12-03', 'Health\r\n', 'Pasundayag og Panalipod', 'Ma\'am Edna through OSS', '594.00', NULL, '0.00', 'cash directly given to Health Comm\r\n'),
(7, 'SPO2020-2-001', '2021-01-23', 'Sports and Recreation\r\n', 'MLBB Tournament\r\n', 'AcadArena Alliance\r\n', NULL, 'In game Currency\r\n', NULL, 'Around 3,500 worth of Diamond-Prizepool\r\n'),
(8, 'SPO2020-2-002', '2021-02-08', 'Health\r\n', 'RED Project\r\n', 'Danielle Navarro\r\n', NULL, 'Frames for Certificate\r\n', NULL, 'Certificate for Panelists\r\n'),
(9, 'SPO2020-2-003', '2021-02-22', 'Enviro\r\n', 'Resikad: Photo Challenge\r\n', '-\r\n', NULL, 'Cutlery & Load\r\n', NULL, '2 sets of Bamboo Cutlery, Php50 Load\r\n'),
(10, 'SPO2020-2-004', '2021-04-10', 'Dorm Life\r\n', 'Back to Basics\r\n', '-', '2000.00', NULL, '0.00', 'given directly to Dorm Life\r\n'),
(11, 'SPO2020-2-005', '2021-07-20', 'Marketing\r\n', '-', '-', '19850.00', NULL, '19850.00', 'from previous school year\'s sponsorships\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `status_link`
--

DROP TABLE IF EXISTS `status_link`;
CREATE TABLE IF NOT EXISTS `status_link` (
  `ca_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_description` varchar(50) NOT NULL,
  PRIMARY KEY (`ca_status`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_link`
--

INSERT INTO `status_link` (`ca_status`, `status_description`) VALUES
(1, 'in Process'),
(2, 'Cheque obtained'),
(3, 'Cash obtained'),
(4, 'Cash delivered'),
(5, 'Partial Collection'),
(6, 'Receipts/Cash Collected'),
(7, 'Passed to CoA'),
(8, 'Processing for Liquidation'),
(9, 'Closed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
