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
                        'action'     => 'index',
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
			'rao_vat' => __DIR__ . '/../view'
		)
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
);