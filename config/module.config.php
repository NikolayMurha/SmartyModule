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
        'smarty_default_suffix' => 'tpl',

        /**
         * Register the view strategy with the view manager. This is required!
         */
        'strategies' => array(
            'SmartyStrategy'
        ),

        'smarty' => array(
            'compile_dir' => $dataDir . '/SmartyModule/templates_c',
            'error_reporting' => E_ERROR
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'SmartyViewResolver' => 'SmartyModule\Service\SmartyViewTemplatePathStackFactory',
            'SmartyViewTemplateMapResolver' => 'SmartyModule\Service\SmartyViewTemplateMapResolverFactory',
            'SmartyViewTemplatePathStack' => 'SmartyModule\Service\SmartyViewTemplatePathStackFactory',
            'SmartyRenderer' => 'SmartyModule\Service\SmartyRendererFactory',
            'SmartyStrategy' => 'SmartyModule\Service\SmartyStrategyFactory',
        )
    ),
);