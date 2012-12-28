<?php
/**
 * @link        https://github.com/MurgaNikolay/SmartyModule for the canonical source repository
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Murga Nikolay <work@murga.kiev.ua>
 * @package     SmartyModule
 */
namespace SmartyModule;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/../../config/module.config.php';
        return $config;
    }
}