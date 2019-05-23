<?php

	include_once ('m/m_Goods.php');
	class C_Goods  extends C_Base	{
	function setCatalogue($startIndex = 0, $countView = 4) {
		$this->startIndex = $startIndex;
		$this->$countView = $countView;
		$catalogue_content = new m_Goods();
		$result = $catalogue_content->create_catalogue($this->startIndex, $this->$countView = $countView);
		return $result;
	}
	function setBasket($login){
		$this->login = $login;
		$basket_content = new m_Goods();
		$result = $basket_content->create_basket($this->login);
		return $result;
	}
	function setOrder($login){
		$this->login = $login;
		$table = 'temp_orders';
		$order_content = new m_Goods();
		$result = $order_content->create_order($this->login, $table);
		return $result;
	}
	function change_basket($login){
		$this->login = $login;
		$this->goods_id = $goods_id;
		$change_basket = new m_Goods();
		$result = $change_basket->basket_changes($this->login);
		return $result;
	}
	function sendOrder($login){
		$this->login = $login;
		$order_content = new m_Goods();
		$result = $order_content->make_order($this->login);
	}
	function setUserOrder($login){
		$this->login = $login;
		$table = 'orders';
		$order_content = new m_Goods();
		$result = $order_content->create_order($this->login, $table);
		return $result;
	}
	function setOrderAdministration(){
		$order_content = new m_Goods();
		$result = $order_content->order_admistration();
		return $result;
	}	
	function orderStatus(){
		$order_status = new m_Goods();
		$order_status = $order_status->changeOrderStatus();
		return $order_status;
	}
}