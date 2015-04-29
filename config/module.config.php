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
         * set this to true, to inject all path stack directories into smarty
         * this will allow you to include templates with paths relative to path stack directories
         */
        'smarty_set_path_stack_dirs' => false,

        /**
         * Register the view strategy with the view manager. This is required!
         */
        'strategies' => array(
            'SmartyStrategy'
        ),
        'smarty_defaults' => array(
            'compile_dir' => $dataDir . '/SmartyModule/templates_c',
            'error_reporting' => E_ERROR
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'SmartyViewResolver' => 'SmartyModule\Service\SmartyViewResolverFactory',
            'SmartyViewTemplateMapResolver' => 'SmartyModule\Service\SmartyViewTemplateMapResolverFactory',
            'SmartyViewTemplatePathStack' => 'SmartyModule\Service\SmartyViewTemplatePathStackFactory',
            'SmartyRenderer' => 'SmartyModule\Service\SmartyRendererFactory',
            'SmartyStrategy' => 'SmartyModule\Service\SmartyStrategyFactory',
        )
    ),
);