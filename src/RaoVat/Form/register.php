

<?php
namespace RaoVat\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use RaoVat\Form\BangTinFieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;


class RegisterForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('dang-ky');
        
        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $dangKyFieldset = new DangKyFieldset($objectManager);
        $dangKyFieldset->setUseAsBaseFieldset(true);
        $this->add($dangKyFieldset);

        // … add CSRF and submit elements …

        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));    

        // Optionally set your validation group here
    }
        
}
?>