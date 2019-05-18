<!--
 * Шаблон меню страницы
 * =======================-->
 <?php if ($_SESSION["admin"] == NULL ): ?>
    <li class="nav-item active">
        <a href="index.php?c=page&act=login" class="btn btn-success btn-md" role="button" aria-pressed="true">Авторизация</a>
   	</li>
    <? else : ?>
    	<li class="nav-item active">
    		<a href="index.php?c=page&act=exit" class="btn btn-danger btn-md" role="button" aria-pressed="true">Выйти из профиля</a>
    	</li>
        <li class="nav-item active">
            <a href="index.php?c=page&act=catalogue" class="btn btn-success btn-md ml-3" role="button" aria-pressed="true">Каталог</a>
        </li>
        <li class="nav-item active">
            <a href="index.php?c=page&act=basket" class="btn btn-success btn-md ml-3" role="button" aria-pressed="true">Корзина</a>
        </li>
        <li class="nav-item active">
            <a href="index.php?c=page&act=personal" class="btn btn-success btn-md ml-3" role="button" aria-pressed="true">Личный кабинет</a>
        </li>
        <li class="nav-item active">
            <a href="index.php?c=page&act=user_orders" class="btn btn-success btn-md ml-3" role="button" aria-pressed="true">Мои заказы</a>
        </li>
    <? endif; ?> 
    <? if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) : ?>
        <li class="nav-item active">
            <a href="index.php?c=page&act=administration" class="btn btn-success btn-md ml-3" role="button" aria-pressed="true">Управление заказами</a>
        </li>
    <? endif; ?>