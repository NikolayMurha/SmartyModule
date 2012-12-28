<?php
namespace SmartyModule;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/../../config/module.config.php';
        return $config;
    }
}