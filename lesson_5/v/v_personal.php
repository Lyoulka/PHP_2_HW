<?php 
 	session_start();
?>
<h1>Добрый день, <?=$_SESSION["user_name"]?>!</h1>
<p>Ваш логин: <?=$_SESSION["user_login"]?></p>