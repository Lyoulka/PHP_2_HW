<?php
include_once 'config/main.php';
include_once 'config/db.php';
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
   		 }
   		 $vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res);
   		$result .= $this->card_Template('v/v_basket_card_result.php', $vars);
  	 return $result;


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
				} 
				if (isset($_POST["change"]) && $_POST["count"] > 0){
					$count = $_POST["count"];
				} elseif (isset($_POST["change"]) && $_POST["count"] == 0) {
					$sql = "DELETE FROM `temp_orders` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
					$db->exec($sql);
				}
				$sql = "UPDATE `temp_orders` SET `numbers`='{$count}' WHERE `goods_id`= {$goods_id} AND `user_login`='{$user_login}'";
				$db->exec($sql);	

			} elseif (isset($_POST["goods_id"])){
					var_dump($_POST["goods_id"]);
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
	}  

	}

}
