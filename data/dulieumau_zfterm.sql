-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2014 at 08:16 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zf2tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `zf_term`
--

CREATE TABLE IF NOT EXISTS `zf_term` (
  `term_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `term_group` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `zf_term`
--

INSERT INTO `zf_term` (`term_id`, `name`, `slug`, `term_group`) VALUES
(158, 'Danh Má»¥c', 'danh-muc', 0),
(159, 'Khu Vá»±c', 'khu-vuc', 0),
(160, 'Äiá»‡n thoáº¡i', 'dien-thoai-danh-muc', 0),
(161, 'MÃ¡y tÃ­nh', 'may-tinh', 0),
(162, 'MÃ¡y tÃ­nh báº£ng', 'may-tinh-bang', 0),
(163, 'Xe honda', 'xe-honda', 0),
(164, 'Zendfone', 'zendfone', 0),
(165, 'Motorola', 'motorola', 0),
(166, 'TrÃ  Vinh', 'tra-vinh', 0),
(167, 'Cáº§n ThÆ¡', 'can-tho', 0),
(168, 'VÄ©nh Long', 'vinh-long', 0),
(169, 'Huyá»‡n Cáº§u KÃ¨', 'huyen-cau-ke', 0),
(170, 'Huyá»‡n TrÃ  CÃº', 'huyen-tra-cu', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
