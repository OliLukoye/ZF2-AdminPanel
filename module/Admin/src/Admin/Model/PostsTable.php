<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class PostsTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) 
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll ()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getPost($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new Exception("Не найдено поля $id");
        }
        return $row;
    }
}
