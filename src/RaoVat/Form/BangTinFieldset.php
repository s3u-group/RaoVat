<?php

namespace RaoVat\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

use Zend\Form\Element;
use Zend\Form\Form;

use RaoVat\Form\MucDoVipFieldset;
use RaoVat\Form\LoaiTinFieldset;
use RaoVat\Form\HinhAnhFieldset;
use S3UTaxonomy\Form\TermTaxonomyFieldset;

use RaoVat\Entity\BangTin;


class BangTinFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('bang-tin');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new BangTin());

         $this->add(array(
             'name' => 'idTin',
             'type' => 'Hidden',
         ));


         $this->add(array(
             'name' => 'tieuDe',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Tiêu đề',
             ),
             'attributes'=>array('required'=>'required'),
         ));


          $this->add(array(
             'name' => 'noiDung',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Nội dung',
             ),
             'attributes'=>array('required'=>'required'),
         ));

          $this->add(array(
             'name' => 'ngayDang',
             'type' =>'Date',
             'options' => array(
                 'label' => 'Ngày đăng',
             ),
             'attributes'=>array('required'=>'required'),
         ));

          $this->add(array(
             'name' => 'ngayKetThuc',
             'type'=>'Date',
             'options' => array(
                 'label' => 'Ngày kết thúc',
             ),
             'attributes'=>array('required'=>'required'),
         ));


          $this->add(array(
             'name' => 'idDanhMuc',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Chọn Danh mục',
                 'empty_option'=>'----------Chọn Danh Mục----------',
                 'disable_inarray_validator' => true,
             ),
         ));



          $this->add(array(
             'name' => 'idKhuVuc',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Chọn Khu vực',
                 'empty_option'=>'----------Chọn Khu Vực----------',
                 'disable_inarray_validator' => true,
             ),
         ));

       
         $this->add(array(
             'name' => 'idMucDoVip',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Chọn Mức độ vip',
                 'empty_option'=>'----------Chọn Mức độ vip----------',
                 'disable_inarray_validator' => true,
             ),
         ));

      
         $this->add(array(
             'name' => 'idLoaiTin',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Chọn Loại tin',
                 'empty_option'=>'----------Chọn Loại tin----------',
                 'disable_inarray_validator' => true,
             ),
         ));

         $this->add(array(
             'name' => 'gia',
             'type'=>'Number',
             'options' => array(
                 'label' => 'Giá',                 
             ),
             'attributes'=>array(
                'required'=>'required',
                'min'=>1000,                
             ),
         ));


         $hinhAnhFieldset = new HinhAnhFieldset($objectManager);
         $hinhAnhFieldset->setUseAsBaseFieldset(true);
         $hinhAnhFieldset->setName('hinhAnhs');
         $this->add($hinhAnhFieldset);
    }

    public function getInputFilterSpecification()
    {
        return array(
          
        );
    }
}