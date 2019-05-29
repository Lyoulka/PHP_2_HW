<?php
class M_Goods{
	 protected function connect(){
        $db = new DBConnection('mysql:dbname=geekbrains;host=localhost', 'root', '');
        return $db;
    }
	public function create_catalogue($startIndex, $countView){
		$db = $this->connect(); 
		$goodsData = $db->select_catalogue($startIndex, $countView);
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
		$goodsData = $db->select_basket('temp_orders', $user_login);
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
			$goodsData  = $db->select_order( $table, $user_login);
		} else {
			$goodsData  = $db->select_basket( $table, $user_login);
		}
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
   		$goodsData = $db->select_order_admin($table);
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
    	$db = $this->connect();
		$goodsTemp = $db->select_basket('temp_orders', $user_login);
		$db->new_one_order($goodsTemp, $user_login);
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
			$goodTemp = $db->select_good('temp_orders', $goods_id, $login);
			if (isset($goodTemp)){
			$goods_id = $goodTemp['goods_id'];
			$count = $goodTemp['numbers'];
				if (isset($_POST["goods_id"])){
					$count++;
				} 
				if (isset($_POST["goods_id_delete"]) && $count > 1) {
					$count--;
				} elseif (isset($_POST["goods_id_delete"]) && $count == 1) {
					$db->delete_good('temp_orders', $goods_id, $login);
					$count = 0;
				} 
				if (isset($_POST["change"]) && $_POST["count"] > 0){
					$count = $_POST["count"];
				} elseif (isset($_POST["change"]) && $_POST["count"] == 0) {
					$db->delete_good('temp_orders', $goods_id, $login);
					$count = 0;
				}
				$db->update_good('temp_orders',$count, $goods_id, $login);	
			} elseif (isset($_POST["goods_id"])){
				$db->add_new_good_in_basket($goods_id, $login);
				}
		}			
		if (isset($_GET['act']) and $_GET['act'] == 'basket_clear'){
			$db->delete_all(`temp_orders`, $login);
			unset($_SESSION['basket']);
			header ('Location: index.php');
		}
	}  return $count;
	}
	public function changeOrderStatus(){
		$db = $this->connect();
	    $order_status = $db->order_status();
		return $order_status;
	}
	public function new_good(){
	 	$db = $this->connect();
		$this->uploadsFiles();
		if ($_POST['good_name'] !== "" && $_POST['good_price'] !== "" && $_POST['good_type'] !== "" && $_POST['good_description'] !== "" && $_POST['file'] !== "") {
		$good = $db->add_new_good();
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
   		$db->delete_from_catalogue();
   	}
   	public function changeGoodFromCatalogue(){
   		$goods_id = $_POST['goods_id'];
   		$variable = $_POST['link'];
   		$value = $_POST['value'];
		$db = $this->connect();
   		if ($variable == 'file'){
   			$result = $this->uploadsFiles();   			
   			}		
   		$db->apdate_catalogue($variable, $goods_id);	
   		return $value;
   	}
   	public function delete_order(){
   		$db = $this->connect();
   		$db->order_delete($_POST['deleteOrder']);
   	}
   	public function replaceOrder(){
   		$db = $this->connect();
   		$db->order_transfer();
   	}
}
