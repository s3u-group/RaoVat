CREATE TABLE IF NOT EXISTS `tin` (
  `id_tin` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `ngay_dang` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `id_danh_muc` bigint(20) NOT NULL,
  `id_khu_vuc` bigint(20) NOT NULL,
  `id_muc_do_vip` int(11) NOT NULL,
  `id_loai_tin` int(11) NOT NULL,
  PRIMARY KEY (`id_tin`),
  KEY `fk_id_user` (`id_user`),
  KEY `fk_tin_loai_tin` (`id_loai_tin`),
  KEY `fk_tin_muc_do_vip` (`id_muc_do_vip`),
  KEY `fk_tin_zf_term_taxonomy` (`id_danh_muc`),
  KEY `fk_tin_zf_term_taxonomy_khu_vuc` (`id_khu_vuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `loai_tin` (
  `id_loai_tin` int(11) NOT NULL AUTO_INCREMENT,
  `ten_loai_tin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_loai_tin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `muc_do_vip` (
  `id_muc_do_vip` int(11) NOT NULL AUTO_INCREMENT,
  `ten_muc_do_vip` varchar(255) NOT NULL,
  PRIMARY KEY (`id_muc_do_vip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hinh_anh` (
  `id_hinh_anh` int(11) NOT NULL AUTO_INCREMENT,
  `id_tin` int(11) NOT NULL,
  `vi_tri` varchar(255) NOT NULL,
  PRIMARY KEY (`id_hinh_anh`),
  KEY `fk_hinh_anh_bang_tin` (`id_tin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hinh_anh`
  ADD CONSTRAINT `fk_hinh_anh_bang_tin` FOREIGN KEY (`id_tin`) REFERENCES `tin` (`id_tin`);