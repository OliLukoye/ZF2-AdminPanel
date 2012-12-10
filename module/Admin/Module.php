<?php
// module/Admin/Module.php
namespace Admin;

class Module 
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\Class\MapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandartAutoloader' => array(
                'namespace' => array(
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

?>
