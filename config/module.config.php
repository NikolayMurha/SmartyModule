<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                // entity manager
                'smarty_renderer' => 'Smarty\View\Renderer\SmartyRenderer',
                //'smarty_strategy' => 'Smarty\View\Strategy\SmartyStrategy',
            ),
            /*'Smarty\View\Renderer\SmartyRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\Resolver\AggregateResolver',
                ),
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'defaultSuffix' => 'tpl',
                 ),
            ),*/
        ),
    ),
);
