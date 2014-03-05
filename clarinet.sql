-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2014 at 02:32 AM
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
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `banner_path` varchar(500) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `media_type` enum('Image','SWF') NOT NULL,
  `users_id` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `bid_amount` float NOT NULL,
  `impressions` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `clickthrough_url` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `name`, `description`, `tags`, `banner_path`, `width`, `height`, `media_type`, `users_id`, `date_from`, `date_to`, `bid_amount`, `impressions`, `clicks`, `clickthrough_url`) VALUES
(1, 'test', 'test', 'test', '', 0, 0, '', 0, '2014-01-01 12:00:00', '2014-02-02 12:01:01', 1000, 0, 0, ''),
(2, 'test', 'test', 'test', '', 0, 0, '', 0, '2014-01-01 12:00:00', '2014-02-02 12:01:01', 1000, 0, 0, ''),
(3, 'test', 'test', 'test', '', 0, 0, '', 0, '2014-01-01 12:00:00', '2014-02-02 12:01:01', 1000, 0, 0, ''),
(4, 'test1', 'tewt1', 'fsf', '', 0, 0, '', 1, '2014-01-01 12:00:00', '2014-01-01 12:00:00', 2, 0, 0, ''),
(5, 'test1', 'tewt1', 'fsf', '', 0, 0, '', 1, '2014-01-01 12:00:00', '2014-01-01 12:00:00', 2, 0, 0, ''),
(6, 'slkdfj', 'flskfj', 'lskdf', '', 0, 0, '', 1, '2014-01-01 12:00:00', '2014-02-02 12:01:01', 234, 0, 0, 'http://www.slkdfjsldkf.com');

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
  `private` tinyint(1) NOT NULL DEFAULT '1',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `icon_path` varchar(255) NOT NULL,
  `app_key` varchar(100) NOT NULL,
  `verticals_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable_limited_max_ping_responders` tinyint(1) NOT NULL DEFAULT '1',
  `limit_max_ping_responders` int(3) NOT NULL DEFAULT '20' COMMENT 'Value must not exceed 999 for efficient results.',
  `enable_limited_max_ping_radius` tinyint(1) NOT NULL DEFAULT '1',
  `limit_max_ping_radius` int(2) NOT NULL DEFAULT '5' COMMENT 'Value must not exceed 99 for efficient results.',
  `enable_limited_max_pong_radius` tinyint(1) NOT NULL DEFAULT '1',
  `limit_max_pong_radius` int(2) NOT NULL DEFAULT '5',
  `ping_allow_send_optional_message_to_responder` tinyint(1) NOT NULL DEFAULT '0',
  `ping_enable_use_optional_message_as_search_keyword` tinyint(1) NOT NULL DEFAULT '0',
  `pong_enable_auto_send_responder_description` tinyint(1) NOT NULL DEFAULT '1',
  `pong_enable_send_notification_message_to_sender` tinyint(1) NOT NULL DEFAULT '1',
  `pong_notification_message_title` varchar(100) NOT NULL DEFAULT 'We got your request.',
  `pong_notification_message` varchar(255) NOT NULL DEFAULT 'Please be patient while we process your request.',
  `after_service_enable_send_prompt_message_to_sender` tinyint(1) NOT NULL DEFAULT '0',
  `after_service_prompt_message_title` varchar(100) NOT NULL DEFAULT 'Send us a feedback.',
  `after_service_prompt_message` varchar(255) NOT NULL DEFAULT 'Was the service satisfactory? Please click Yes if it was. Otherwise, click the Close button.',
  `tags` text NOT NULL COMMENT 'Used typically for searching separated by commas.',
  PRIMARY KEY (`id`),
  KEY `verticals_id` (`verticals_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `moments`
--

INSERT INTO `moments` (`id`, `private`, `activated`, `name`, `description`, `icon_path`, `app_key`, `verticals_id`, `timestamp`, `enable_limited_max_ping_responders`, `limit_max_ping_responders`, `enable_limited_max_ping_radius`, `limit_max_ping_radius`, `enable_limited_max_pong_radius`, `limit_max_pong_radius`, `ping_allow_send_optional_message_to_responder`, `ping_enable_use_optional_message_as_search_keyword`, `pong_enable_auto_send_responder_description`, `pong_enable_send_notification_message_to_sender`, `pong_notification_message_title`, `pong_notification_message`, `after_service_enable_send_prompt_message_to_sender`, `after_service_prompt_message_title`, `after_service_prompt_message`, `tags`) VALUES
(1, 1, 0, 'Medical', 'In a medical emergency with no one to call? With a simple tap of a button, let your location be known to all nearby hospitals.\nComplete with patient profile and the like. Get action fast.', '', '059727320a2a3c8293edf186bf112e5b', 1, '2014-02-11 00:37:19', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(3, 0, 0, 'Transportation', 'Can''t find taxi when you need one? One tap of a button and the app will detect your location. It will then search the nearest\nvacant cab and provides the cab driver the closest route to reach you. Plus! Know when a driver has accepted your request\nand is on his way.', '', '6437c5865f05eb4bf2af5a2a30fa4933', 44, '2014-02-15 03:47:59', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(4, 1, 0, 'Police Station', 'Lorem ipsum dolor sit amet, fecisti iste quod non solutionem invenisti naufragus. Cyrenensi reversus est se est Apollonius ut sua coniuge in deinde duas recitare ex auxilium tolle mei. Possit ei Taliarchum in rei exultant deo adoptavit cum autem illud cenam ita factum ei Taliarchum in fuerat.', '', '8b8ed40bb48b25910a1a20abffc77d55', 1, '2014-02-17 16:57:43', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(5, 1, 0, 'Fire Station', 'Lorem ipsum dolor sit amet, fecisti iste quod non solutionem invenisti naufragus. Cyrenensi reversus est se est Apollonius ut sua coniuge in deinde duas recitare ex auxilium tolle mei. Possit ei Taliarchum in rei exultant deo adoptavit cum autem illud cenam ita factum ei Taliarchum in fuerat.', '', '1826b396654150a2a753c59a5f056940', 1, '2014-02-17 16:58:08', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(6, 1, 0, 'NGOs', 'Lorem ipsum dolor sit amet, fecisti iste quod non solutionem invenisti naufragus. Cyrenensi reversus est se est Apollonius ut sua coniuge in deinde duas recitare ex auxilium tolle mei. Possit ei Taliarchum in rei exultant deo adoptavit cum autem illud cenam ita factum ei Taliarchum in fuerat.', '', 'd5c20a0334b34f3731afd6ad73f971b4', 1, '2014-02-17 16:59:13', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(7, 1, 0, 'IT Services', 'Lorem ipsum dolor sit amet, fecisti iste quod non solutionem invenisti naufragus. Cyrenensi reversus est se est Apollonius ut sua coniuge in deinde duas recitare ex auxilium tolle mei. Possit ei Taliarchum in rei exultant deo adoptavit cum autem illud cenam ita factum ei Taliarchum in fuerat.', '', '7efc1fea155150520df7a0737d271c61', 1, '2014-02-17 17:01:04', 1, 0, 1, 5, 1, 5, 0, 0, 0, 0, '', '', 0, '', '', ''),
(8, 0, 0, 'Job', 'Don''t want job portals? Ping/broadcast interest and be informed of the latest job openings.', '', 'c6810efdd45a040ce31458cf9eb78dc8', 1, '2014-02-21 01:50:07', 1, 20, 1, 5, 1, 5, 0, 0, 1, 1, 'We got your request.', 'Please be patient while we process your request.', 0, 'Send us a feedback.', 'Was the service satisfactory? Please click Yes if it was. Otherwise, click the Close button.', ''),
(12, 1, 0, 'test', 'fsdf', '', '775963ffa3872dfd39305224d1e35ce4', 1, '2014-02-24 17:21:50', 1, 20, 1, 5, 1, 5, 0, 0, 1, 1, 'We got your request.', 'Please be patient while we process your request.', 0, 'Send us a feedback.', 'Was the service satisfactory? Please click Yes if it was. Otherwise, click the Close button.', '');

-- --------------------------------------------------------

--
-- Table structure for table `moment_broadcasts`
--

CREATE TABLE IF NOT EXISTS `moment_broadcasts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('Ping','Pong') NOT NULL,
  `moments_id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `ponged` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `private_message` text NOT NULL COMMENT 'Used typically for integration to be used for devices.',
  PRIMARY KEY (`id`),
  KEY `moments_id` (`moments_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Save pings here esp for device integration.' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `moment_broadcasts`
--

INSERT INTO `moment_broadcasts` (`id`, `type`, `moments_id`, `latitude`, `longitude`, `ponged`, `timestamp`, `private`, `private_message`) VALUES
(1, 'Ping', 1, 0, 0, 1, '2014-02-11 01:12:00', 1, '0000ff'),
(2, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-02 14:17:52', 0, '0'),
(3, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-02 14:18:51', 0, '0'),
(4, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-02 14:20:46', 0, '0'),
(5, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-02 14:23:37', 0, '0'),
(6, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-02 14:23:44', 0, '0'),
(7, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-03 15:29:21', 0, '0'),
(8, 'Ping', 5, 1.31615, 103.856, 0, '2014-03-03 15:30:14', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `moment_release_subscriptions`
--

CREATE TABLE IF NOT EXISTS `moment_release_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `moment_release_subscriptions`
--

INSERT INTO `moment_release_subscriptions` (`id`, `email`) VALUES
(1, 'prezire@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `moment_user_states`
--

CREATE TABLE IF NOT EXISTS `moment_user_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `moments_id` int(11) NOT NULL,
  `state` enum('Sender','Responder') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moments_id` (`moments_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `moment_user_states`
--

INSERT INTO `moment_user_states` (`id`, `users_id`, `moments_id`, `state`) VALUES
(8, 1, 1, 'Responder'),
(13, 1, 3, 'Responder');

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
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Super Administrator'),
(2, 'CMS Administrator'),
(3, 'Public User');

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
  `avatar` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` datetime NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `complete_name`, `email`, `password`, `confirmed`, `password_forgotten`, `avatar`, `address`, `birthdate`, `role_id`) VALUES
(1, 'prezire', 'prezire@gmail.com', '1', 1, 0, '', '', '0000-00-00 00:00:00', 1),
(3, 'test user', 'test@test.com', '123', 0, 0, '', '', '0000-00-00 00:00:00', 2),
(4, 'sldfkj', 'djslkfj@flskdf.com', '1', 0, 0, '', '', '0000-00-00 00:00:00', 2),
(6, 'adsfasf', 'fsdf', 'sdf', 0, 0, '', '', '0000-00-00 00:00:00', 2);

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
-- Constraints for table `moment_user_states`
--
ALTER TABLE `moment_user_states`
  ADD CONSTRAINT `moment_user_states_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moment_user_states_ibfk_3` FOREIGN KEY (`moments_id`) REFERENCES `moments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radius_admins`
--
ALTER TABLE `radius_admins`
  ADD CONSTRAINT `radius_admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
