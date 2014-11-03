CREATE TABLE IF NOT EXISTS `hinh_anh` (
  `id_hinh_anh` int(11) NOT NULL AUTO_INCREMENT,
  `id_tin` int(11) NOT NULL,
  `vi_tri` varchar(255) NOT NULL,
  `main` int(11) NOT NULL,
  PRIMARY KEY (`id_hinh_anh`),
  KEY `fk_hinh_anh_bang_tin` (`id_tin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;