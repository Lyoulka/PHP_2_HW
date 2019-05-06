<?php 
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


$loader = new Twig_Loader_Filesystem('../templates');
  
  // инициализируем Twig
$twig = new Twig_Environment($loader);
  
  // подгружаем шаблон
$stepchild_template = $twig->loadTemplate('card.tmpl');
$countView = (int)$_POST['count_add']; 
 // количество записей, получаемых за один раз
$startIndex = (int)$_POST['count_show'];

$sql = "SELECT `goods_id` AS id, `goods_name` AS name, `goods_price` AS price, `goods_type` AS type, `goods_description` as description, `goods_img`as image FROM `catalogue` LIMIT {$startIndex}, {$countView}";

$sth = $dbh->query($sql);
while ($row = $sth->fetchObject()) {
    $goodsData[] = $row;
  }
  if(empty($goodsData)){
    // если новостей нет
    $result = 'finish';

}else{ 
    $result = $stepchild_template->render(array(
        'result' => 'success',
        'data' => $goodsData    
    )); 
    
    } 
    echo $result;