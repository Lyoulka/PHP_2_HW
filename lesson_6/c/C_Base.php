<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
	protected $menu_content; // панель меню
	protected $user_name;
	protected $login;
	protected $catalogue_content;

	protected function before()
	{
		$this->title = '';
		$this->content = '';
		$this->menu_content = $this->Template('v/v_menu.php');
		$this->catalogue_content = '';
		if (isset($_SESSION["user_name"])){
			$this->user_name = $_SESSION["user_name"];
			$this->login = $_SESSION["user_login"];
		}else{
			$this->user_name = 'гость';
			$this->login = '';
		}	
	}
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{
		$vars = array('menu_content' => $this->menu_content,'title' => $this->title, 'catalogue_content' => $this->catalogue_content, 'content' => $this->content, 'user_name' => $this->user_name);	
		$page = $this->Template('v/v_main.php', $vars);				
		echo $page;
	}	
	public function catalogue_render(){
		$vars = array('catalogue_content' => $this->catalogue_content);
		if ($this->catalogue_content !== 'finish'){
			$page = $this->Template('v/v_catalogue_page.php', $vars);
			echo $page;
		}else{
			return false;
		}
	}	
}
