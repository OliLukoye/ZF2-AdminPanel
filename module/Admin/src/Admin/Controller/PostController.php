<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    protected $postsTable;
    
    public function indexAction() 
    {
        return new ViewModel(array(
            'admin' => 'admin',
        ));
    }
}
