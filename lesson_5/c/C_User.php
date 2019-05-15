<?php
session_start();
include_once 'config/main.php';
include_once 'config/db.php';
//
// Конттроллер юзера.
//
include_once ('m/m_User.php');

class C_User extends C_Base{
	//
	// Конструктор.
	//
	public function action_authorization(){
		$login=$_POST['login'];
		$password=$_POST['pass'];
		$user = new M_User();
   		$user->auth($login, $password);
	}
	public function action_registration(){
		$username = $_POST['username'];
    	$login = $_POST['login'];
    	$password = $_POST['password'];
    	$user = new M_User();
  		$result = $user->registration($username, $login, $password);
  		return $result;
  		}
		

	public function user_exit(){
		
		$user = new M_User;
		$user->destroy_user();
	}
	
}
