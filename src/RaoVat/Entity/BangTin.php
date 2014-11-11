<?php
 namespace RaoVat\Entity;

 use Doctrine\Common\Collections\ArrayCollection;
 use Doctrine\Common\Collections\Collection;
 use Doctrine\Common\Persisttence\ObjectManager;
 use Doctrine\ORM\Mapping as ORM;

 use RaoVat\Entity\HinhAnh;

 /**
 * @ORM\Entity
 * @ORM\Table(name="tin")
 */
 class BangTin
 {
 	/**
	* @ORM\Column(name="id_tin",type="integer", length=11)
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $idTin;

	/**
	* @ORM\Column(name="tieu_de")
	*/
	private $tieuDe;
	
	/**
	* @ORM\Column(name="noi_dung")
	*/
	private $noiDung;

	/**
	* @ORM\Column(name="ngay_dang", type="date")
	*/
	private $ngayDang;

	/**
	* @ORM\Column(name="ngay_ket_thuc", type="date")
	*/
	private $ngayKetThuc;

	/**
	* @ORM\Column(name="ngay_tao", type="date")
	*/
	private $ngayTao;

	/**
	* @ORM\Column(name="ngay_cap_nhat", type="date")
	*/
	private $ngayCapNhat;

	/**
	* @ORM\ManyToOne(targetEntity="DanhMuc\Entity\SystemUser", cascade={"persist"})
    * @ORM\JoinColumn(name="id_user", referencedColumnName="user_id")
	*/
	private $idUser;

	/**
	* @ORM\ManyToOne(targetEntity="S3UTaxonomy\Entity\ZfTermTaxonomy")
	* @ORM\JoinColumn(name="id_danh_muc", referencedColumnName="term_taxonomy_id")
	*/
	private $idDanhMuc;

	/**
	* @ORM\ManyToOne(targetEntity="S3UTaxonomy\Entity\ZfTermTaxonomy")
	* @ORM\JoinColumn(name="id_khu_vuc", referencedColumnName="term_taxonomy_id")
	*/
	private $idKhuVuc;

	/**
	* @ORM\ManyToOne(targetEntity="RaoVat\Entity\MucDoVip")
	* @ORM\JoinColumn(name="id_muc_do_vip", referencedColumnName="id_muc_do_vip")
	*/
	private $idMucDoVip;

	/**
	* @ORM\ManyToOne(targetEntity="RaoVat\Entity\LoaiTin")
	* @ORM\JoinColumn(name="id_loai_tin", referencedColumnName="id_loai_tin")
	*/
	private $idLoaiTin;

	/**	
	* @ORM\OneToMany(targetEntity="RaoVat\Entity\HinhAnh", mappedBy="idTin")
	*/
	private $hinhAnhs;

	/**
	* @ORM\Column(type="float")
	*/
	private $gia;

	public function __construct()
	{
		$this->hinhAnhs=new ArrayCollection();
	}

	public function addHinhAnhs(Collection $hinhAnhs)
	{
		foreach ($hinhAnhs as $hinhAnh) {
			$this->hinhAnhs->add($hinhAnh);
		}
	}

	public function removeHinhAnhs(Collection $hinhAnhs)
	{
		foreach ($hinhAnhs as $hinhAnh) {
			$this->hinhAnhs->removeElement($hinhAnh);
		}
	}

	public function getHinhAnhs()
	{
		return $this->hinhAnhs->toArray();
	}

	public function setIdTin($idTin)
	{
		$this->idTin=$idTin;
	}
	public function getIdTin()
	{
		return $this->idTin;
	}

	public function setTieuDe($tieuDe)
	{
		$this->tieuDe=$tieuDe;
	}
	public function getTieuDe()
	{
		return $this->tieuDe;
	}

	public function setNoiDung($noiDung)
	{
		$this->noiDung=$noiDung;
	}
	public function getNoiDung()
	{
		return $this->noiDung;
	}

	public function setNgayDang($ngayDang)
	{
		$this->ngayDang=$ngayDang;
	}
	public function getNgayDang()
	{
		return $this->ngayDang;
	}

	public function setNgayKetThuc($ngayKetThuc)
	{
		$this->ngayKetThuc=$ngayKetThuc;
	}
	public function getNgayKetThuc()
	{
		return $this->ngayKetThuc;
	}

	public function setIdUser($idUser)
	{
		$this->idUser=$idUser;
	}
	public function getIdUser()
	{
		return $this->idUser;
	}

	public function setIdDanhMuc($idDanhMuc)
	{
		$this->idDanhMuc=$idDanhMuc;
	}
	public function getIdDanhMuc()
	{
		return $this->idDanhMuc;
	}

	public function setIdKhuVuc($idKhuVuc)
	{
		$this->idKhuVuc=$idKhuVuc;
	}
	public function getIdKhuVuc()
	{
		return $this->idKhuVuc;
	}

	public function setIdMucDoVip($idMucDoVip)
	{
		$this->idMucDoVip=$idMucDoVip;
	}
	public function getIdMucDoVip()
	{
		return $this->idMucDoVip;
	}

	public function setIdLoaiTin($idLoaiTin)
	{
		$this->idLoaiTin=$idLoaiTin;
	}
	public function getIdLoaiTin()
	{
		return $this->idLoaiTin;
	}

	public function setNgayTao($ngayTao)
	{
		$this->ngayTao=$ngayTao;
	}

	public function getNgayTao()
	{
		return $this->ngayTao;
	}

	public function setNgayCapNhat($ngayCapNhat)
	{
		$this->ngayCapNhat=$ngayCapNhat;
	}

	public function getNgayCapNhat()
	{
		return $this->ngayCapNhat;
	}
	public function setGia($gia)
	{
		$this->gia=$gia;
	}
	public function getGia()
	{
		return $this->gia;
	}
 }
 ?>
