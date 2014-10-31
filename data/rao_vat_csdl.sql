CREATE TABLE IF NOT EXISTS `tin` (
  `id_tin` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `ngay_dang` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `id_user` int(10) unsigned DEFAULT NULL,
  `id_danh_muc` bigint(20) DEFAULT NULL,
  `id_khu_vuc` bigint(20) DEFAULT NULL,
  `id_muc_do_vip` int(11) DEFAULT NULL,
  `id_loai_tin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tin`),
  KEY `fk_id_user` (`id_user`),
  KEY `fk_tin_loai_tin` (`id_loai_tin`),
  KEY `fk_tin_muc_do_vip` (`id_muc_do_vip`),
  KEY `fk_tin_zf_term_taxonomy` (`id_danh_muc`),
  KEY `fk_tin_zf_term_taxonomy_khu_vuc` (`id_khu_vuc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `tin` (`id_tin`, `tieu_de`, `noi_dung`, `ngay_dang`, `ngay_ket_thuc`, `id_user`, `id_danh_muc`, `id_khu_vuc`, `id_muc_do_vip`, `id_loai_tin`) VALUES
(2, 'A', 'Noi dung A', '2014-10-30', '2014-11-30', 1, 2, 3, 1, 1),
(3, 'B', 'Noi dung B', '2014-10-31', '2014-11-30', 2, 2, 2, 2, 2),
(4, 'C', 'Noi dung C', '2014-10-30', '2014-11-30', 1, 1, 1, 2, 2),
(5, 'D', 'Noi dung D', '2014-10-31', '2014-11-30', 1, 1, 3, 2, 2);

CREATE TABLE IF NOT EXISTS `muc_do_vip` (
  `id_muc_do_vip` int(11) NOT NULL AUTO_INCREMENT,
  `ten_muc_do_vip` varchar(255) NOT NULL,
  PRIMARY KEY (`id_muc_do_vip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `muc_do_vip` (`id_muc_do_vip`, `ten_muc_do_vip`) VALUES
(1, 'Vip'),
(2, 'Thuong');

CREATE TABLE IF NOT EXISTS `loai_tin` (
  `id_loai_tin` int(11) NOT NULL AUTO_INCREMENT,
  `ten_loai_tin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_loai_tin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `loai_tin` (`id_loai_tin`, `ten_loai_tin`) VALUES
(1, 'Can Ban'),
(2, 'Can Mua');
