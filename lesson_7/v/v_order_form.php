<main>
		<div class="ofder-form">
			<h3>Введите данные для доставки</h3>
			<hr class="hr-xs">
			<form method="post">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
						<input type="text" name="name" class="form-control" placeholder="Введите имя получателя" required>
					</div>
					<hr class="hr-xs">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
						<input type="text" name="surname" class="form-control" placeholder="Введите фамилию получателя" required>
					</div>
					<hr class="hr-xs">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
						<input type="text" name="city" class="form-control" placeholder="Введите город доставки" required>
					</div>
					<hr class="hr-xs">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
						<input type="text" name="adress" class="form-control" placeholder="Введите адрес доставки" required>
					</div>
				</div>
				<hr class="hr-xs">
				<h4>Ваш заказ</h4>
				<p>Ниже представлены товары, добавленные в вашу корзину:</p>
				<table class="table">
					<? echo $order_content?>
				</table>
				<button class="btn btn-primary btn-block" type="submit"  name="send_order">ОФОРМИТЬ ЗАКАЗ</button>
			</form>
</main>