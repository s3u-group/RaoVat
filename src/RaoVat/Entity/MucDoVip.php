<?php
 namespace RaoVat\Entity;

 use Doctrine\ORM\Mapping as ORM;
 use Doctrine\Common\Collection\ArrayCollection;
 use Doctrine\Common\Collection\Collection;

 /**
 * @ORM\Entity
 * @ORM\Table(name="muc_do_vip")
 */
 class BangTin
 {
 	/**
	* @ORM\Column(name="id_muc_do_vip",type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $idMucDoVip;

	/**
	* @ORM\Column(name="ten_muc_do")
	*/
	private $tenMucDo;

	public function setIdMucDoVip($idMucDoVip)
	{
		$this->idMucDoVip=$idMucDoVip;
	}
	public function getIdMucDoVip()
	{
		return $this->idMucDoVip;
	}
	
 }
 ?>