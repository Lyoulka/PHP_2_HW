<?php
session_start();
require_once "../config/main.php";
//include_once ENGINE_DIR."getGoods.php";
// подгружаем и активируем авто-загрузчик Twig-а
require_once '../Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  $dbh = new PDO('mysql:dbname=geekbrains;host=localhost', 'root', '');
} 
catch (PDOException $e) {
  echo "Error: Could not connect. " . $e->getMessage();
}
// установка error режима
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {

$first_goods = "SELECT `goods_id` AS id, `goods_name` AS name, `goods_price` AS price, `goods_type` AS type, `goods_description` as description, `goods_img`as image FROM `catalogue` LIMIT 4";
$new_sth = $dbh->query($first_goods);
  while ($row = $new_sth->fetchObject()) {
    $data[] = $row;
  }

  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('../templates');
  
  // инициализируем Twig
  $twig = new Twig_Environment($loader);
  
  // подгружаем шаблон
  $template = $twig->loadTemplate('shop.tmpl');
  $child_template = 'catalogue.tmpl';
  //$stepchild_template = $twig->loadTemplate('card.tmpl');
  
  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  if ($_SESSION["auth"] == true){
  	$user_name = $_SESSION["user_name"];
  }  


  $content = $template->render(array(
    'page_title' => 'Интернет Магазин',
    'auth'  => $_SESSION["auth"],
    'admin'  => $_SESSION['admin'],
    'user_name' => $user_name,
    'child_template' => $child_template,
    'data' => $data
   ));
  echo $content;

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>