<?php

namespace SmartyModule;

use Zend\Module\Manager,
    Zend\Module\Consumer\AutoloaderProvider,
     Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{
    public function init($manager)
    {
        // Register a bootstrap event
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'setupView'));
    }

    /**
     * @param $e
     * @param \Zend\EventManager\Event $e

     */
    public function setupView($e)
    {
        // Register a render event
        $application = $e->getParam('application');
        $locator             = $application->getLocator();

        $view                = $locator->get('Zend\View\View');
        $smartyRendererStrategy = $locator->get('SmartyModule\View\Strategy\SmartyStrategy');
        $view->events()->attachAggregate($smartyRendererStrategy, 100);
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


}
