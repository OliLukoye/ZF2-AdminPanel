<?php
// module/Admin/Module.php
namespace Admin;

use Admin\Model\Admin;
use Admin\Model\AdminTable;
use Admin\Model\Posts;
use Admin\Model\PostsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module 
{
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
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Admin\Model\AdminTable' => function($sm){
                    $tableGateway = $sm->get('Admin\TableGateway');
                    $table = new AdminTable($tableGateway);
                    return $table;
                },
                'Admin\TableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Admin());
                    return new TableGateway('admin', $dbAdapter, null, $resultSetPrototype);
                },
                'AdminModelPostsTable' => function($sm){
                    $tableGateway = $sm->get('PostsTableGateway');
                    $table = new PostsTable($tableGateway);
                    return $table;
                },
                'PostsTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Posts());
                    return new TableGateway('posts', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}

?>
