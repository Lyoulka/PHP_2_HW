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
				if (($_SERVER['REQUEST_URI'] !== '/lesson_8/lesson_7/index.php?c=page&act=goods_administration') && ($_SERVER['REQUEST_URI'] !== '/lesson_8/lesson_7/index.php?c=page&act=goods_administration_page')){
					$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'type' => $good['goods_type'], 'description' => $good['goods_description'], 'image'=> $good['goods_img']);
				$result .= $this->card_Template('v/v_card.php', $vars);	
				} else {
					$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'type' => $good['goods_type'], 'description' => $good['goods_description'], 'image'=> $good['goods_img']);
					$result .= $this->card_Template('v/v_goods_list_card.php', $vars);	
					}
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
		if ($table == 'orders' || $table == 'done_orders'){
			$sql = "SELECT * FROM `{$table}` where user_login='{$user_login}' ORDER BY `date` DESC";
		} else {
			$sql = "SELECT * FROM `{$table}` WHERE `user_login`='{$user_login}'";
		}
		$goodsData = $db->queryAll($sql);
		if (!empty($goodsData)){ 
			$price_res = 0;
			$lastDate = NULL;
			foreach ($goodsData as $good) {
				if ($table == 'orders' || $table == 'done_orders'){
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
				if ($table == 'orders' || $table == 'done_orders'){
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
   	public function order_admistration($table){
   		$db = $this->connect();
   		$sql = "SELECT * FROM `{$table}` ORDER BY `date` DESC";
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
						if ($table !== 'done_orders'){
							$result .= $this->card_Template('v/v_administration_card.php', $vars);
						} else {
							$result .= $this->card_Template('v/v_administration_card_1.php', $vars);
							}
						
						}
					$price_res = 0;
					$count_res = 0;
					$i = 1;
					$count++; 
					$lastDate = $order['date'];
					$lastlogin = strip_tags(trim($order['user_login']));
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
				$vars = array('i' => $i, 'price_res' => $price_res, 'count_res' => $count_res, 'order_status' => $order_status, 'order_date' => $lastDate, 'count' => $count, 'user_login' => $order['user_login'], 'user_id' => $order['user_id'], 'user_name' => $order['user_name'], 'user_surname' =>$order['user_surname'], 'user_city' => $order['user_city'], 'user_adress' => $order['user_adress'], 'order_status' => $order['order_status'], 'order_content' => $order_content);

					if ($table !== 'done_orders'){
						$result .= $this->card_Template('v/v_administration_card.php', $vars);
					} else {
						$result .= $this->card_Template('v/v_administration_card_1.php', $vars);
						}		
   			}	else {
   				$result = 'Заказов нет';
   			}
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
		$login = strip_tags(trim($_SESSION["user_login"]));
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
		$user_login = strip_tags(trim($_POST["changeStatus"]));
		$order_status = $_POST["order_status"];
		$order_date = $_POST["date"];
	    $data = $db->prepare("UPDATE `orders` SET `order_status`= ? WHERE `user_login`= ? and `date` = ?");
    	$data->execute([$order_status, $user_login, $order_date]);
		return $order_status;
	}
	public function new_good(){
	 	$db = $this->connect();
		$this->uploadsFiles();
		if ($_POST['good_name'] !== "" && $_POST['good_price'] !== "" && $_POST['good_type'] !== "" && $_POST['good_description'] !== "" && $_POST['file'] !== "") {
			$sql = "INSERT INTO `catalogue` (`goods_name`, `goods_price`, `goods_type`, `goods_description`, `goods_img`) VALUES (\"{$_POST['good_name']}\", \"{$_POST['good_price']}\", \"{$_POST['good_type']}\", \"{$_POST['good_description']}\", \"{$_POST['file']}\")";
		$db->exec($sql);
		$sql = "SELECT * FROM `catalogue` order by `goods_id` DESC LIMIT 1"; 
		$good = $db->queryOne($sql);
		$vars = array('id' => $good['goods_id'],'name' => $good['goods_name'], 'price' => $good['goods_price'], 'type' => $good['goods_type'], 'description' => $good['goods_description'], 'image'=> $good['goods_img']);
		$result .= $this->card_Template('v/v_goods_list_card.php', $vars);
		return $result;
		}

	}
	function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
  		if (!file_exists($src)) return false;
  		$size = getimagesize($src);
  		if ($size === false) return false;
  		// Определяем исходный формат по MIME-информации, предоставленной
  		// функцией getimagesize, и выбираем соответствующую формату
  		// imagecreatefrom-функцию.
  		$format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  		$icfunc = "imagecreatefrom" . $format;
  		if (!function_exists($icfunc)) return false;
  		$x_ratio = $width / $size[0];
  		$y_ratio = $height / $size[1];
  		$ratio       = min($x_ratio, $y_ratio);
  		$use_x_ratio = ($x_ratio == $ratio);
  		$new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
  		$new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  		$new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
  		$new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
  		$isrc = $icfunc($src);
  		$idest = imagecreatetruecolor($width, $height);
  		imagefill($idest, 0, 0, $rgb);
  		imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
   			 $new_width, $new_height, $size[0], $size[1]);
  		imagejpeg($idest, $dest, $quality);
  		imagedestroy($isrc);
  		imagedestroy($idest);
  		return true;
	}
	function uploadsFiles(){
		foreach ($_FILES as $file) {
        $fileType = explode("/", $file['type'])[0];
        if ($file['error'] != 0) {
            $message = "Произошла ошибка: " . $file['error'] . "!";
        } elseif ($fileType != "image") {
            $message = "Неверный тип файла: " . $file['name'] . "!";
        } elseif ($file['size'] > 1048576) {
            $message = "Слишком большой размер файла: " . $file['size'] . "! Не более 1Мб!";
        } else { 
        	$message = "Успешно";
            $path1 = "v/img/";
            $src = $file['tmp_name'];
            $original = $path1 . $file['name'];
            $thumbs = $path1. 'thumbs/' . $file['name'];
            $this->img_resize($src, $thumbs, 240, 160);
            move_uploaded_file($src, $original);
            }
        }
        return $message;
    }
   	public function deleteGoodFromCatalogue(){
   		$db = $this->connect();
   		$sql="DELETE FROM `catalogue` WHERE `goods_id`={$_POST['goods_id']}";
   		$db->exec($sql);
   	}
   	public function changeGoodFromCatalogue(){
   		$goods_id = $_POST['goods_id'];
   		$variable = $_POST['link'];
   		$value = $_POST['value'];
		$db = $this->connect();
   		if ($variable == 'file'){
   			$result = $this->uploadsFiles();   			
   			}		
   		$sql = $sql = "UPDATE `catalogue` SET `goods_{$variable}`='{$value}' WHERE `goods_id` = '{$goods_id}'";
   		$db->exec($sql);	
   		return $value;
   	}
   	public function delete_order(){
   		$db = $this->connect();
   		$sql="DELETE FROM `orders` WHERE `user_login`='{$_POST['deleteOrder']}' AND `date` ='{$_POST['date']}' ";
   		$db->exec($sql);
   	}
   	public function replaceOrder(){
   		$db = $this->connect();
   		$sql = "UPDATE `orders` SET `order_status`='Выполнен' WHERE `user_login` = '{$_POST['doneOrder']}' and `date` = '{$_POST['date']}'";
   		$db->exec($sql);	
   		$sql = "INSERT INTO `done_orders` SELECT * FROM `orders` WHERE `user_login` = '{$_POST['doneOrder']}' and `date` = '{$_POST['date']}'";
   		$db->exec($sql);
   		$sql="DELETE FROM `orders` WHERE `user_login` = '{$_POST['doneOrder']}' and `date` = '{$_POST['date']}'";
   		$db->exec($sql);
   	}
}
