<?php
namespace Admin\TestModel;

use Admin\Model\Admin;
use PHPUnit_Framework_TestCase;

class AdminTest extends PHPUnit_Framework_TestCase
{
    public function testAdminInitialState()
    {
        $admin = new Admin();
        
        $this->assertNull($admin->admin, '"admin" should initially be null');
        $this->assertNull($admin->id, '"id" should initially be null');
        $this->assertNull($admin->title, '"title" should initially be null');
    }
    
    public function setExchangeArraySetsPropertiesCorrectly()
    {
        $admin = new Admin();
        $data = array(  'admin' => 'some admin',
                        'id'    => 123,
                        'title' => 'some title');
        
        $admin->exchangeArray($data);
        
        $this->assertSame($data['admin'], $admin->admin, '"admin" was not set correctly');
        $this->assertSame($data['id'], $admin->id, '"id" was not set correctly');
        $this->assertSame($data['title'], $admin->title, '"title" was not set correctly');
    }
    
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $admin = new Admin();
        
        $admin->exchangeArray(array('admin' => 'some admin',
                                    'id'    => 123,
                                    'title' => 'some title'));
        $admin->exchangeArray(array());
        
        $this->assertNull($admin->admin, '"admin" should have defaulted to null');
        $this->assertNull($admin->id, '"id" should have defaulted to null');
        $this->assertNull($admin->title, '"title" should have defaulted to null');
    }
}
