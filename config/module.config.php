<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'RaoVat\Controller\Index' => 'RaoVat\Controller\IndexController',            
		),
	),
    'router' => array(
        'routes' => array(           
            'rao_vat' => array(
                'type'    => 'literal', 
                'options' => array(
                    'route'    => '/rao-vat',                     
                    'defaults' => array(
                       '__NAMESPACE__'=>'RaoVat\Controller',
                        'controller' => 'Index',
                        'action'     => 'xemTin',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                    
                    'crud' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/][:action][/:id]',
                            'constraints' => array(                            
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),                            
                        ),
                    ),            
                ),
             ),
         ),
     ), 


	'view_manager' => array(
		'template_path_stack' => array(
			'rao_vat' => __DIR__ . '/../view',         
		),
        'template_map'=>array(
            'layout/giaodien'        => __DIR__ . '/../view/layout/giao-dien.phtml',
        ),
	),   


	'doctrine' => array(
        'driver' => array(
            'rao_vat_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/RaoVat/Entity',//Edit
                ),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'RaoVat\Entity' => 'rao_vat_annotation_driver'//Edit
                )
            )
        )
    ),

    'view_helpers'=>array(
        'invokables'=>array(
            'make_array_option_taxonomy'=>'RaoVat\View\Helper\MakeArrayOptionTaxonomy',  
            'make_array_option_muc_do_vip'=>'RaoVat\View\Helper\MakeArrayOptionMucDoVip',  
            'make_array_option_loai_tin'=>'RaoVat\View\Helper\MakeArrayOptionLoaiTin',
            //'change_array_from_object_term_taxonomy'=> 'RaoVat\View\Helper\ChangeArrayFromObjectTermTaxonomy',  

        ),

        'factories'=>array(
            'change_array_from_object_term_taxonomy' => function($sm){
                $entityManager=$sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $doctrineRaoVatHelper=new \RaoVat\View\Helper\ChangeArrayFromObjectTermTaxonomy();
                $doctrineRaoVatHelper->setEntityManager($entityManager);
                return $doctrineRaoVatHelper;
            },
        ),
    ),

    /*'bjyauthorize'=>array(

        'guards'=>array(
            'BjyAuthorize\Guard\Controller'=>array(
                
                array(
                    'controller'=>array('zfcuser'),                   
                    'roles'     =>array(),
                ),

                array(
                    'controller'=>array('RaoVat\Controller\Index'),
                    'action'    =>array('index'),
                    'roles'     =>array('khach','nguoi-dung'),
                ),

                array(
                    'controller'=>array('RaoVat\Controller\Index'),
                    'action'    =>array('add','delete','edit','editAnhDaiDien','deleteImage'),
                    'roles'     =>array('nguoi-dung'),
                ),
              
            ),
        ),
    ),*/
);