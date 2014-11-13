<?php
namespace RaoVat\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ChangeArrayFromObjectTermTaxonomy extends AbstractHelper{

	private $entityManager; 
    
	public function getEntityManager()
    {       
        return $this->entityManager;
    }
	
	public function setEntityManager($entityManager)
	{
		$this->entityManager=$entityManager;
	}

	 // hàm lấy cấp của taxonomy
    private $level=0;
    private $mangTam=array();
    public function viewHelperOutputTree($tree, $root = null) {          
        foreach($tree as $i=>$child) {           
            $parent = $child->getParent();
            if($parent == $root) {
                unset($tree[$i]);
                $child->setCap($this->level);           
                $this->mangTam[]=$child;                
                $this->level++;
                $this->viewHelperOutputTree($tree, $child->getTermTaxonomyId());
                $this->level--;
            } 
            
        }
        return $this->mangTam;
 
    }

	public function viewHelperGetListChildTaxonomy($taxonomy)
    {
        
        $entityManager=$this->getEntityManager();

        $repository = $entityManager->getRepository('S3UTaxonomy\Entity\ZfTermTaxonomy');
        $queryBuilder = $repository->createQueryBuilder('tt');
        $queryBuilder->add('where','tt.taxonomy=\''.$taxonomy.'\'');
        $query = $queryBuilder->getQuery();
        $zfTermTaxonomys = $query->execute(); 
        if(!$zfTermTaxonomys)
        {
            return $zfTermTaxonomys;
        }
        
        $zfTermTaxonomys=$this->viewHelperOutputTree($zfTermTaxonomys, $root = null); 
       
        return $zfTermTaxonomys;
    }
	
	public function __invoke($slug){
		$entityManager=$this->getEntityManager();

		$mang=$this->viewHelperGetListChildTaxonomy($slug);

		$array = array();		
		foreach($mang as $item){
			$array[$item->getTermTaxonomyId()] = $item->getTermId()->getName(); 
		}
		return $array;
	}
}
?>