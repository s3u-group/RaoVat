<?php
 namespace RaoVat\Entity;

 use Doctrine\Common\Collections\ArrayCollection;
 use Doctrine\Common\Collections\Collection;
 
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
	* @ORM\Column(name="id_user")
	* @ORM\ManyToOne(targetEntity="DanhMuc\Entity\SystemUser",cascade={"persist"})
	*/
	private $idUser=1; //mai mot sua

	/**
	* @ORM\Column(name="id_danh_muc")
	* @ORM\ManyToOne(targetEntity="S3UTaxonomy\Entity\ZfTermTaxonomy",cascade={"persist"})
	*/
	private $idDanhMuc;

	/**
	* @ORM\Column(name="id_khu_vuc")
	* @ORM\ManyToOne(targetEntity="S3UTaxonomy\Entity\ZfTermTaxonomy",cascade={"persist"})
	*/
	private $idKhuVuc;

	/**
	* @ORM\Column(name="id_muc_do_vip")
	* @ORM\ManyToOne(targetEntity="RaoVat\Entity\MucDoVip",cascade={"persist"})
	*/
	private $idMucDoVip;

	/**
	* @ORM\Column(name="id_loai_tin")
	* @ORM\ManyToOne(targetEntity="RaoVat\Entity\LoaiTin",cascade={"persist"})
	*/
	private $idLoaiTin;

	/**	
	* @ORM\OneToMany(targetEntity="RaoVat\Entity\HinhAnh", mappedBy="idTin",cascade={"persist"})
	*/
	private $hinhAnhs;

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
		return $this->hinhAnhs;
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
 }
 ?>
