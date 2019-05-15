<?php
//
// Конттроллер главной страницы.
//
class C_Page extends C_Base
{
	
	//
	// Конструктор.
	//
	function setMessage($message){
		$this->message = $message;
	}
	protected function getMessage(){
			return $this->message;
		}
	public function action_index(){
		$this->title .= 'Главная страница';
	}
	public function action_login(){
		$this->title .= 'Авторизация';
		$this->content = $this->Template('v/v_login.php');
		
	}
	public function action_personal(){
		$this->title .= 'Личный кабинет пользователя';
		$this->content = $this->Template('v/v_personal.php');
	}
	public function action_administration(){
		$this->title .= 'Кабинет администратора';
		$this->content = $this->Template('v/v_administration.php');
	}
	public function action_exit(){
		$user = new C_User();
		$user->user_exit();
	}
	public function action_registration(){
		$this->title .= 'Регистрация';
		$this->content = $this->Template('v/v_registration.php');
	}
	public function action_message(){
		$this->title .= $this->message;
		$this->content = $this->Template('v/v_registration.php');

		
	}

}
