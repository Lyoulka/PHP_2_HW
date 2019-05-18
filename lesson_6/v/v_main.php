<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $menu_content - панель меню
 * $content - HTML страницы
 */
?>
<!doctype html>
		<html lang="en">
		  <head>
		    <!-- Required meta tags -->
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link href="v/css/style.css" rel="stylesheet">
		    <!-- Bootstrap CSS -->
		    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script type="text/javascript" src="v/js/main.js"></script>
	    	<title><?=$title?></title>
		  </head>
		 <body>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   			 	<span class="navbar-brand">Здравствуй, <?=$user_name?> </span>
    		    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    		        <ul class="navbar-nav mr-auto mt-2 ml-5 mt-lg-0">
						<?=$menu_content?>
    		        </ul>
   				 </div>
   			 </nav>
			 	<div id="header">
					<h1><?=$title?></h1>
				</div>
   			 	<div id="content">
					<?=$content?>
				</div>	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>