<?php
namespace Admin\Model;

class Admin
{
    public $id;
    public $admin;
    public $title;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->admin = (isset($data['artist'])) ? $data['artist'] : NULL;
        $this->title = (isset($data['title'])) ? $data['title'] : NULL;
    }
}
?>
