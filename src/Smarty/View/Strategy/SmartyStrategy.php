<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Murga Nikolay work@murga.kiev.ua
 * Date: 05.03.12
 * Time: 11:32
 */
namespace Smarty\View\Strategy;

use Zend\EventManager\EventCollection,
    Zend\EventManager\ListenerAggregate,
    Zend\View\ViewEvent,
    Smarty\View\Renderer\SmartyRenderer;

class SmartyStrategy implements ListenerAggregate
{
    protected $listeners;


    public function __construct(SmartyRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventCollection $events
     * @param int $priority
     */
    public function attach(EventCollection $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('renderer', array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach('response', array($this, 'injectResponse'), $priority);
    }

    public function detach(EventCollection $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Retrieve the composed renderer
     *
     * @return SmartyRenderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Retrieve the composed renderer
     *
     * @param ViewEvent $e
     * @return SmartyRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        return $this->renderer;
    }

    /**
     * Populate the response object from the View
     *
     * Populates the content of the response object from the view rendering
     * results.
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            return;
        }
        $result   = $e->getResult();
        $response = $e->getResponse();
        $response->setContent($result);
    }
}
