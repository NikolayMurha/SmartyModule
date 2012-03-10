<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                // entity manager
                'smarty_engine' => 'Smarty',
                //'smarty_strategy' => 'Smarty\View\Strategy\SmartyStrategy',
            ),
            'SmartyModule\View\Renderer\SmartyRenderer' => array(
                'parameters' => array(
                    'smarty' => 'smarty_engine',
                ),
            ),
           'smarty_engine' => array(
               'parameters' =>array(
                   'compile_dir' => realpath(__DIR__ . '/../../../data/SmartyModule/templates_c'),
               )
           )
            /*
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'defaultSuffix' => 'tpl',
                 ),
            ),*/
        ),
    ),
);
