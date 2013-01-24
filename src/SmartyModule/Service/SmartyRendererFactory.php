<?php
namespace SmartyModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use SmartyModule\View\Renderer\SmartyRenderer;


/**
 * Created by IntelliJ IDEA.
 * User: Nikolay
 * Date: 23.01.13
 * Time: 13:39
 */
class SmartyRendererFactory implements  FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $smarty = new \Smarty();
        $config = $serviceLocator->get('Config');
        if (isset($config['view_manager']) && isset($config['view_manager']['smarty'])) {
            foreach($config['view_manager']['smarty'] as $key=>$value) {
                $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
                if (method_exists($smarty, $setter)) {
                    $smarty->$setter($value);
                } elseif(property_exists($smarty, $key)) {
                    $smarty->$key = $value;
                }
            }
        }

        $resolver = $serviceLocator->get('ViewResolver');
        $helpers = $serviceLocator->get('ViewHelperManager');

        $renderer = new SmartyRenderer();
        $renderer ->setSmarty($smarty);
        $renderer ->setResolver($resolver);
        $renderer ->setHelperPluginManager($helpers);
        return $renderer;
    }
}
