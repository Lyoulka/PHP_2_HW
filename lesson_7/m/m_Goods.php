<?php
class M_Goods{
	 protected function connect(){
        $db = new DBConnection('mysql:dbname=geekbrains;host=localhost', 'root', '');
        return $db;
    }
	public function create_catalogue($startIndex, $countView){
		$db = $this->connect(); 
		$sql = "SELECT * FROM `catalogue` LIMIT {$startIndex}, {$countView}";
		$goodsData = $db->queryAll($sql);
  		if(empty($goodsData)){
   		 $result = 'finish';
		}else{ 
			foreach ($goodsData as $good) {
				$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'type' => $good['goods_type'], 'description' => $good['goods_description'], 'image'=> $good['goods_img']);
				$result .= $this->card_Template('v/v_card.php', $vars);	
			}
   		 }
  	 return $result;
	}
	public function create_basket ($user_login){
		$db = $this->connect();
		$sql = "SELECT * FROM `temp_orders` WHERE `user_login`='{$user_login}'";
		$goodsData = $db->queryAll($sql);
		if(empty($goodsData)){
   		 $result = '<p>Вы еще не добавили ни одного товара!</p>';
		}else{ 
			foreach ($goodsData as $good) {
				$i++;
      			$price_res += ($good['goods_price'] * $good['numbers']);
     			$count_res += $good['numbers'];	
				$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'type' => $good['goods_type'], 'description' => $good['goods_description'], 'image'=> $good['goods_img'], 'numbers' => $good['numbers']);
				$result .= $this->card_Template('v/v_basket_card.php', $vars);
			}
			$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res);
   		$result .= $this->card_Template('v/v_basket_card_result.php', $vars);
   		 }
   		 
  	 return $result;
	}
	public function create_order($user_login, $table){
		$db = $this->connect();
		if ($table == 'orders'){
			$sql = "SELECT * FROM `orders` where user_login='{$user_login}' ORDER BY `date` DESC";
		} else {
			$sql = "SELECT * FROM `{$table}` WHERE `user_login`='{$user_login}'";
		}
		$goodsData = $db->queryAll($sql);
		if (!empty($goodsData)){ 
			$price_res = 0;
			$lastDate = NULL;
			foreach ($goodsData as $good) {
				if ($table == 'orders'){
					if ($good['date'] !== $lastDate){
						if ($price_res > 0) {
							$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res, 'order_status' => $order_status, 'order_date' => $lastDate, 'order_cards' => $order_cards);
								$result .= $this->card_Template('v/v_user_order_card.php', $vars);
						}
						$price_res = 0;
						$count_res = 0;
						$i = 1;
						$lastDate = $good['date'];
						$order_status = $good['order_status'];
						$order_cards = NULL;
					} 				
						$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'numbers' => $good['numbers']);
						$order_cards .= $this->card_Template('v/v_order_card.php', $vars);

					} else {
						$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'numbers' => $good['numbers']);
 					
						$result .= $this->card_Template('v/v_order_card.php', $vars);
					}
				$i++;
      			$price_res += ($good['goods_price'] * $good['numbers']);
     			$count_res += $good['numbers'];		
				}
				if ($table == 'orders'){
					$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res, 'order_status' => $order_status, 'order_date' => $lastDate, 'order_cards' => $order_cards);
					$result .= $this->card_Template('v/v_user_order_card.php', $vars);
				} else {
					$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res);
					$result .= $this->card_Template('v/v_order_card_result.php', $vars);
				}		
   			} else { 
   				$result .= "Здесь пока ничего нет!";
   			}
   			return $result;
   		}
   	public function order_admistration(){
   		$db = $this->connect();
   		$sql = "SELECT * FROM `orders` ORDER BY `date` DESC";
   		$goodsData = $db->queryAll($sql);
   		if (!empty($goodsData)){ 
			$price_res = 0;
			$count = 0;
  			$counter = $count;
			$lastDate = NULL;
			$lastlogin = NULL;
			foreach ($goodsData as $order) {
				if (($order['date'] !== $lastDate) && ($order['user_login'] !== $lastlogin)){
					if ($price_res > 0) {
						$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res, 'order_status' => $order_status, 'order_date' => $lastDate, 'count' => $count, 'user_login' => $lastlogin, 'user_id' => $lastId, 'user_name' => $lastName, 'user_surname' => $lastSur, 'user_city' => $lastCity, 'user_adress' => $lastAdress, 'order_status' => $order_status, 'order_content' => $order_content);
						$result .= $this->card_Template('v/v_administration_card.php', $vars);
						}
					$price_res = 0;
					$count_res = 0;
					$i = 1;
					$count++; 
					$lastDate = $order['date'];
					$lastlogin = $order['user_login'];
					$order_status = $order['order_status'];
					$lastId = $order['user_id'];
					$lastName = $order['user_name'];
					$lastSur = $order['user_surname'];
					$lastCity = $order['user_city'];
					$lastAdress = $order['user_adress'];
					$order_content = NULL;
				} 				
				$vars = array('id' => $order['goods_id'],'name' => $order['goods_name'], 'price' => $order['goods_price'], 'numbers' => $order['numbers']);
				$order_content .= $this->card_Template('v/v_administration_good_card.php', $vars);
				$i++;
      			$price_res += ($order['goods_price'] * $order['numbers']);
     			$count_res += $order['numbers'];
					} 				
   			}	
   		$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res, 'order_status' => $order_status, 'order_date' => $lastDate, 'count' => $count, 'user_login' => $order['user_login'], 'user_id' => $order['user_id'], 'user_name' => $order['user_name'], 'user_surname' =>$order['user_surname'], 'user_city' => $order['user_city'], 'user_adress' => $order['user_adress'], 'order_status' => $order['order_status'], 'order_content' => $order_content);
			$result .= $this->card_Template('v/v_administration_card.php', $vars);
		return $result;
   }
	public function make_order($user_login){
    	$user_id = $_SESSION["user_id"];
    	$user_name = $_POST["name"];
    	$user_surname = $_POST["surname"];
    	$user_city = $_POST["city"];
    	$user_adress = $_POST["adress"];
    	$order_status = "Ожидает подтверждения";
		$db = $this->connect();
		$sql = "SELECT * FROM `temp_orders` where user_login='{$user_login}'";
		$goodsTemp = $db->queryAll($sql);
		foreach ($goodsTemp as $good) {
			$sql = "INSERT INTO `orders` (`user_id`, `user_login`, `user_name`, `user_surname`, `user_city`, `user_adress`, `goods_id`, `goods_name`, `numbers`, `goods_price`, `order_status`, `date`) VALUES (\"{$user_id}\",\"{$user_login}\",\"{$user_name}\",\"{$user_surname}\",\"{$user_city}\",\"{$user_adress}\",\"{$good['goods_id']}\",\"{$good['goods_name']}\", {$good['numbers']}, {$good['goods_price']},\"{$order_status}\", NOW())";
			$db->exec($sql);
		}
		unset($_SESSION['basket']);
		$sql = "DELETE FROM `temp_orders` WHERE `user_login`='{$user_login}'";
		$db->exec($sql);
		if ($_SESSION['basket'] == 0){
		header ('Location:index.php?c=page&act=user_orders');
		}
	}
	public function card_Template ($fileName, $vars = array()){
		// Установка переменных для шаблона.
		foreach ($vars as $k => $v)
		{
			$$k = $v;
		}
		// Генерация HTML в строку.
		ob_start();
		include "$fileName";
		return ob_get_clean();	
	}	
	public function basket_changes($user_login){
		$count = 1;
if (isset($_SESSION["user_login"]) && isset($_SESSION["password"])){
		$db = $this->connect(); 
		$login = $_SESSION["user_login"];
	if (isset($_POST["goods_id"]) || isset($_POST["goods_id_delete"]) || isset($_POST["change"])){
		$_SESSION['basket'] = 1;
		if (isset($_POST["goods_id"])){
			$goods_id = $_POST["goods_id"];
		} elseif (isset($_POST["goods_id_delete"])) {
			$goods_id = $_POST["goods_id_delete"];
		} else {
		$goods_id = $_POST["change"];
		}
		$sql = "SELECT * FROM `temp_orders` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
		$goodTemp = $db->queryOne($sql);
		if (isset($goodTemp)){
			$goods_id = $goodTemp['goods_id'];
			$count = $goodTemp['numbers'];

				if (isset($_POST["goods_id"])){
					$count++;
				} 
				if (isset($_POST["goods_id_delete"]) && $count > 1) {
					$count--;
				} elseif (isset($_POST["goods_id_delete"]) && $count == 1) {
					$sql = "DELETE FROM `temp_orders` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
					$db->exec($sql);
					$count = 0;
				} 
				if (isset($_POST["change"]) && $_POST["count"] > 0){
					$count = $_POST["count"];
				} elseif (isset($_POST["change"]) && $_POST["count"] == 0) {
					$sql = "DELETE FROM `temp_orders` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
					$db->exec($sql);
					$count = 0;
				}
				$sql = "UPDATE `temp_orders` SET `numbers`='{$count}' WHERE `goods_id`= {$goods_id} AND `user_login`='{$user_login}'";
				$db->exec($sql);	

			} elseif (isset($_POST["goods_id"])){
				$sql = "SELECT * FROM `catalogue` WHERE `goods_id`={$goods_id}";
				$good = $db->queryOne($sql);
				$sql = "INSERT INTO `temp_orders` (`goods_id`, `goods_img`, `goods_name`, `goods_price`, `numbers`, `user_login`) VALUES (\"{$good['goods_id']}\",\"{$good['goods_img']}\",\"{$good['goods_name']}\",\"{$good['goods_price']}\",\"1\",\"{$user_login}\")";
					$db->exec($sql);
				}
		}			
		if (isset($_GET['act']) and $_GET['act'] == 'basket_clear'){
			$sql =  "DELETE FROM `temp_orders` WHERE `user_login`='{$user_login}'";
			$db->exec($sql);
			unset($_SESSION['basket']);
			header ('Location: index.php');
		}
	}  return $count;
	}
	public function changeOrderStatus(){
		$db = $this->connect();
		$user_login = $_POST["changeStatus"];
		$order_status = $_POST["order_status"];
		$order_date = $_POST["date"];
		$sql = "UPDATE `orders` SET `order_status`='{$order_status}' WHERE `user_login`='{$user_login}' and `date` = '{$order_date}'";
		$db->exec($sql);
		return $order_status;
	}

}
