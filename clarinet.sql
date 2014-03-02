-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2014 at 07:00 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clarinet`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `radius_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `metric_type` enum('Search','Conversion') NOT NULL,
  `country` varchar(50) NOT NULL,
  `network_carrier` varchar(50) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `browser` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `radius_id` (`radius_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `radius_id`, `timestamp`, `metric_type`, `country`, `network_carrier`, `is_mobile`, `browser`) VALUES
(1, 17, '2014-01-28 18:39:33', 'Search', 'sdf', 'sdf', 0, 'sdf'),
(3, 17, '2014-01-29 16:18:18', 'Conversion', 'Japan', 'M1', 1, 'FF'),
(4, 17, '2014-01-29 16:19:46', 'Search', 'SG', 'sdf', 1, 'sdf'),
(5, 17, '2014-01-29 16:56:06', 'Search', 'ffee', 'sdsf', 1, 'fsdfsdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
