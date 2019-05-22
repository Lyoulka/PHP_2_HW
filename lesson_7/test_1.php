<?php
use PHPUnit\Framework\TestCase;
require_once 'vendor/autoload.php';
include "C_User.php";
class UserTest extends TestCase{

private $user;
 
    protected function setUp()
    {
        $this->user = new C_User();
    }
 
    protected function tearDown()
    {
        $this->user = NULL;
    }
 
    public function testAuth()
    {  
        $result = $this->user->action_authorization($_POST['login'] = 'wind', $_POST['pass']='1234');
        $this->assertEquals('location: index.php?c=page&act=administration', $result);
    }
    public function testReg()
    {
        $result = $this->user->action_registration($_POST['username'] = 'Марина', $_POST['login'] = 'Jerry', $_POST['pass']='1234');
        $message = "Регистрация прошла успешно!";
        $this->assertEquals($message, $result);
    }
    public function testReg1()
    {
        $result = $this->user->action_registration($_POST['username'] = 'Марина', $_POST['login'] = 'Jerry', $_POST['pass']='1234');
        $message = "Такой логин уже есть!";
        $this->assertEquals($message, $result);
    }
        public function testReg2()
    {
        $result = $this->user->action_registration($_POST['username'] = 'Admin', $_POST['login'] = 'Admin', $_POST['pass']='1234');
        $message = "Логин админа нельзя зарегистрировать!";
        $this->assertEquals($message, $result);
    }

    public function testExit()
    {
        $result = $this->user->user_exit();
        $this->assertEquals('location: index.php', $result);
    }


    
}