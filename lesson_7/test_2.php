<?php
use PHPUnit\Framework\TestCase;
require_once 'vendor/autoload.php';
class GoodTest extends TestCase{

private $good;
 
    protected function setUp()
    {
        $this->good = new C_Goods();
    }
 
    protected function tearDown()
    {
        $this->good = NULL;
    }

    public function testOrderStatus()
    {
    	$result = $this->good->orderStatus($_POST['changeStatus'] = 'wind', $_POST['order_status']='TEST', $_POST['date']='2019-05-21 13:58:10');
    	$this->assertEquals( true, $result);
    }
}