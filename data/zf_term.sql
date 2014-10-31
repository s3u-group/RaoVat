
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
(160, 'Äiá»‡n thoáº¡i', 'dien-thoai', 0),
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

--ALTER TABLE `zf_term_taxonomy`
  --ADD CONSTRAINT `zf_term_taxonomy_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `zf_term` (`term_id`),
  --ADD CONSTRAINT `zf_term_taxonomy_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `zf_term_taxonomy` (`term_taxonomy_id`);


