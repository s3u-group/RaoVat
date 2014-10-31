
CREATE TABLE IF NOT EXISTS `muc_do_vip` (
  `id_muc_do_vip` int(11) NOT NULL AUTO_INCREMENT,
  `ten_muc_do_vip` varchar(255) NOT NULL,
  PRIMARY KEY (`id_muc_do_vip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `muc_do_vip` (`id_muc_do_vip`, `ten_muc_do_vip`) VALUES
(1, 'Vip'),
(2, 'Thuong');