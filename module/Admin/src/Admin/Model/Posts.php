<?php
namespace Posts\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Post implements InputFilterAwareInterface
{
    public $id;
    public $meta_d;
    public $meta_k;
    public $title_post;
    public $text_post;
    public $author_post;
    public $date_post;
    public $fid_cat;
    public $comment_count;
    protected $inputFilter;


    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->meta_d = (isset($data['meta_d'])) ? $data['meta_d'] : NULL;
        $this->meta_k = (isset($data['meta_k'])) ? $data['meta_k'] : NULL;
        $this->title_post = (isset($data['title_post'])) ? $data['title_post'] : NULL;
        $this->text_post = (isset($data['text_post'])) ? $data['text_post'] : NULL;
        $this->author_post = (isset($data['author_post'])) ? $data['author_post'] : NULL;
        $this->date_post = (isset($data['date_post'])) ? $data['date_post'] : NULL;
        $this->fid_cat = (isset($data['fid_cat'])) ? $data['fid_cat'] : NULL;
        $this->comment_count = (isset($data['comment_count'])) ? $data['comment_count'] : NULL;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) 
    {
        throw new Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'meta_d',
                'required' => FALSE,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 255,
//                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'meta_k',
                'required' => FALSE,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 255,
//                        ),
                    ),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'title_post',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
//                            'encoding' => 'UTF-8',
                            'min'      => 1,
//                            'max'      => 255,
                        ),
                    ),
                ),
            )));
 
            $this->inputFilter = $inputFilter;
        }
 
        return $this->inputFilter;
    }
}
?>
