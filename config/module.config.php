<?php
/**
 * @link        https://github.com/MurgaNikolay/SmartyModule for the canonical source repository
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Murga Nikolay <work@murga.kiev.ua>
 * @package     SmartyModule
 */


$dataDir = __DIR__ . '/../../../../data';
if (!is_dir($dataDir)) {
    $dataDir = __DIR__ . '/../../../data';
}

return array(
    'view_manager' => array(
        'default_suffix' => 'tpl',

        /**
         * Register the view strategy with the view manager. This is required!
         */
        'strategies' => array(
            'SmartyStrategy'
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'ViewTemplatePathStack' => 'SmartyModule\Service\ViewTemplatePathStackFactory',
        ),
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
                    'compile_dir' => $dataDir . '/SmartyModule/templates_c',
                ),
            ),
        ),
    ),
);