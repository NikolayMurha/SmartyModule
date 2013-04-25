<?php
namespace SmartyModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use SmartyModule\View\Strategy\SmartyStrategy;


/**
 * Created by IntelliJ IDEA.
 * User: Nikolay
 * Date: 23.01.13
 * Time: 13:39
 */
class SmartyStrategyFactory implements  FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SmartyStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $smartyRenderer = $serviceLocator->get('SmartyRenderer');
        $smartyStrategy = new SmartyStrategy($smartyRenderer);
        return $smartyStrategy;
    }
}
