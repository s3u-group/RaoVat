<?php namespace RaoVat\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
 use Zend\ServiceManager\ServiceManager;
 use RaoVat\Entity\BangTin;
 use RaoVat\Form\CreateBangTinForm;
 
 use RaoVat\Entity\MucDoVip;
 use RaoVat\Entity\LoaiTin;
 use RaoVat\Entity\HinhAnh;


 use RaoVat\Form\UpdateBangTinForm;
 use S3UTaxonomy\Form\CreateTermTaxonomyForm;
 
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

    $taxonomyDanhMuc=$this->TaxonomyFunction();
    $danhMucs=$taxonomyDanhMuc->getListChildTaxonomy('danh-muc');// đưa vào taxonomy dạng slug
    
    $taxonomyKhuVuc=$this->TaxonomyFunction();
    $khuVucs=$taxonomyKhuVuc->getListChildTaxonomy('khu-vuc');// đưa vào taxonomy dạng slug

    $repository = $entityManager->getRepository('RaoVat\Entity\MucDoVip');
    $queryBuilder = $repository->createQueryBuilder('mdv');
    $query = $queryBuilder->getQuery();
    $mucDoVips = $query->execute();

    $repository = $entityManager->getRepository('RaoVat\Entity\LoaiTin');
    $queryBuilder = $repository->createQueryBuilder('lt');
    $query = $queryBuilder->getQuery();
    $loaiTins = $query->execute();

    
    $request = $this->getRequest();
    if ($request->isPost())
    { 
      $form->setData($request->getPost());
      
      // Make certain to merge the files info!
      $post = array_merge_recursive(
          $request->getPost()->toArray(),
          $request->getFiles()->toArray()
      );
      $form->setData($post);
      if ($form->isValid()) {
        /*//die(var_dump($form->getData()->getHinhAnhs()['0']));
        $data = $form->getData()->getHinhAnhs(); 
        //die(var_dump(count($data)));
        //$hinhAnhs=array();
        for($i=0; $i<count($data); $i++)
        {
          $hinhAnh=new hinhAnh();
          $hinhAnh=$data[$i];
          //$hinhAnh->setViTri('hot.jpg');
          $entityManager->persist($hinhAnh);
          $entityManager->flush();
          //$hinhAnhs[]=$hinhAnh;
          //$data[$i]->setViTri('hot.jgp');
        }
        //$bangTin->addHinhAnhs($data);
        die(var_dump($bangTin));*/
        $entityManager->persist($bangTin);
        $entityManager->flush();
        die(var_dump($form->getData()->getHinhAnhs()));
        
      }
      else
      {
        die(var_dump($form->getMessages()));
      }
    }

    return array(
      'form' => $form, 
      'danhMucs'=>$danhMucs,
      'khuVucs'=>$khuVucs, 
      'mucDoVips'=> $mucDoVips,
      'loaiTins'=>$loaiTins,
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

     $idDanhMuc=(int)$bangTin->getIdDanhMuc();
     var_dump($idDanhMuc);
          
     $danhMuc1=$entityManager->getRepository('S3UTaxonomy\Entity\ZfTermTaxonomy')->find($idDanhMuc);    
     
     $danhMuc=$entityManager->getRepository('S3UTaxonomy\Entity\ZfTerm')->find($danhMuc1->getTermId()->getTermId());
     //var_dump($formDanhMuc);
     die(var_dump($danhMuc));
     if ($this->request->isPost())
     {      
       $form->setData($this->request->getPost());
       if ($form->isValid()) {
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