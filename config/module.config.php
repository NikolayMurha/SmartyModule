<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                // entity manager
                'smarty_engine' => 'Smarty',
            ),

            'SmartyModule\View\Renderer\SmartyStrategy' => array(
                'parameters' => array(
                    'smarty' => 'SmartyModule\View\Renderer\SmartyRenderer',
                ),
            ),
            'SmartyModule\View\Renderer\SmartyRenderer' => array(
                'parameters' => array(
                    'smarty' => 'smarty_engine',
                    'resolver' => 'Zend\View\Resolver\AggregateResolver',
                ),
            ),

            'smarty_engine' => array(
                'parameters' => array(
                    'compile_dir' => realpath(__DIR__ . '/../../../data/SmartyModule/templates_c'),
                )
            )
        ),
    ),
);

