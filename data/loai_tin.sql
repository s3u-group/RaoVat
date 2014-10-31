
CREATE TABLE IF NOT EXISTS `loai_tin` (
  `id_loai_tin` int(11) NOT NULL AUTO_INCREMENT,
  `ten_loai_tin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_loai_tin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
INSERT INTO `loai_tin` (`id_loai_tin`, `ten_loai_tin`) VALUES
(1, 'Can ban'),
(2, 'Can mua');
