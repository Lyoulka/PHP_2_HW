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

	protected function before()
	{
		$this->title = '';
		$this->content = '';
		$this->menu_content = $this->Template('v/v_menu.php');
		if (isset($_SESSION["user_name"])){
			$this->user_name = $_SESSION["user_name"];
		}else{
			$this->user_name = 'гость';
		}
		
	}
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{
		$vars = array('menu_content' => $this->menu_content,'title' => $this->title, 'content' => $this->content, 'user_name' => $this->user_name);	
		$page = $this->Template('v/v_main.php', $vars);				
		echo $page;
	}	
}
