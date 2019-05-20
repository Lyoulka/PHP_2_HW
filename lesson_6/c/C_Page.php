<?php
//
// Конттроллер главной страницы.
//
class C_Page extends C_Base
{
	//
	// Конструктор.
	//
	function __construct(){
		$good = new C_Goods;
		$good->change_basket($this->login);
	}
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
		if (isset($_SESSION["user_login"]) && isset($_SESSION["password"])){
		$this->title .= 'Личный кабинет пользователя';
		$this->content = $this->Template('v/v_personal.php');
	}else{
		$this->content = $this->Template('v/v_autorization.php');
	}

	}
	public function action_administration(){
		if (isset($_SESSION["user_login"]) && isset($_SESSION["password"]) && $_SESSION["admin"] == 1){
		$this->title .= 'Кабинет администратора';
		$this->content = $this->Template('v/v_administration.php');
		}else{
		$this->content = $this->Template('v/v_autorization.php');
	}
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
	public function action_catalogue(){
		if (isset($_SESSION["user_login"]) && isset($_SESSION["password"])){
		$this->title .= 'Каталог товаров';
		$this->catalogue_content = new C_Goods;
		$this->catalogue_content = $this->catalogue_content->setCatalogue();
		$this->content = $this->Template('v/v_catalogue.php', $vars = array('catalogue_content' => $this->catalogue_content));
	}else{
		$this->content = $this->Template('v/v_autorization.php');
	}

	}
	public function action_catalogue_page(){
	if (isset($_SESSION["user_login"]) && isset($_SESSION["password"])){
		if (isset($_POST['count_add'])){
			$goods = new C_Goods();
  			$result = $goods-> setCatalogue($_POST['count_show'], $_POST['count_add']);	
  			$this->catalogue_content = $result;	
  		}else{
		$this->content = $this->Template('v/v_autorization.php');
	}
		}
	}
	public function action_catalogue_add_item(){
		$this->__construct();
	}
	public function action_basket_page(){
		$this->__construct();
	}
	public function action_basket_clear(){
		$this->__construct();
	}
	public function action_basket(){
	if (isset($_SESSION["user_login"]) && isset($_SESSION["password"])){
		$this->basket_content = new C_Goods;
		$this->basket_content = $this->basket_content->setBasket($this->login);
		$this->content = $this->Template('v/v_basket.php', $vars = array('basket_content' => $this->basket_content));	
	}else{
		$this->content = $this->Template('v/v_autorization.php');
	}
}
}
