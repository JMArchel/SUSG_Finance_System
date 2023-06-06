-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2023 at 05:55 AM
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
-- Database: `susg_2021-2022`
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advances`
--

INSERT INTO `cash_advances` (`id`, `internal_number`, `date_of_sa`, `ca_amount`, `ca_status`, `notes`) VALUES
(1, 'CA2021-1-000', '2021-08-01', '2000.00', 8, NULL),
(2, 'CA2021-1-001', '2021-09-26', '4700.00', 8, NULL),
(3, 'CA2021-1-002', '2021-10-25', '200000.00', 8, NULL),
(4, 'CA2021-1-003', '2021-11-08', '8140.00', 8, NULL),
(5, 'CA2021-1-004', '2021-11-09', '1430.00', 8, NULL),
(6, 'CA2021-1-005', '2021-11-22', '3740.00', 8, NULL),
(7, 'CA2021-1-006', '2021-12-20', '39149.55', 8, NULL),
(8, 'CA2021-1-007', '2022-01-10', '18488.86', 8, NULL),
(9, 'CA2021-2-001', '2022-02-28', '91433.50', 8, NULL),
(10, 'CA2021-2-002', '2022-03-14', '6125.00', 8, NULL);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_advocacy`
--

INSERT INTO `com_advocacy` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-003', 'ACA-Quaintance\r\n', '6000.00'),
(2, 'CA2021-1-003', 'Bisaya 101 Workshop\r\n', '2750.00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_comso`
--

INSERT INTO `com_comso` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REQ2021-1-001', 'Annual Appropriation', '20000.00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_educational_services`
--

INSERT INTO `com_educational_services` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', '#StartUp Webinar', '800.00'),
(2, 'REQ2021-1-004', 'SUSG Scholars', '240000.00'),
(3, 'REQ2021-2-001', 'SUSG Scholars\r\n', '359999.92');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_environmental`
--

INSERT INTO `com_environmental` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-003', 'Pagpakabana Webinar', '734.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_health`
--

INSERT INTO `com_health` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-003', 'Virtual Freedom Wall', '1150.00'),
(2, 'REI2021-1-003', 'Bloodline Hotline', '3300.00'),
(3, 'CA2021-2-001', 'Balitaktakan', '9500.00'),
(4, 'CA2021-2-002', 'Inside My Safe Space', '1045.00');

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

--
-- Dumping data for table `com_hert`
--

INSERT INTO `com_hert` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', 'Tambayayong Webinar', '1000.00'),
(2, 'CA2021-2-001', 'Project Dagway', '33680.95');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_high_school_affairs`
--

INSERT INTO `com_high_school_affairs` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', 'Dula Duels', '2500.00'),
(2, 'REI2021-1-003', 'High, Everybuddy!', '2000.00'),
(3, 'CA2021-1-001', 'MTSoc Sponsorship', '200.00'),
(4, 'CA2021-1-001', 'Buddy Goals', '1999.00'),
(5, 'REI2021-2-001', 'Tatak Senior High', '1600.00'),
(6, 'CA2021-2-002', 'InterArt', '599.25');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_infomedia`
--

INSERT INTO `com_infomedia` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-002', 'Hibalag Virtual Booth Festival', '4891.73');

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

--
-- Dumping data for table `com_miss_silliman`
--

INSERT INTO `com_miss_silliman` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REQ2021-1-002', 'Annual Appropriation', '20000.00'),
(2, 'REQ2021-1-003', 'Additional Appropriation', '9127.68');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_social_services`
--

INSERT INTO `com_social_services` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', 'Y2K Bazaar', '100.00'),
(2, 'REI2021-1-003', 'Leadership and Citizenship Webinar', '722.00'),
(3, 'CA2021-1-002', 'No Student Left behind', '183415.00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_special_projects`
--

INSERT INTO `com_special_projects` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', 'HoRace VIII', '1000.00'),
(2, 'CA2021-1-003', 'Speak Up', '4900.00'),
(3, 'REI2021-2-001', 'Manifest', '1050.00');

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

--
-- Dumping data for table `com_spiritual_life`
--

INSERT INTO `com_spiritual_life` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-001', 'Christian Night 2021', '1401.65'),
(2, 'REI2021-1-003', '#COVID Live Webinar', '450.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_sports`
--

INSERT INTO `com_sports` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2021-2-001', 'E-Trams 2022', '39677.50');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_straw`
--

INSERT INTO `com_straw` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2021-1-005', 'Pelikula\'t Pagmulat', '3400.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_assembly_general`
--

INSERT INTO `fund_assembly_general` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2021-1-001', 'SUSG Assem Zoom Account', '1511.22'),
(2, 'CA2021-1-007', 'SUSG Assembly T-shirts', '8488.86'),
(3, 'CA2021-2-002', 'Assembly Load Subsidy', '1350.00'),
(4, 'REI2021-2-001', 'Call to Vote Video', '1500.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_assembly_sponsorship`
--

INSERT INTO `fund_assembly_sponsorship` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2021-1-006', 'TSI Odette Sponsorship', '15000.00'),
(2, 'REI2021-2-002', 'Dear Self Project Sponsorship', '6000.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_comelec`
--

INSERT INTO `fund_comelec` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-2-001', 'Virtual Halalan 2022', '24261.00');

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

--
-- Dumping data for table `fund_gender_inclusivity`
--

INSERT INTO `fund_gender_inclusivity` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'CA2021-1-004', 'Wansapanataym Competition', '1300.00'),
(2, 'CA2021-1-006', 'Wansapanataym Outreach', '5099.55'),
(3, 'CA2021-1-007', 'Stand for Surigao', '9926.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_initial_susg`
--

INSERT INTO `fund_initial_susg` (`id`, `date`, `description`, `debit`, `credit`) VALUES
(1, '2021-08-23', 'Registrars enrollee count for 1st semester', NULL, '536190.72'),
(3, '2022-01-31', 'adjustment for SY residency withdrawals', '5865.60', NULL),
(4, '2022-02-22', 'Registrar\'s enrollee count for 2nd sem', NULL, '541191.04'),
(5, '2022-03-01', 'adjustment to actual deposit', NULL, '12911.40'),
(6, '2022-07-31', 'adjustment for late transfer of funds', NULL, '4582.28'),
(16, '2021-10-13', 'adjustment to actual deposit', NULL, '37653.00');

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
('337451.40');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_president_discretionary`
--

INSERT INTO `fund_president_discretionary` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-004', 'SUSG #NoTo174 Campaign Video', '4663.75'),
(2, 'REI2021-1-005', 'Call to Vote and Register Video\r\n', '1500.00'),
(3, 'REI2021-1-006', 'Dgte Animal Sanctuary Spon', '2000.00'),
(4, 'REI2021-1-006', '1st Semester SSBA', '1500.00'),
(5, 'REI2021-2-002', 'HERT Sponsorship', '2925.00'),
(6, 'REI2021-2-002', 'SUSG Execomm Pins\r\n', '8456.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_vice_president_discretionary`
--

INSERT INTO `fund_vice_president_discretionary` (`id`, `internal_number`, `description`, `amount`) VALUES
(1, 'REI2021-1-005', 'SUSG Lupang Hinirang Video', '2460.00'),
(2, 'REI2021-1-006', 'Health Committee 11 DoS', '4000.00'),
(3, 'REI2021-1-006', 'SUSG Lupang Hinirang Video', '500.00'),
(4, 'REI2021-2-002', '2nd Semester SSBA', '1500.00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reimbursements`
--

INSERT INTO `reimbursements` (`id`, `internal_number`, `date_received_by_finance`, `date_reimburse`, `reimbursed_to`, `amount_incurred`, `notes`) VALUES
(1, 'REI2021-1-001', '2021-08-30', '2021-08-08', 'Ricmar Marcojos\r\n', '6801.65', NULL),
(2, 'REI2021-1-002', '2021-08-30', '2021-08-08', 'Ricmar Marcojos\r\n', '4891.73', NULL),
(3, 'REI2021-1-003', '2021-09-15', '2021-08-08', 'Ricmar Marcojos\r\n', '14356.00', NULL),
(4, 'REI2021-1-004', '2021-10-02', '2021-12-10', 'Myka Reambonanza\r\n', '4663.75', NULL),
(5, 'REI2021-1-005', '2021-11-05', '2021-12-10', 'Myka Reambonanza\r\n', '3960.00', NULL),
(6, 'REI2021-1-006', '2022-02-11', '2021-03-30', 'Myka Reambonanza\r\n', '8000.00', NULL),
(7, 'REI2021-2-001', '2022-08-03', NULL, 'Ricmar Marcojos\r\n', '28411.00', NULL),
(8, 'REI2021-2-002', '2022-08-03', NULL, 'Ricmar Marcojos\r\n', '18881.00', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `internal_number`, `requisition_number`, `date_of_requisition`, `paid_to_what_department`) VALUES
(1, 'REQ2021-1-001', 129, '2021-08-13', 'ComSO\r\n'),
(2, 'REQ2021-1-00', 130, '2021-08-13', 'Miss Silliman\r\n'),
(3, 'REQ2021-1-003', 1251, '2021-11-08', 'Miss Silliman\r\n'),
(4, 'REQ2021-1-004', 986, '2021-11-26', 'Business and Finance\r\n'),
(5, 'REQ2021-1-001', 2772, '2022-06-09', 'Business and Finance\n');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `internal_number`, `date_received_by_finance`, `execomm`, `description`, `sponsor`, `cash`, `kind`, `deposited_value`, `notes`) VALUES
(1, 'SPO2021-1-001', '2021-08-04', 'Marketing', 'Kasadya sa Silliman', 'Grab Dumaguete', '2500.00', NULL, NULL, 'Directly paid to AOTP as Talent Fee'),
(2, 'SPO2021-1-002', '2021-09-03', 'Marketing', 'Kasadya sa Silliman', 'Written in Red', '3000.00', NULL, NULL, 'Directly paid to AOTP as Talent Fee'),
(3, 'SPO2021-1-003', '2021-09-03', 'Marketing', 'Kasadya sa Silliman', 'Positive Kalyca', '1000.00', NULL, NULL, 'Directly paid to AOTP as Talent Fee'),
(4, 'SPO2021-1-004', '2021-09-03', 'Marketing', 'Kasadya sa Silliman', 'Dreamcatcher\'s Studio', '1000.00', NULL, NULL, '500 to AOTP and 500 to Tech Team');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
