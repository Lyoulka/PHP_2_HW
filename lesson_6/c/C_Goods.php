<?php
	session_start();
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
	function change_basket($login){
		$this->login = $login;
		$this->goods_id = $goods_id;
		$change_basket = new m_Goods();
		$change_basket->basket_changes($this->login);
	}
}