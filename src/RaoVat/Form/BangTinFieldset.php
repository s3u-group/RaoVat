<?php

namespace RaoVat\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;


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
             'type' => 'Element\Textarea',
             'options' => array(
                 'label' => 'Nội dung',
             ),
             'attributes'=>array('required'=>'required'),
         ));

          $this->add(array(
             'name' => 'ngayDang',
             'type' 'Elemeent\Date',
             'options' => array(
                 'label' => 'Ngày đăng',
             ),
             'attributes'=>array('required'=>'required'),
         ));

          $this->add(array(
             'name' => 'ngayKetThuc',
             'type' 'Elemeent\Date',
             'options' => array(
                 'label' => 'Ngày kết thúc',
             ),
             'attributes'=>array('required'=>'required'),
         ));

         $userFieldset = new UserFieldset($objectManager);
         $userFieldset->setUseAsBaseFieldset(true);
         $userFieldset->setName('idUser');
         $this->add($userFieldset);


         $idDanhMuc = new TermTaxonomyFieldset($objectManager);
         $idDanhMuc->setUseAsBaseFieldset(true);
         $idDanhMuc->setName('idDanhMuc');
         $this->add($idDanhMuc);

         $idKhuVuc = new TermTaxonomyFieldset($objectManager);
         $idKhuVuc->setUseAsBaseFieldset(true);
         $idKhuVuc->setName('idKhuVuc');
         $this->add($idKhuVuc);

         $idMucDoVip = new MucDoVipFieldset($objectManager);
         $idMucDoVip->setUseAsBaseFieldset(true);
         $idMucDoVip->setName('idMucDoVip');
         $this->add($idMucDoVip);

         $idLoaiTin = new LoaiTinFieldset($objectManager);
         $idLoaiTin->setUseAsBaseFieldset(true);
         $idLoaiTin->setName('idLoaiTin');
         $this->add($idLoaiTin);

        

        $hinhAnh = new HinhAnhFieldset($objectManager);
        $this->add(array(
            'type'    => 'Zend\Form\Element\Collection',
            'name'    => 'hinhAnhs',
            'options' => array(
                'count'           => 1,
                'target_element' => $hinhAnh,
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true
            ),
        );
    }
}