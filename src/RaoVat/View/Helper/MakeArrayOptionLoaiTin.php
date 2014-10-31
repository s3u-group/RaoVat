<?php
namespace RaoVat\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MakeArrayOptionLoaiTin extends AbstractHelper{
	public function __invoke($objects){
		$dm=array();
		if(!$objects)
		{
			return $dm;
		}
		foreach ($objects as $object) 
		{
			
				$dm[$object->getIdLoaiTin()]=$object->getTenLoaiTin();
		}	
		return $dm;
	}
}
?>