<?php
require_once "../config/main.php";
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
include ENGINE_DIR . "counters.php";
try {
  // формируем SELECT запрос
  // в результате каждая строка таблицы будет объектом
  $sql = "SELECT `id` AS id, `path` AS path, `name` AS name, `view` AS view, `click` AS click, `description` as description FROM `pictures` ORDER BY click DESC";
  $sth = $dbh->query($sql);
  while ($row = $sth->fetchObject()) {
    $data[] = $row;
  }
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('../templates');
  
  // инициализируем Twig
  $twig = new Twig_Environment($loader);
  
  // подгружаем шаблон
  $template = $twig->loadTemplate('galery.tmpl');
  
  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  $url = $_SERVER['REQUEST_URI'];
  $id = $_GET['id'];
  $click = $_GET['click'];
   
  if ($id) {
    if ($click == true) {
      counters($dbh, $id, "click");
    }
    counters($dbh, $id, "view");
  }
 
   $content = $template->render(array(
    'page_title' => 'Galery',
    'title' => 'Mario Galery',
    'server' => $url,
    'data' => $data
  ));
  echo $content;
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>