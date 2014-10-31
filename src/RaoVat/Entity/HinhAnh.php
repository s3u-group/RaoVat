<?php
namespace RaoVat\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persisttence\ObjectManager;
/**
* @ORM\Entity
* @ORM\Table(name="hinh_anh")
*/
class HinhAnh
{
	/**
	* @ORM\Column(name="id_hinh_anh",type="integer", length=11)
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $idHinhAnh;


	/**
	* @ORM\JoinColumn(name="id_tin")
	* @ORM\ManyToOne(targetEntity="RaoVat\Entity\BangTin", inversedBy="HinhAnh")
	* @ORM\JoinColumn(name="id_tin", referencedColumnName="id_tin")
	*/
	private $idTin;


	/**
	* @ORM\Column(name="vi_tri")
	*/
	private $viTri;
		

	public function setIdHinhAnh($idHinhAnh)
	{
		$this->idHinhAnh=$idHinhAnh;
	}

	public function getIdHinhAnh()
	{
		return $this->idHinhAnh;
	}	

	public function setIdTin($idTin)
	{
		$this->idTin=$idTin;
	}

	public function getIdTin()
	{
		return $this->idTin;
	}

	public function setViTri($viTri)
	{
		$this->viTri=$viTri;
	}

	public function getViTri()
	{
		return $this->viTri;
	}
}

	?>