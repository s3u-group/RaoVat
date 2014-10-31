<?php
namespace RaoVat\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MakeArrayOptionMucDoVip extends AbstractHelper{
	public function __invoke($objects){
		$dm=array();
		if(!$objects)
		{
			return $dm;
		}
		foreach ($objects as $object) 
		{
			
			$dm[$object->getIdMucDoVip()]=$object->getTenMucDoVip();
			
		}	
		return $dm;
	}
}
?>