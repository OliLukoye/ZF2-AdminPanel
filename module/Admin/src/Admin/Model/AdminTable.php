<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class AdminTable
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
    
    public function getCategory ($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Не найдено поля $id");
        }
        return $row;
    }
    
    public function saveCategory(Admin $admin)
    {
        $data = array(
            'admin' => $admin->admin,
            'title' => $admin->title,
        );
        
        $id = (int)$admin->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCategory($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception("Нет данных из формы");
            }
        }
    }
    
    public function deleteCategory($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
