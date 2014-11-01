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

    $mucDoVips = $entityManager->getRepository('RaoVat\Entity\MucDoVip')->findAll();
     
    $loaiTins = $entityManager->getRepository('RaoVat\Entity\LoaiTin')->findAll();

    
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

        $entityManager->persist($bangTin);
        $entityManager->flush();

        $repository = $entityManager->getRepository('RaoVat\Entity\BangTin');
        $queryBuilder = $repository->createQueryBuilder('bt');
        $queryBuilder->add('where','bt.tieuDe =\''.$post['bang-tin']['tieuDe'].'\'');
        $query = $queryBuilder->getQuery(); 
        $bT = $query->execute();  // lấy bảng tin
        $idTin=$bT[0];

        foreach ($post['bang-tin']['hinhAnhs']['hinhAnhs'] as $p) {
           $uniqueToken=md5(uniqid(mt_rand(),true));
           $newName=$uniqueToken.'_'.$p['name'];
           $arrayImage[]=$newName;
           $filter = new \Zend\Filter\File\Rename("./public/img/BangTin/".$newName);
           $filter->filter($p);

           $hinhAnh=new HinhAnh();       
           $hinhAnh->setViTri($newName);
           $hinhAnh->setIdTin($idTin);
           //$entityManager->remove($bangTin);
           $entityManager->persist($hinhAnh);
           $entityManager->flush();
        }
        return $this->redirect()->toRoute('rao_vat');
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

    
     $repository = $entityManager->getRepository('RaoVat\Entity\HinhAnh');
     $queryBuilder = $repository->createQueryBuilder('hA');
     $queryBuilder->add('where','hA.idTin='.$bangTin->getIdTin());
     $query = $queryBuilder->getQuery();
     $hinhAnhs = $query->execute();

     $taxonomyDanhMuc=$this->TaxonomyFunction();
     $danhMucs=$taxonomyDanhMuc->getListChildTaxonomy('danh-muc');// đưa vào taxonomy dạng slug
    
     $taxonomyKhuVuc=$this->TaxonomyFunction();
     $khuVucs=$taxonomyKhuVuc->getListChildTaxonomy('khu-vuc');// đưa vào taxonomy dạng slug

     $mucDoVips = $entityManager->getRepository('RaoVat\Entity\MucDoVip')->findAll();

     $loaiTins = $entityManager->getRepository('RaoVat\Entity\LoaiTin')->findAll();
     
     if ($this->request->isPost()) {
         $form->setData($this->request->getPost());
         if ($form->isValid()) {
         }
      }
     return array(
        'form' => $form,
        'id'=>$id, 
        'danhMucs'=>$danhMucs,
        'khuVucs'=>$khuVucs, 
        'mucDoVips'=> $mucDoVips,
        'loaiTins'=>$loaiTins,    
        'hinhAnhs'=>$hinhAnhs,
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