-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2017 at 05:18 AM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_file` varchar(64) NOT NULL,
  `image_name` varchar(64) NOT NULL,
  `image_caption` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_file`, `image_name`, `image_caption`, `created`, `active`) VALUES
(1, 'image01.jpg', 'Product Image', 'Product Image', '2017-02-14 00:00:00', 1),
(2, 'image02.jpg', 'Product Image', 'Product Image', '2017-02-14 01:00:00', 1),
(3, 'image03.jpg', 'Product Image', 'Product Image', '2017-02-14 01:02:00', 1),
(4, 'image04.jpg', 'Product Image', 'Product Image', '2017-02-14 01:04:10', 1),
(5, 'image05.jpg', 'product image', 'product image', '2017-02-14 02:00:00', 1),
(6, 'image06.jpg', 'product image', 'product image', '2017-02-14 02:01:00', 1),
(7, 'image07.jpg', 'product image', 'product image', '2017-02-14 02:04:00', 1),
(8, 'image08.jpg', 'product image', 'product image', '2017-02-14 02:05:00', 1),
(9, 'image09.jpg', 'product image', 'product image', '2017-02-14 02:06:00', 1),
(10, 'image10.jpg', 'product image', 'product image', '2017-02-14 02:07:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
