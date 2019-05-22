<?php
session_start();
//
// Конттроллер юзера.
//
include_once ('m/m_User.php');


class C_User extends C_Base{
	//
	// Конструктор.
	//
	public function action_authorization(){
		$user = new M_User();
   		$user->auth();
   		
	}
	public function action_registration(){

    	$user = new M_User();
  		$result = $user->registration();
  		return $result;
  		}
	public function user_exit(){
		$user = new M_User;
		$user->destroy_user();
	}	
}
