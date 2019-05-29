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
	function construct_user_order($login, $table){
		$order_content = new m_Goods();
		$result = $order_content->create_order(strip_tags(trim($login)), $table);
		return $result;
	}
	function setBasket($login){
		$basket_content = new m_Goods();
		$result = $basket_content->create_basket(strip_tags(trim($login)));
		return $result;
	}
	function setOrder($login){
		$table = 'temp_orders';
		$order_content = new m_Goods();
		$result = $order_content->create_order(strip_tags(trim($login)), $table);
		return $result;
	}
	function change_basket($login){
		$change_basket = new m_Goods();
		$result = $change_basket->basket_changes(strip_tags(trim($login)));
		return $result;
	}
	function sendOrder($login){
		$order_content = new m_Goods();
		$result = $order_content->make_order(strip_tags(trim($login)));
	}
	function setUserOrder($login){
		$table = 'orders';
		$result = $this->construct_user_order(strip_tags(trim($login)), $table);
		return $result;
		
	}
	function setDoneUserOrder($login){
		$table = 'done_orders';
		$result = $this->construct_user_order(strip_tags(trim($login)), $table);
		return $result;
	}


	function setOrderAdministration(){
		$order_content = new m_Goods();
		$result = $order_content->order_admistration('orders');
		return $result;
	}	
	function setDoneOrderAdministration(){
		$order_content = new m_Goods();
		$result = $order_content->order_admistration('done_orders');
		return $result;
	}
	function orderStatus(){
		$order_status = new m_Goods();
		$order_status = $order_status->changeOrderStatus();
		return $order_status;
	}
	function addGood(){
		$new_good = new m_Goods();
		$result = $new_good->new_good();
		return $result;
	}
	function deleteGood(){
		$new_good = new m_Goods();
		$result = $new_good->deleteGoodFromCatalogue();
	}
	function changeGood(){
		$new_good = new m_Goods();
		$result = $new_good->changeGoodFromCatalogue();
		return $result;
	}
	function deleteOrder(){
		$delete = new m_Goods();
		$delete->delete_order();
	}
	function doneOrder(){
		$done = new m_Goods();
		$done->replaceOrder();
	}

}