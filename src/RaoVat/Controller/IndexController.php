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
    if(!$this->zfcUserAuthentication()->hasIdentity())
    {
      return $this->redirect()->toRoute('zfcuser');
    }

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
      //kiểm tra nếu có đăng nhập   
        if ($this->zfcUserAuthentication()->hasIdentity()) {
          //get the user_id of the user
          $idUser=$this->zfcUserAuthentication()->getIdentity()->getId();
        }        
        $bangTin->setIdUser($idUser);
        //die(var_dump($bangTin));
        $entityManager->persist($bangTin);
        $entityManager->flush();
        $repository = $entityManager->getRepository('RaoVat\Entity\BangTin');
        $queryBuilder = $repository->createQueryBuilder('bt');
        $queryBuilder->add('where','bt.tieuDe =\''.$post['bang-tin']['tieuDe'].'\''.' and bt.noiDung =\''.$post['bang-tin']['noiDung'].'\'');
        $query = $queryBuilder->getQuery(); 
        $bT = $query->execute();  // lấy bảng tin
        $idTin=$bT[0];
        //die(var_dump($post['bang-tin']['hinhAnhs']['hinhAnhs'][0]['error']));
        if($post['bang-tin']['hinhAnhs']['hinhAnhs'][0]['error']==0)
        {
          $coAnhDaiDien=0;// khi thêm thì mặc định ảnh số một sẽ là ảnh đại diện. 
          foreach ($post['bang-tin']['hinhAnhs']['hinhAnhs'] as $p) {
             $uniqueToken=md5(uniqid(mt_rand(),true));
             $newName=$uniqueToken.'_'.$p['name'];
             $arrayImage[]=$newName;
             $filter = new \Zend\Filter\File\Rename("./public/img/".$newName);
             $filter->filter($p);

             $hinhAnh=new HinhAnh();       
             $hinhAnh->setViTri($newName);
             $hinhAnh->setIdTin($idTin);
             $coAnhDaiDien++;
             if($coAnhDaiDien==1)
             {  
              $hinhAnh->setMain(1);
             }
             
             $entityManager->persist($hinhAnh);
             $entityManager->flush();
          }
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

  // sửa một tin đăng
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
     $request = $this->getRequest();
     if ($this->request->isPost()) {
          $post = array_merge_recursive(
              $request->getPost()->toArray(),
              $request->getFiles()->toArray()
          );

         $form->setData($this->request->getPost());
         if ($form->isValid()) {
           $entityManager->flush();
           if($post['bang-tin']['hinhAnhs']['hinhAnhs'][0]['error']==0)
           {
             $coAnhDaiDien=0;

             $repository = $entityManager->getRepository('RaoVat\Entity\HinhAnh');
             $queryBuilder = $repository->createQueryBuilder('hA');
             $queryBuilder->add('where','hA.main=1 and hA.idTin='.$bangTin->getIdTin());
             $query = $queryBuilder->getQuery();
             $anhDaiDien = $query->execute();
             foreach ($post['bang-tin']['hinhAnhs']['hinhAnhs'] as $p) 
             {

               $uniqueToken=md5(uniqid(mt_rand(),true));
               $newName=$uniqueToken.'_'.$p['name'];
               $arrayImage[]=$newName;
               $filter = new \Zend\Filter\File\Rename("./public/img/".$newName);
               $filter->filter($p);
      
               $hinhAnh=new HinhAnh();       
               $hinhAnh->setViTri($newName);
               $hinhAnh->setIdTin($bangTin);
               $coAnhDaiDien++;
               if(!$anhDaiDien&&$coAnhDaiDien==1)
               {
                   $hinhAnh->setMain(1);
               }
               
               $entityManager->persist($hinhAnh);
               $entityManager->flush();
               
             }
           }
         }
         else
         {
           die(var_dump($form->getMessages()));
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

  public function editAnhDaiDienAction()
  {
     $id = (int) $this->params()->fromRoute('id', 0);
     if (!$id) {
         return $this->redirect()->toRoute('rao_vat');
     }  
     $entityManager=$this->getEntityManager();
     $hinhAnh= $entityManager->getRepository('RaoVat\Entity\HinhAnh')->find($id);
     if(!$hinhAnh)
     {
        return $this->redirect()->toRoute('rao_vat');
     }

     $repository = $entityManager->getRepository('RaoVat\Entity\HinhAnh');
     $queryBuilder = $repository->createQueryBuilder('hA');
     $queryBuilder->add('where','hA.idTin='.$hinhAnh->getIdTin()->getIdTin());
     $query = $queryBuilder->getQuery();
     $hinhAnhs = $query->execute();
     if($hinhAnhs)
     {
       foreach($hinhAnhs as $hA)
       {
         $hA->setMain(0);
         $entityManager->flush();

       }
     }

     $hinhAnh->setMain(1);
     $entityManager->flush();
     return $this->redirect()->toRoute('rao_vat/crud',array('action'=>'edit','id'=>$hinhAnh->getIdTin()->getIdTin()));
     
  }

  // xóa một tin đăng
 	public function deleteAction()
 	{
     $id = (int) $this->params()->fromRoute('id', 0);
     if (!$id) {
         return $this->redirect()->toRoute('rao_vat');
     }       
     
     $entityManager=$this->getEntityManager();
     $bangTin= $entityManager->getRepository('RaoVat\Entity\BangTin')->find($id);
     if(!$bangTin)
     {
        return $this->redirect()->toRoute('rao_vat');
     }
            
     $repository = $entityManager->getRepository('RaoVat\Entity\HinhAnh');
     $queryBuilder = $repository->createQueryBuilder('hA');
     $queryBuilder->add('where','hA.idTin='.$bangTin->getIdTin());
     $query = $queryBuilder->getQuery();
     $hinhAnhs = $query->execute();

     if($hinhAnhs)
     {
       foreach ($hinhAnhs as $hinhAnh) {
         // mọi người chỉnh lại đường dẫn tới bức hình lưu trong máy nhé!
         $mask =__ROOT_PATH__.'/public/img/'.$hinhAnh->getViTri();
         array_map( "unlink", glob( $mask ) );
         
         $entityManager->remove($hinhAnh);
         $entityManager->flush();  
       }
     }      

     $entityManager->remove($bangTin);
     $entityManager->flush();       

     

     return $this->redirect()->toRoute('rao_vat');
   }

   // xóa hình ảnh trong một tin đăng 
   public function deleteImageAction()
  {
     $id = (int) $this->params()->fromRoute('id', 0);
     if (!$id) {
         return $this->redirect()->toRoute('rao_vat');
     }  
     $entityManager=$this->getEntityManager();
     $hinhAnh= $entityManager->getRepository('RaoVat\Entity\HinhAnh')->find($id);
     $idTin=$hinhAnh;
     if(!$idTin)
     {
        return $this->redirect()->toRoute('rao_vat');
     }

     // KHAI BÁO ROOT_PATH TRONG FILE INDEX.PHP TRONG THƯ MỤC PUBLIC (ZEND/PUCBLIC/INDEX) NHƯ SAU:
     // define('ROOT_PATH', dirname(__DIR__));
     $mask =__ROOT_PATH__.'/public/img/'.$hinhAnh->getViTri();
     array_map( "unlink", glob( $mask ) );   
     $entityManager->remove($hinhAnh);
     $entityManager->flush();  
     if($idTin->getMain()==1)
     {
       $repository = $entityManager->getRepository('RaoVat\Entity\HinhAnh');
       $queryBuilder = $repository->createQueryBuilder('hA');
       $queryBuilder->add('where','hA.idTin='.$idTin->getIdTin()->getIdTin());
       $query = $queryBuilder->getQuery();
       $hinhAnhs = $query->execute();
       if($hinhAnhs)
       {
        $hinhAnhs[0]->setMain(1);
        $entityManager->flush();  

       }
     }
     return $this->redirect()->toRoute('rao_vat/crud',array('action'=>'edit','id'=>$idTin->getIdTin()->getIdTin()));

  }

 }
?>