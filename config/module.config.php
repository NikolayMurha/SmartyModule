<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                // entity manager
                'view' => 'SmartyModule\View\Renderer\SmartyRenderer',
                'smarty_engine' => 'Smarty',
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
        ),
    ),
);
