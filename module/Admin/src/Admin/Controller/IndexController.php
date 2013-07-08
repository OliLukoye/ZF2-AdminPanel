<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Admin;
use Admin\Form\AdminForm;

class IndexController extends AbstractActionController
{
    protected $albumTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getAlbumTable()->fetchAll(),
        ));
    }
    
    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Admin\Model\AdminTable');
        }
        return $this->albumTable;
    }
    
    public function addAction()
    {
        $form = new AdminForm();
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $admin = new Admin();
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $admin->exchangeArray($form->getData());
                $this->getAlbumTable()->saveCategory($admin);
                
                return $this->redirect()->toRoute('admin');
            }
        }
        return array('form' => $form);
    }
    
    public function editAction () 
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array(
                'action' => 'add'
            ));
        }
        $admin = $this->getAlbumTable()->getCategory($id);
        
        $form = new AdminForm();
        $form->bind($admin);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($form->getData());
 
                // Redirect to list of albums
                return $this->redirect()->toRoute('admin');
            }
        }
 
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin');
        }
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
 
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteCategory($id);
            }
 
            // Redirect to list of albums
            return $this->redirect()->toRoute('admin');
        }
 
        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getCategory($id)
        );
    }
}
