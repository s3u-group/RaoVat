<?php
namespace RaoVat\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persisttence\ObjectManager;
/**
* @ORM\Entity
* @ORM\Table(name="loai_tin")
*/
class LoaiTin
{
	/**
	* @ORM\Column(name="id_loai_tin",type="integer",length=11)
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $idLoaiTin;


	/**
	* @ORM\Column(name="ten_loai_tin")
	*/
	private $tenLoaiTin;



	public function setIdLoaiTin($idLoaiTin)
	{
		$this->idLoaiTin=$idLoaiTin;
	}

	public function getIdLoaiTin()
	{
		return $this->idLoaiTin;
	}

	public function setTenLoaiTin($tenLoaiTin)
	{
		$this->tenLoaiTin=$tenLoaiTin;
	}

	public function getTenLoaiTin()
	{
		return $this->tenLoaiTin;
	}
}
	?>