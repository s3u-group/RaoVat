<?php namespace RaoVat\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
 use Zend\ServiceManager\ServiceManager;

 use RaoVat\Entity\BangTin;
 use RaoVat\Form\CreateBangTinForm;
 
 class IndexController extends AbstractActionController
 {
 	private $entityManager;

  public function getEntityManager()
  {
     if(!$this->entityManager)
     {
       $this->entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
     }
     return $this->entityManager;
  }
  
 	public function indexAction()
 	{


 	}

  

 	public function addAction()
 	{
    $entityManager=$this->getEntityManager();
    $bangTin=new BangTin();
    $form= new CreateBangTinForm($entityManager);
    $form->bind($bangTin);
    $request = $this->getRequest();
    if ($request->isPost())
    { 
      $form->setData($request->getPost());
      if ($form->isValid()) {
      }
    }

    return array(
      'form' => $form,   
    );
 	}

 	public function editAction()
 	{   
 	}

 	public function deleteAction()
 	{        
  }
 }
?>