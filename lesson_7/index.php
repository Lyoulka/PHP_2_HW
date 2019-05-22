<?php
 	session_start();
require_once 'vendor/autoload.php';
$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';
$number = substr($_GET['act'], 9);

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
	case 'catalogue':
		$controller = new C_Page();
		break;
	case 'catalogue_page':
		$controller = new C_Page();
		break;
	case 'catalogue_add_item':
		$controller = new C_Page();
		break;
	case 'basket':
		$controller = new C_Page();
		break;
	case 'basket_page':
		$controller = new C_Page();
		break;
	case 'basket_clear':
		$controller = new C_Page();
		break;
	case 'order_form':
		$controller = new C_Page();
		break;
	case 'user_orders':
		$controller = new C_Page();
		break;	
	case 'administration':
		$controller = new C_Page();
		break;
	case 'administration_page':
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
		$action = 'action_message';
	}
	if (isset($_POST['send_order'])){
		$send_order = new C_Page();
		$action = 'action_send_order';	
	}
}

$controller->Request($action);

