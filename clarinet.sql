-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2014 at 01:59 AM
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
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `complete_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `complete_name`, `email`, `message`) VALUES
(1, 'test title', 'test name', 'test@test.com', 'test message');

-- --------------------------------------------------------

--
-- Table structure for table `moments`
--

CREATE TABLE IF NOT EXISTS `moments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `app_key` varchar(100) NOT NULL,
  `vertical_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `max_responders` int(3) NOT NULL COMMENT 'Value must not exceed 999 for efficient results.',
  `max_distance` int(2) NOT NULL DEFAULT '5' COMMENT 'Value must not exceed 99 for efficient results.',
  PRIMARY KEY (`id`),
  KEY `vertical_id` (`vertical_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `moments`
--

INSERT INTO `moments` (`id`, `private`, `name`, `description`, `app_key`, `vertical_id`, `timestamp`, `max_responders`, `max_distance`) VALUES
(1, 1, 'moment1', 'descr1', '059727320a2a3c8293edf186bf112e5b', 1, '2014-02-11 00:37:19', 0, 5),
(3, 0, 'transpo', 'descr1', '6437c5865f05eb4bf2af5a2a30fa4933', 44, '2014-02-15 03:47:59', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `moment_operations`
--

CREATE TABLE IF NOT EXISTS `moment_operations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_type_id` int(11) NOT NULL,
  `moment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_type_id` (`operation_type_id`),
  KEY `moment_id` (`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `moment_pings`
--

CREATE TABLE IF NOT EXISTS `moment_pings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moments_id` int(11) NOT NULL,
  `lat_lng` varchar(50) DEFAULT NULL,
  `ponged` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moments_id` (`moments_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `moment_pings`
--

INSERT INTO `moment_pings` (`id`, `moments_id`, `lat_lng`, `ponged`, `confirmed`, `timestamp`, `message`) VALUES
(1, 1, 'null', 1, 0, '2014-02-11 01:12:00', '0000ff');

-- --------------------------------------------------------

--
-- Table structure for table `moment_ping_responders`
--

CREATE TABLE IF NOT EXISTS `moment_ping_responders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat_lng` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vertical_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `vertical_id` (`vertical_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='A simple way such as taxi driver to subscribe and listen to pings.' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `moment_ping_responders`
--

INSERT INTO `moment_ping_responders` (`id`, `lat_lng`, `user_id`, `vertical_id`) VALUES
(1, '1.2%203.4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operation_types`
--

CREATE TABLE IF NOT EXISTS `operation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` enum('Ping','Pong','Service') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `operation_types`
--

INSERT INTO `operation_types` (`id`, `name`, `category`) VALUES
(1, 'Send description to responders', 'Ping'),
(2, 'Send location to responders', 'Ping'),
(3, 'Send description to sender', 'Pong'),
(4, 'Send location to sender', 'Pong'),
(5, 'Send respondable confirmation message to sender', 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `radius`
--

CREATE TABLE IF NOT EXISTS `radius` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `verticals` varchar(500) NOT NULL,
  `description` text NOT NULL COMMENT 'Can be used for tagging.',
  `address` varchar(500) NOT NULL,
  `website` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `cosine_radians_latitude` float NOT NULL,
  `radians_longitude` float NOT NULL,
  `sine_radians_latitude` float NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`verticals`,`description`,`address`,`website`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `radius`
--

INSERT INTO `radius` (`id`, `name`, `verticals`, `description`, `address`, `website`, `phone`, `company_email`, `longitude`, `latitude`, `cosine_radians_latitude`, `radians_longitude`, `sine_radians_latitude`) VALUES
(17, 'taxi a', 'Transportation', 'vacant somewhere in singapore', 'singapore', 'http://www.google.com', '', '', 103.852, 1.29439, 0.999745, 1.81256, 0.0225894),
(18, 'taxi b', 'Transportation', 'occupied somewhere in indonesia', 'prezire address', 'http://something', '', '', 102.852, 1.29439, 0.999745, 1.79511, 0.0225894),
(19, 'some eatery', '', 'restaurant', 'singapore', '', '', '', 123.907, 10.3293, 0, 0, 0),
(20, 'jabe', '', 'restaurant', 'singapore', '', '', '', 123.907, 10.328, 0, 0, 0),
(33, 'taxi org namex', '', 'descrx', 'singapore', 'http://www.testx.com', '1234', 'testcomp@testx.com', 1.34, 1.14, 0.999802, 0.0233874, 0.0198954),
(34, 'taxi some org', 'Cafe & Restaurant', '', 'singapore', '', '', '', 1, 1, 0.999848, 0.0174533, 0.0174524),
(35, 'sdfsd', 'Cars & Transportation', '0', '0', 'http://sdfsdf', '0', '0', 3.3, 3.3, 0.998342, 0.0575959, 0.057564);

-- --------------------------------------------------------

--
-- Table structure for table `radius_admins`
--

CREATE TABLE IF NOT EXISTS `radius_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `radius_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `radius_id` (`radius_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `radius_admins`
--

INSERT INTO `radius_admins` (`id`, `radius_id`, `user_id`) VALUES
(3, 33, 1),
(4, 34, 4),
(5, 35, 6);

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

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`) VALUES
(1, 'prezire@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complete_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `password_forgotten` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `complete_name`, `email`, `password`, `confirmed`, `password_forgotten`) VALUES
(1, 'prezire', 'prezire@gmail.com', '1', 1, 0),
(3, 'test user', 'test@test.com', '123', 0, 0),
(4, 'sldfkj', 'djslkfj@flskdf.com', '1', 0, 0),
(6, 'adsfasf', 'fsdf', 'sdf', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verticals`
--

CREATE TABLE IF NOT EXISTS `verticals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `verticals`
--

INSERT INTO `verticals` (`id`, `name`) VALUES
(1, 'Adult'),
(2, 'Agriculture'),
(3, 'Animals & Pets'),
(4, 'Antiquity'),
(5, 'Architecture & Design'),
(6, 'Arts & Photography'),
(7, 'Beauty'),
(8, 'Books'),
(9, 'Business'),
(10, 'Cafe & Restaurant'),
(11, 'Cars & Transportation'),
(12, 'Charity & Donation'),
(13, 'Clubs & Casinos'),
(14, 'Communication'),
(15, 'Computers & Internet'),
(16, 'Dating'),
(17, 'Education'),
(18, 'Electronics'),
(19, 'Entertainment & Media'),
(20, 'Environmental'),
(21, 'Exterior & Interior Design'),
(22, 'Family'),
(23, 'Fashion'),
(24, 'Flowers'),
(25, 'Food & Drinks'),
(26, 'Games'),
(27, 'Gifts'),
(28, 'Hobbies'),
(29, 'Holidays'),
(30, 'Hotels'),
(31, 'Housing & Real Estate'),
(32, 'Industrial'),
(33, 'Jewelry'),
(34, 'Law & Politics'),
(35, 'Medical'),
(36, 'Military'),
(37, 'Music'),
(38, 'Religous'),
(39, 'Services'),
(40, 'Science'),
(41, 'Security'),
(42, 'Society & Culture'),
(43, 'Sport'),
(44, 'Travel & Leisure'),
(45, 'Wedding'),
(46, 'Others');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `moments`
--
ALTER TABLE `moments`
  ADD CONSTRAINT `moments_ibfk_1` FOREIGN KEY (`vertical_id`) REFERENCES `verticals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moment_operations`
--
ALTER TABLE `moment_operations`
  ADD CONSTRAINT `moment_operations_ibfk_1` FOREIGN KEY (`operation_type_id`) REFERENCES `operation_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moment_operations_ibfk_2` FOREIGN KEY (`moment_id`) REFERENCES `moments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moment_ping_responders`
--
ALTER TABLE `moment_ping_responders`
  ADD CONSTRAINT `moment_ping_responders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moment_ping_responders_ibfk_2` FOREIGN KEY (`vertical_id`) REFERENCES `verticals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radius_admins`
--
ALTER TABLE `radius_admins`
  ADD CONSTRAINT `radius_admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
