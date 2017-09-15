-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2017 at 04:53 AM
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
-- Table structure for table `products_images`
--

CREATE TABLE IF NOT EXISTS `products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image_id`) VALUES
(2, 65, 2),
(3, 66, 3),
(4, 67, 4),
(5, 68, 5),
(6, 69, 6),
(7, 70, 7),
(8, 71, 8),
(9, 72, 9),
(10, 73, 10),
(11, 74, 1),
(12, 75, 2),
(13, 76, 3),
(14, 77, 4),
(15, 78, 5),
(17, 65, 3),
(18, 79, 6),
(19, 80, 7),
(20, 81, 8),
(21, 82, 9),
(22, 83, 10),
(23, 84, 1),
(24, 85, 2),
(25, 86, 3),
(26, 87, 4),
(27, 88, 5),
(28, 89, 6),
(30, 91, 8),
(31, 92, 9),
(34, 95, 2),
(40, 94, 1),
(45, 99, 6),
(46, 100, 7),
(47, 101, 8),
(52, 96, 5),
(53, 97, 6),
(54, 98, 7),
(58, 102, 1),
(59, 103, 2),
(60, 104, 3),
(61, 105, 4),
(62, 106, 5),
(63, 107, 6),
(64, 108, 7),
(65, 109, 8),
(66, 110, 9),
(67, 111, 10),
(68, 112, 1),
(69, 113, 2),
(70, 114, 3),
(71, 115, 4),
(73, 117, 6),
(74, 118, 7),
(75, 119, 8),
(76, 120, 9),
(77, 121, 10),
(78, 122, 1),
(79, 131, 10),
(80, 123, 2),
(81, 124, 3),
(82, 125, 4),
(83, 126, 5),
(84, 127, 6),
(85, 128, 7),
(86, 129, 8),
(87, 130, 9),
(88, 132, 1),
(89, 133, 2),
(90, 134, 3),
(91, 135, 4),
(92, 136, 5),
(93, 137, 6),
(94, 138, 7),
(95, 139, 8),
(96, 140, 9),
(97, 141, 10),
(98, 142, 1),
(99, 143, 2),
(100, 144, 3),
(101, 145, 4),
(103, 146, 8),
(104, 90, 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
