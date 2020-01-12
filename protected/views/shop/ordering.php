<? $items = $this->processOutput( $items );
$page = $this->processOutput( $page );
$agreement = $this->processOutput( $agreement );
$order    = $this->getShoppingCartModel();
$user     = $this->getUser();
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/shopping-cart" class="link">Корзина</a></li>
		<li class="active">Оформления заказа</li>
	</ol>
</div>
<div class="container shopping-cart">

	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<form role="form" id="order-form">
				<div class="form-group">
					<label for="exampleInputEmail1">ФИО</label>
					<input type="email" name="name" class="form-control"  placeholder="ФИО"
					       value="<?= $user ? $user->first_name . " " . $user->last_name : "" ?>">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Телефон</label>
					<input type="email" name="phone" class="form-control"  placeholder="Телефон">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Адрес доставки</label>
					<input type="email" name="address" class="form-control"  placeholder="Адрес">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input type="hidden" name="emailUser" class="form-control" value="<?= $user ? $user->email : "" ?>">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?= $user ? $user->email : "" ?>">
					<span class="help-block"></span>
				</div>
				<? if ( ! $user ): ?>
					<div class="form-group" style="display:none;">
						<label for="exampleInputPassword1">Пароль (быстрая регистрация или вход)</label>
						<input name="password" type="password" class="form-control" placeholder="Пароль" value="null123">
						<span class="help-block"></span>
					</div>
				<? endif ?>
				<div class="form-group">
					<label for="exampleInputEmail1">Коментарий к заказу</label>
					<textarea name="comment" class="form-control" placeholder="Коментарий"></textarea>
					<span class="help-block"></span>
				</div>
				<!--
				<h3 class="agreement-title"><?//= $agreement->title ?></h3>
				    <div class="agreement"><?//= $agreement->content ?></div>
				
				<div class="form-group">

					<div class="checkbox">
						<label>
							<input type="checkbox" name="confirm" id="confirm-btn" value="1">
							Принять соглашение
						</label>
					</div>

				</div>
				-->
			</form>
		</div>
		<div class="col-sm-6 col-xs-12">
		    <h2><?= $page->title ?></h2>
		    <?= $page->content ?>
		</div>

	</div>


	


	<!--			<img src="/images/colors/1.png" class="module-color-img">-->
	<!--			<img src="/images/colors/2.png" class="module-color-img">-->

</div>


<div class="container shopping-cart">

	<div class="row title-row">

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					Товары
				</div>
				<div class="col-md-3">
					<div class="col-md-6">
						кол-во
					</div>
					<div class="col-md-6">
						цена
					</div>
				</div>
				<div class="col-md-2">
					предоплата
				</div>
				<div class="col-md-2">
					стоимость
				</div>
                
			</div>
		</div>
	</div>

	<? foreach ( $items as $itemCollection ): ?>

		<? $sectionTotalPrice = 0; ?>


		<div class="row">

			<div class="col-md-12">

				<? foreach ( $itemCollection["items"] as $orderLine ): ?>

					<div class="row item">
						<div class="col-md-4">
							<b><?= $orderLine->item_title ?></b>
							<? foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ): ?>
								<div><?= $option["title"] ?></div>
							<? endforeach; ?>
							<?= isset( $itemCollection["cover_width"] ) ? "<div>Ширина : " . $itemCollection["cover_width"] . " мм</div>" : "" ?>
							<?= isset( $itemCollection["cover_length"] ) ? "<div>Длина : " . $itemCollection["cover_length"] . " мм</div>" : "" ?>

							<?= isset( $itemCollection["module_color_id"] ) ? "Цвет корпуса : " . Color::model()->findByPk( $itemCollection["module_color_id"] )->title : "" ?>
							<?= isset( $itemCollection["front_color_id"] ) ? "Цвет фасада : " . Color::model()->findByPk( $itemCollection["front_color_id"] )->title : "" ?>
							<?= isset( $itemCollection["cover_color_id"] ) ? "Цвет : " . Color::model()->findByPk( $itemCollection["cover_color_id"] )->title : "" ?>

						</div>
						<div class="col-md-3">
							<div class="row">
								<div class="col-md-6 price">
									<?= $orderLine->quantity ?> шт
								</div>
								<div class="col-md-6 price">

									<?= Utils::priceFormat( $orderLine->price ) ?> руб.
								</div>

							</div>
						</div>
						<div class="col-md-2 total-price">
							<?= Utils::priceFormat( $orderLine->quantity * $orderLine->pre_pay ) ?> руб.
						</div>
						<div class="col-md-3 total-price">
							<?
							$sectionTotalPrice += $orderLine->quantity * $orderLine->price;

							?>

							<?= Utils::priceFormat( $orderLine->quantity * $orderLine->price ) ?> руб.
						</div>
					</div>


				<? endforeach; ?>


			</div>
		</div>


	<? endforeach; ?>
	<hr>
	<div class="row total-price">
		<div class="col-sm-2 col-xs-12 "><a href="/shopping-cart" class="btn btn-default to-order-button">Вернуться в корзину</a></div>
		<div class="col-sm-2 col-xs-0"></div>
		<div class="col-sm-6 col-xs-9 "><span class="pull-right">Всего товаров <?= $order->getTotalCount() ?> на сумму <?= Utils::priceFormat( $order->getTotalPrice() ) ?>
				руб. (Предоплата: <?= Utils::priceFormat( $order->getTotalPrePay());?>) руб.<span></div>
		<div class="col-sm-2 col-xs-3"><a onclick="sendOrderData()" class="btn btn-default to-order-button ordering-button">Оформить</a></div>

	</div>
</div>

<script type="text/javascript">


	function sendOrderData() {
		//if ($("#confirm-btn").prop("checked")) {

		$("span.help-block").html("");
		$(".has-error").removeClass("has-error");

		var data = $("#order-form").serialize();

		var url = "<?php echo Yii::app()->createAbsoluteUrl("shop/orderSave"); ?>"

		$.ajax({
			type: 'POST',
			url: url,
			data: data,

			success: function (responseData) {

				var json = (eval("(" + responseData + ")"));

				if (json.code == 'ok') {
					console.log("success")
					console.log(json.data);
					window.location.replace("/");
				} else {
					console.log("failed")
					console.log(json.data);
					$.each(json.data, function (id, message) {
						$("#order-form input[name=" + message.field_name + "]").parent().addClass("has-error");
						$("#order-form input[name=" + message.field_name + "]").parent().find("span.help-block").html(message.error);
					});


				}
                alert('Для оформления заказа свяжитесь с менеджерами по телефонам представленных в разделе "Контакты"');
				//$.each(messages, function (id, message) {});


			},
			error: function (responseData) {
				console.log(responseData);

			},

			dataType: 'html'
		});
		/*} else {
			alert("Соглашение");
		}*/
	}


</script>