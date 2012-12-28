<?php
/**
 * @link        https://github.com/MurgaNikolay/SmartyModule for the canonical source repository
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Murga Nikolay <work@murga.kiev.ua>
 * @package     SmartyModule
 */
namespace SmartyModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class ViewTemplatePathStackFactory extends \Zend\Mvc\Service\ViewTemplatePathStackFactory
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $templatePathStack = parent::createService($serviceLocator);

        $config = $serviceLocator->get('Config');
        if (is_array($config) && isset($config['view_manager'])) {
            $config = $config['view_manager'];
            if (is_array($config) && isset($config['default_suffix'])) {
                $templatePathStack->setDefaultSuffix($config['default_suffix']);
            }
        }
        return $templatePathStack;
    }
}