<?php
namespace RaoVat\Form;
use RaoVat\Entity\HinhAnh;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Element;

class HinhAnhFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('hinh-anh');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new HinhAnh());

         $this->add(array(
             'name' => 'idHinhAnh',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'idBangTin',
             'type' => 'Hidden',
         )); 
       
         // File Input
        $image = new Element\File('hinhAnhs');
        $image->setAttribute('id', 'hinhAnhs');
              ->setAttribute('multiple', true);   // That's it
        $this->add($image);       
    }

    public function getInputFilterSpecification()
    {
        return array(
          
        );
    }
}