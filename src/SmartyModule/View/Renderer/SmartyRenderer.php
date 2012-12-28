<?php
/**
 * @link        https://github.com/MurgaNikolay/SmartyModule for the canonical source repository
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Murga Nikolay <work@murga.kiev.ua>
 * @package     SmartyModule
 */

namespace SmartyModule\View\Renderer;

use Zend\View\Renderer\PhpRenderer,
    Zend\View\Exception,
    Zend\View\Model\ModelInterface as Model;


class SmartyRenderer extends PhpRenderer
{
    /**
     * @var \Smarty $smarty
     */
    protected $smarty;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var null
     */
    private $__file = null;
    /**
     * @var array
     */
    private $__templates = array();
    /**
     * @var array
     */
    private $__template = array();
    /**
     * @var string
     */
    private $__content = '';

    /**
     *
     */
    public function init()
    {
        //$this->setSmarty(new \Smarty());
    }

    /**
     * @param \Smarty $smarty
     */

    public function setSmarty($smarty)
    {
        $this->smarty = $smarty;
        $this->smarty->assign('this', $this);
    }

    /**
     * @return \Smarty
     */
    public function getEngine()
    {
        return $this->smarty;
    }

    /**
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     * @param null $values
     * @return mixed|string
     * @throws \Zend\View\Exception\RuntimeException
     * @throws \Zend\View\Exception\DomainException
     */
    public function render($nameOrModel, $values = null)
    {


        if ($nameOrModel instanceof Model) {

            $model = $nameOrModel;
            $nameOrModel = $model->getTemplate();
            if (empty($nameOrModel)) {
                throw new Exception\DomainException(sprintf(
                    '%s: received View Model argument, but template is empty',
                    __METHOD__
                ));
            }
            $options = $model->getOptions();
            foreach ($options as $setting => $value) {
                $method = 'set' . $setting;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
                unset($method, $setting, $value);
            }
            unset($options);

            // Give view model awareness via ViewModel helper
            $helper = $this->plugin('view_model');
            $helper->setCurrent($model);

            $values = $model->getVariables();
            unset($model);
        }

        // find the script file name using the parent private method
        $this->addTemplate($nameOrModel);
        unset($nameOrModel); // remove $name from local scope

        if (null !== $values) {
            $this->setVars($values);
        }
        unset($values);

        // extract all assigned vars (pre-escaped), but not 'this'.
        // assigns to a double-underscored variable, to prevent naming collisions
        $__vars = $this->vars()->getArrayCopy();
        $__vars['this'] = $this;
        $this->smarty->assign($__vars);

        while ($this->__template = array_pop($this->__templates)) {
            $this->__template;
            $this->__file = $this->resolver($this->__template);

            if (!$this->__file) {
                throw new Exception\RuntimeException(sprintf(
                    '%s: Unable to render template "%s"; resolver could not resolve to a file',
                    __METHOD__,
                    $this->__template
                ));
            }
            $this->__content = $this->smarty->fetch($this->__file);
        }
        return $this->getFilterChain()->filter($this->__content); // filter output
    }

    /**
     * Clone Smarty engine
     */
    public function __clone()
    {
        $this->smarty = clone $this->smarty;
        $this->smarty->assign('this', $this);
    }

    /**
     * @param string $template
     * @return SmartyRenderer
     */
    public function addTemplate($template)
    {
        $this->__templates[] = $template;
        return $this;
    }
}