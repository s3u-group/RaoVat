<?php
namespace RaoVat\Form;
use RaoVat\Entity\LoaiTin;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class LoaiTinFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('loai-tin');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new LoaiTin());

         $this->add(array(
             'name' => 'idLoaiTin',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'tenLoaiTin',
             'type' => 'Text',
             'attributes'=>array('required'=>'required'),
         ));          
    }

    public function getInputFilterSpecification()
    {
        return array(
          
        );
    }
}