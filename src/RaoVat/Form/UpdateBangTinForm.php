<?php
namespace RaoVat\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class UpdateBangTinForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('update-bang-tin-form');

        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $bangTinFieldset = new BangTinFieldset($objectManager);
        $bangTinFieldset->setUseAsBaseFieldset(true);
        $this->add($bangTinFieldset);

        // … add CSRF and submit elements …

        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Sửa',
                 'id' => 'submit',
             ),
         ));    

        // Optionally set your validation group here
    }
}
?>