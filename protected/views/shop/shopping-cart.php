<? $items = $this->processOutput( $items );
$order    = $this->getShoppingCartModel();

?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Корзина</li>
	</ol>
</div>
<form action="/shopping-cart/update" method="post">

	<div class="container shopping-cart">
		<div class="row title-row">
			<div class="col-md-11">
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

				<div class="col-md-11">
					<? //print_r($itemCollection); ?>
					<? foreach ( $itemCollection["items"] as $orderLine ): ?>

						<div class="row item">
							<div class="col-md-4">
								<b><?= $orderLine->item_title ?></b><br>
								
								<? if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["module_color_id"]); echo "Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title']; ?>
									<?$options = unserialize($orderLine["options"]);?>
									<? if ($options["mod_front_color_id"] > -1 ){ ?>
										<? 	$title_color_f = Color::model()->findByPk($options["mod_front_color_id"]);
											echo "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title']; ?>
									<? } else{
										echo "<br>Фасад: Без фасада.";
									} ?>
								<? endif;
								if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["front_color_id"]); echo $title_color['title']." (".$title_color->getMaterialLabel().")"; ?>
								<? endif;
								if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ): ?>
									<!--<img src="/images/colors/<?//= $itemCollection["cover_color_id"]; ?>.png" style="width:15px; height:15px;">-->
									<? $title_color = Color::model()->findByPk($itemCollection["cover_color_id"]); echo $title_color['title']; ?>
								<? endif; ?>
							
								<? foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ):?>
									<div><?= $option["title"] ?></div>
								<? endforeach; ?>
								<?= isset( $itemCollection["cover_width"] ) ? "<div>Ширина : " . $itemCollection["cover_width"] . " мм</div>" : "" ?>
								<?= isset( $itemCollection["cover_length"] ) ? "<div>Длина : " . $itemCollection["cover_length"] . " мм</div>" : "" ?>
																
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<input type="text" name="quantity_<?= $orderLine->id ?>" class="form-control" value="<?= $orderLine->quantity ?>" placeholder="0"
												   aria-describedby="count-1">
											<span class="input-group-addon" id="count-1">шт</span>
										</div>
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
								<a href="/shop/remove/item/<?= $orderLine->id ?>"><i class="fa fa-trash pull-right"></i></a>
								<a href="/shop/edit/item/<?= $orderLine->id ?>"><i class="fa fa-pencil pull-right"></i></a>
							</div>
						</div>


					<? endforeach; ?>


				</div>
			</div>


		<? endforeach; ?>


		<div class="row total-price">
			<div class="col-md-11">
				<div class="row">
					<div class="col-md-4">
						Итого:
					</div>
					<div class="col-md-3">
						<div class="col-md-6">
							<center><?= $order->getTotalCount() ?> шт</center>
						</div>
						<div class="col-md-6">

						</div>
					</div>
					<div class="col-md-2">
						<?= Utils::priceFormat( $order->getTotalPrePay() ) ?> руб.

					</div>
					<div class="col-md-3">
						<?= Utils::priceFormat( $order->getTotalPrice() ) ?> руб.
					</div>

				</div>
			</div>
			<div class="col-md-2 col-md-offset-1 ">
				<? if ( ! $this->isGuestSession() ): ?><a href="/shopping-cart/list" class="btn btn-default " style="width: 100%">Загрузить корзину</a><? endif ?>
			</div>
			<div class="col-md-2 ">
				<? if ( ! $this->isGuestSession() ): ?>
					<form id="save-shopping-cart-form">
						<div class="form-group" id="save-shopping-cart" style="display: none">

							<input id="save-shopping-cart-form-title" type="text" name="title" class="form-control" style="width: 100%" placeholder="Название корзины">
							<a id="save-shopping-cart-form-btn" class="btn btn-success " style="width: 100%">Сохранить</a>

						</div>

					</form>
					<a class="btn btn-default" id="save-shopping-cart-btn" style="width: 100%">Сохранить корзину</a>
					<a class="btn btn-success" id="save-shopping-cart-success" style="width: 100%; display: none">Корзина сохранена</a>
				<? endif ?>
			</div>
			<div class="col-md-2 ">
				<a href="/shopping-cart/clear" class="btn btn-default " style="width: 100%">Очистить</a>
			</div>
			<div class="col-md-2 ">
				<button type="submit" class="btn btn-default" style="width: 100%">Пересчитать</button>
			</div>
			<div class="col-md-3 "><? if( $order->getTotalPrice()>0) { ?><a href="/ordering" class="btn btn-default to-order-button ordering-button">Перейти к оформлению</a><? } ?></div>

		</div>

		<div class="row next-step">
			<div class="col-md-10"></div>

		</div>


	</div>

</form>

<script type="text/javascript">
	$(function () {
		$("#save-shopping-cart-btn").click(function () {
			$(this).css({"display": "none"});
			$("#save-shopping-cart").css({"display": "block"});
		});

		$("#save-shopping-cart-form-btn").click(function () {
			var data = 'title=' + $("#save-shopping-cart-form-title").val();

			var url = "<?php echo Yii::app()->createAbsoluteUrl("shop/shoppingCartSave"); ?>";

			$.ajax({
				type: 'POST',
				url: url,
				data: data,

				success: function (responseData) {
					console.log(responseData);

					var json = (eval("(" + responseData + ")"));

					if (json.code == 'ok') {
						$("#save-shopping-cart").css({"display": "none"});
						$("#save-shopping-cart-success").fadeIn("fast");
					} else {
						console.log("failed")
						console.log(json.data);


					}

				},
				error: function (responseData) {
					console.log(responseData);

				},

				dataType: 'html'
			});

			$(this).css({"display": "none"});
			$("#save-shopping-cart-success").css({"display": "block"});
		});
	})
</script>