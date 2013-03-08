<?php
// module/Admin/Module.php
namespace Admin;

use Admin\Model\Admin;
use Admin\Model\AdminTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AdminModuleAdminTable' => function($sm){
                    $tableGateway = $sm->get('ZendDbAdapterAdapter');
                    $table = new AdminTable($tableGateway);
                    return $table;
                },
                'AdminTableGateway' => function($sm){
                    $dbAdapter = $sm->get('ZendDbAdapterAdapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Admin());
                    return new TableGateway('admin', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}

?>
