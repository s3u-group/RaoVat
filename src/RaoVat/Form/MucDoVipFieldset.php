<?php
namespace RaoVat\Form;
use RaoVat\Entity\MucDoVip;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class MucDoVipFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('muc-do-vip');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new MucDoVip());

         $this->add(array(
             'name' => 'idMucDoVip',
             'type' => 'Hidden',
         ));
         /*$this->add(array(
             'name' => 'tenMucDoVip',
             'type' => '',
         )); */         
    }

    public function getInputFilterSpecification()
    {
    }
}