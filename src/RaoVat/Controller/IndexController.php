<?php namespace RaoVat\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
 use Zend\ServiceManager\ServiceManager;
 use RaoVat\Entity\BangTin;
 use RaoVat\Form\CreateBangTinForm;
 use RaoVat\Form\UpdateBangTinForm;
 
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
    $entityManager=$this->getEntityManager();

    $bangTins=$entityManager->getRepository('RaoVat\Entity\BangTin')->findAll();

    return array('bangTins'=>$bangTins);
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
     $entityManager=$this->getEntityManager();

     $id = (int) $this->params()->fromRoute('id', 0);
     if (!$id) {
         return $this->redirect()->toRoute('rao_vat', array(
             'action' => 'add'
         ));
     }
     $form= new UpdateBangTinForm($entityManager);         
     $bangTin = $entityManager->getRepository('RaoVat\Entity\BangTin')->find($id);
     $form->bind($bangTin);
     //die(var_dump($form));
     //$request = $this->getRequest();
     if ($this->request->isPost())
     {
      //var_dump($request->isPost());     
       $form->setData($this->request->getPost());
       if ($form->isValid()) {
        //die(var_dump($form));
       }
     }

     return array(
        'form' => $form,
        'id'=>$id,          
     );
 	}

 	public function deleteAction()
 	{
     $id = (int) $this->params()->fromRoute('id', 0);
     if (!$id) {
         return $this->redirect()->toRoute('rao_vat');
     }       
     
     $entityManager=$this->getEntityManager();
     $bangTin= $entityManager->getRepository('RaoVat\Entity\BangTin')->find($id);
     $form=new CreateBangTinForm($entityManager);

     if(!$bangTin)
     {
        return $this->redirect()->toRoute('rao_vat');
     }
            
     $entityManager->remove($bangTin);
     $entityManager->flush();       

     return $this->redirect()->toRoute('rao_vat');
   }
 }
?>