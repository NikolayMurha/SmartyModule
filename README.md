# Welcome to the SmartyModule for Zend Framework 2!

SmartyModule is a module that integrates the Smarty templating engine with Zend Framework 2.

Version: 1.0.0

## Istallation

### Composer

1. Add `"murganikolay/smarty-module": "dev-master"` to your `composer.json` file and run php composer.phar update.
2. Add SmartyModule to your `config/application.config.php` file under the modules key.

### Manual

1. `git clone https://github.com/MurgaNikolay/SmartyModule.git` in to `vendor` dir
2. Put Smarty in to `vendor` dir
3. Setup autoloader for load Smarty.
3. Add SmartyModule to your `config/application.config.php` file under the modules key.


### Configuration

Change you Application config like this:
    
    ...
    'view_manager' => array(
        'default_suffix' => 'tpl', // <-- new option for path stack resolver
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.tpl',
            'application/index/index' => __DIR__ . '/../view/application/index/index.tpl',
            'error/404'               => __DIR__ . '/../view/error/404.tpl',
            'error/index'             => __DIR__ . '/../view/error/index.tpl',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    ...


Aditional info about view manager: [Zend\View](http://framework.zend.com/manual/2.0/en/modules/zend.view.quick-start.html "Zend\View").
