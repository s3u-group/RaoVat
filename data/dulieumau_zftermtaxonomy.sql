-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2014 at 08:15 AM
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
-- Table structure for table `zf_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `zf_term_taxonomy` (
  `term_taxonomy_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) NOT NULL,
  `taxonomy` varchar(200) NOT NULL,
  `description` longtext,
  `parent` bigint(20) DEFAULT NULL,
  `count` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`term_taxonomy_id`),
  KEY `term_id` (`term_id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `zf_term_taxonomy`
--

INSERT INTO `zf_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(19, 158, 'danh-muc', 'Taxonomy', NULL, NULL),
(20, 159, 'khu-vuc', 'Taxonomy', NULL, NULL),
(21, 160, 'danh-muc', 'Äiá»‡n thoáº¡i', 19, NULL),
(22, 161, 'danh-muc', 'MÃ¡y tÃ­nh', 19, NULL),
(23, 162, 'danh-muc', 'MÃ¡y tÃ­nh báº£ng', 19, NULL),
(24, 163, 'danh-muc', 'Xe honda', 19, NULL),
(25, 164, 'danh-muc', 'Äiá»‡n thoáº¡i Zendfone cá»§a Azus', 21, NULL),
(26, 165, 'danh-muc', 'Äiá»‡n thoáº¡i Motorola, Ram 3G, Chip 8 nhÃ¢n, Tá»‘c Ä‘á»™ 1.6 GHz', 21, NULL),
(27, 166, 'khu-vuc', 'Tá»‰nh TrÃ  Vinh', 20, NULL),
(28, 167, 'khu-vuc', 'TP. Cáº§n ThÆ¡', 20, NULL),
(29, 168, 'khu-vuc', 'TP. VÄ©nh Long', 20, NULL),
(30, 169, 'khu-vuc', 'Huyá»‡n Cáº§u KÃ¨, LÃ  má»™t Huyá»‡n thuá»™c Tá»‰nh TrÃ  Vinh', 27, NULL),
(31, 170, 'khu-vuc', 'Huyá»‡n TrÃ  CÃº, LÃ  má»™t Huyá»‡n thuá»™c Tá»‰nh TrÃ  Vinh', 27, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zf_term_taxonomy`
--
ALTER TABLE `zf_term_taxonomy`
  ADD CONSTRAINT `zf_term_taxonomy_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `zf_term` (`term_id`),
  ADD CONSTRAINT `zf_term_taxonomy_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `zf_term_taxonomy` (`term_taxonomy_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
