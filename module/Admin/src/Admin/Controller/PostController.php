<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Posts;

class PostController extends AbstractActionController
{
    protected $postsTable;
    
    public function indexAction() 
    {
        return new ViewModel(array(
            'posts' => $this->getPostsTable()->fetchAll(),
        ));
    }
    
    public function getPostsTable()
    {
        if (!$this->postsTable) {
            $sm = $this->getServiceLocator();
            $this->postsTable = $sm->get("AdminModelPostsTable");
        }
        return $this->postsTable;
    }
}
