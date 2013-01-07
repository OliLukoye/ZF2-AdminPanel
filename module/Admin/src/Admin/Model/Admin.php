<?php
namespace AdminModel;

class Admin
{
    public $id;
    public $artist;
    public $title;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->artist = (isset($data['artist'])) ? $data['artist'] : NULL;
        $this->title = (isset($data['title'])) ? $data['title'] : NULL;
    }
}
?>
