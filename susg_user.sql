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
-- Database: `susg_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_link`
--

DROP TABLE IF EXISTS `approval_link`;
CREATE TABLE IF NOT EXISTS `approval_link` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_link`
--

INSERT INTO `approval_link` (`id`, `name`) VALUES
(0, 'waiting'),
(1, 'approved'),
(2, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `database_year`
--

DROP TABLE IF EXISTS `database_year`;
CREATE TABLE IF NOT EXISTS `database_year` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `year_1` int(4) NOT NULL,
  `year_2` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `database_year`
--

INSERT INTO `database_year` (`id`, `year_1`, `year_2`) VALUES
(1, 2021, 2022),
(2, 2020, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `position_link`
--

DROP TABLE IF EXISTS `position_link`;
CREATE TABLE IF NOT EXISTS `position_link` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position_link`
--

INSERT INTO `position_link` (`id`, `name`) VALUES
(0, 'Viewer'),
(1, 'Editor'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `position` tinyint(4) NOT NULL,
  `create_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_timestamp` timestamp NULL DEFAULT NULL,
  `approve_reject_timestamp` timestamp NULL DEFAULT NULL,
  `supervisor_accept_reject` tinyint(4) DEFAULT NULL,
  `approval` tinyint(4) NOT NULL DEFAULT '0',
  `code` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `position`, `create_timestamp`, `update_timestamp`, `approve_reject_timestamp`, `supervisor_accept_reject`, `approval`, `code`) VALUES
(1, 'josemariagfelisilda@su.edu.ph', '$2y$10$eqYLPKSrpCx5wXQd9UnS6.isvTdVlJjJrZWCZrwwaC2Dl0AjhmwKC', 'Josemaria Archel', 'Felisildas', 2, '2022-12-23 03:38:47', '2022-12-31 18:13:19', '2022-12-24 02:58:47', 1, 1, NULL),
(2, 'nikkavserilo@su.edu.ph', '$2y$10$iDLzuDKiHgpPSzGOZ9LO4OOz8LTVU6ISouOR.8Yyh.pcEwrLlENb2', 'Nikka Marae', 'Serilo', 1, '2022-12-23 04:53:41', NULL, NULL, NULL, 0, NULL),
(3, 'danielaugeslani@su.edu.ph', '$2y$10$ZjlL/yCoylQIcvWYmgo4n.ru8uXqk8WIYjNQcVb1zhcx2UtfGEtFy', 'Daniela', 'Geslani', 1, '2022-12-24 04:59:28', NULL, NULL, NULL, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
