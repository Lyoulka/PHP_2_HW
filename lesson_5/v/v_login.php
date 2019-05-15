	<main>
		<div class="login-block">
			<img src="v/img/unknown.png" alt="Scanfcode">
			<h1>Введите свои данные</h1>
			<form method="POST">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
						<input type="text" name="login" class="form-control" placeholder="Ваш логин"<?=$able;?>>
					</div>
				</div>
				<hr class="hr-xs">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock ti-unlock"></i></span>
						<input type="password" name="pass" class="form-control" placeholder="Ваш пароль"<?=$able;?>>
					</div>
				</div>
				<button class="btn btn-primary btn-block" type="submit" name="signin"<?=$able;?>>ВОЙТИ НА САЙТ</button>
			</form>
		</div>
	<div class="login-links">
		<p class="text-center">Еще нет аккаунта? <a class="txt-brand" href="index.php?c=page&act=registration"><font color=#29aafe>Регистрируйся</font></a></p>
	</div>
 </main>
