<?php
namespace SmartyModule;
use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Loader\StandardAutoloader;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function setupView($e)
    {
        // Register a render event
       /* $application = $e->getParam('application');
        $locator             = $application->getLocator();

        $view                = $locator->get('Zend\View\View');
        $smartyRendererStrategy = $locator->get('SmartyModule\View\Strategy\SmartyStrategy');
        $view->events()->attachAggregate($smartyRendererStrategy, 100);*/
    }

}

/*namespace SmartyModule;

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
*/