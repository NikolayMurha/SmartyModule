<?php

return array(
    'view_manager' => array(
        'default_suffix' => 'tpl',
        'strategies' => array(
            'SmartyStrategy'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'ViewTemplatePathStack' => 'SmartyModule\Service\ViewTemplatePathStackFactory',
        ),
        'aliases' => array()
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'SmartyRenderer' => 'SmartyModule\View\Renderer\SmartyRenderer',
                'SmartyStrategy' => 'SmartyModule\View\Strategy\SmartyStrategy',
                'ViewResolver' => 'Zend\Mvc\Service\ViewResolverFactory',
                'ViewHelperManager' => 'Zend\Mvc\Service\ViewResolverFactory',
            ),

            'SmartyStrategy' => array(
                'parameters' => array(
                    'renderer' => 'SmartyRenderer',
                ),
            ),

            'SmartyRenderer' => array(
                'parameters' => array(
                    'smarty' => 'Smarty',
                    'resolver' => 'ViewResolver',
                    'helpers' => 'ViewHelperManager',
                ),
            ),

            'Smarty' => array(
                'parameters' => array(
                    'compile_dir' => __DIR__ . '/../../../data/SmartyModule/templates_c',
                )
            )
        ),
    ),
);

