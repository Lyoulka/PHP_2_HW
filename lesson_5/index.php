<?php
 	session_start();
function __autoload($classname){
	include("c/$classname.php");
}
$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';
switch ($_GET['c'])
{
	case 'articles':
		$controller = new C_Page();
		break;
	case 'login':
		$controller = new C_Page();
		break;
	case 'exit':
		$controller = new C_Page();
		break;
	case 'registration':
		$controller = new C_Page();
		break;
	default:
		$controller = new C_Page();
		break;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['signin'])){
		$authorization = new C_User();
		$authorization->action_authorization();
	}
	if (isset($_POST['registration'])){
		$registration = new C_User();
		$message = $registration->action_registration();
		$controller = new C_Page();
		$controller->setMessage($message);
		$action= 'action_message';
	}
}
$controller->Request($action);

