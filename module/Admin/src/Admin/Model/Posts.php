<?php
namespace Posts\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Post implements InputFilterAwareInterface
{
    private $_id;
    private $_meta_d;
    private $_meta_k;
    private $_title_post;
    private $_text_post;
    private $_author_post;
    private $_date_post;
    private $_fid_cat;
    private $_comment_count;
    protected $inputFilter;


    public function exchangeArray($data)
    {
        $this->_id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->_meta_d = (isset($data['meta_d'])) ? $data['meta_d'] : NULL;
        $this->_meta_k = (isset($data['meta_k'])) ? $data['meta_k'] : NULL;
        $this->_title_post = (isset($data['title_post'])) ? $data['title_post'] : NULL;
        $this->_text_post = (isset($data['text_post'])) ? $data['text_post'] : NULL;
        $this->_author_post = (isset($data['author_post'])) ? $data['author_post'] : NULL;
        $this->_date_post = (isset($data['date_post'])) ? $data['date_post'] : NULL;
        $this->_fid_cat = (isset($data['fid_cat'])) ? $data['fid_cat'] : NULL;
        $this->_comment_count = (isset($data['comment_count'])) ? $data['comment_count'] : NULL;
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
                'name'     => 'artist',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
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
