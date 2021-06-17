<?php


namespace SmartyModuleTest;


use ApplicationTest\Bootstrap;
use PHPUnit\Framework\TestCase;
use SmartyModule\View\Renderer\SmartyRenderer;
use SmartyModule\View\Strategy\SmartyStrategy;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Resolver\TemplateMapResolver;
use Zend\View\Resolver\TemplatePathStack;

class ModuleTest extends TestCase
{

    public function testModuleProvidesFactories()
    {
        $sm = Bootstrap::getServiceManager();

        $this->assertTrue($sm->has('SmartyViewResolver'));
        $this->assertTrue($sm->has('SmartyViewTemplateMapResolver'));
        $this->assertTrue($sm->has('SmartyViewTemplatePathStack'));
        $this->assertTrue($sm->has('SmartyRenderer'));
        $this->assertTrue($sm->has('SmartyStrategy'));
    }

    /**
     * @param $serviceName
     * @param $expectedClassName
     * @dataProvider provideServices
     */
    public function testCanCreateService($serviceName, $expectedClassName)
    {
        $sm = Bootstrap::getServiceManager();

        $service = $sm->get($serviceName);
        $this->assertInstanceOf($expectedClassName, $service);
    }

    public function provideServices()
    {
        return [
            [
                'SmartyViewResolver',
                ResolverInterface::class
            ],
            [
                'SmartyViewTemplateMapResolver',
                TemplateMapResolver::class
            ],
            [
                'SmartyViewTemplatePathStack',
                TemplatePathStack::class
            ],
            [
                'SmartyRenderer',
                SmartyRenderer::class
            ],
            [
                'SmartyStrategy',
                SmartyStrategy::class
            ],
        ];
    }


}
