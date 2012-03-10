<?php

namespace SmartyModule;

use Zend\Module\Manager,
    Zend\Module\Consumer\AutoloaderProvider,
     Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{
    protected $app;

    public function init($manager)
    {
        // Register a bootstrap event
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'bootstrap'));
    }

    /**
     * @param \Zend\EventManager\Event $e
     */
    public function bootstrap($e)
    {


        // Register a render event
        $app = $e->getParam('application');
        $this->app = $app;
        $app->events()->attach('render', array($this, 'registerSmartyStrategy'), 100);
        $app->events()->attach('render', array($this, 'initView'), 99);
    }

    public function initView($e) {
        $locator = $this->app->getLocator();

        $basePath     = $this->app->getRequest()->getBasePath();
        $renderer     = $locator->get('SmartyModule\View\Renderer\SmartyRenderer');
        $renderer->plugin('url')->setRouter($this->app->getRouter());
        $renderer->doctype()->setDoctype('HTML5');
        $renderer->plugin('basePath')->setBasePath($basePath);
    }
    /**
     * @param \Zend\View\ViewEvent $e
     */
    public function registerSmartyStrategy($e)
    {
        $app          = $e->getTarget();
        $locator      = $app->getLocator();
        $view         = $locator->get('Zend\View\View');
        $smartyStrategy = $locator->get('SmartyModule\View\Strategy\SmartyStrategy');

        // Attach strategy, which is a listener aggregate, at high priority
        $view->events()->attach($smartyStrategy, 100);
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
