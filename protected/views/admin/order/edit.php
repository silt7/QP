<? $order = $this->processOutput( $order );?>
<? $items = $order->getLinesToView(); print_r($order->shopping_cart_id)?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/orders" class="link">Редактирование заказов</a></li>
		<li class="active"><?= $order->getTitle() ?></li>
	</ol>
</div>

<div class="container">
<h1 class="head"><?= $order->getTitle() ?> </h1>

<form action="/admin/order/save" method="post" enctype="multipart/form-data">
<input hidden="hidden" name="id" value="<?= $order->id ?>">

<div class="row">


	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">

				<div class="form-group">

					<div class="row">

						<div class="col-xs-12">
							<div> Оформил : <?= $order->getUserLogin() ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Заказчик : <?= $order->name ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Email : <?= $order->email ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Телефон : <?= $order->phone ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Адрес : <?= $order->address ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Комментарий : <?= $order->comment ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Товаров : <?= $order->getTotalCount() ?> </div>
						</div>
						<div class="col-xs-12">
							<div> Общая сумма : <?= $order->getTotalPrice() ?> руб.</div>
						</div>
						<div class="col-xs-12">
							<div> Общая предоплата : <?= $order->getTotalPrePay() ?> руб.</div>
						</div>
					</div>

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<?= $order->status != "" ? Order::$statusArray[ $order->status ]["label"] : "Статус" ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?  $currentStatus = $order->status;
							foreach ( Order::$statusArray as $status ):
								?>
								<li>
									<input type="radio" id="status_<?= $status['name'] ?>" name="status"
									       value="<?= $status['name'] ?>" <?= $status['name'] == $currentStatus ? 'checked' : '' ?>>
									<label for="status_<?= $status['name'] ?>"><?= $status['label'] ?></label>
								</li>
							<? endforeach ?>
						</ul>
					</div>

				</div>


			</div>
		</div>

	</div>

</div>

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

				<? foreach ( $itemCollection["items"] as $orderLine ): ?>
					<div class="row item">
						<div class="col-md-4">
							<b><?= $orderLine->item_title ?></b>
							<? foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ): ?>
								<div><?= $option["title"] ?></div>
							<? endforeach; ?>
							<?= isset( $itemCollection["cover_width"] ) ? "<div>Ширина : " . $itemCollection["cover_width"] . " мм</div>" : "" ?>
							<?= isset( $itemCollection["cover_length"] ) ? "<div>Длина : " . $itemCollection["cover_length"] . " мм</div>" : "" ?>							
							
							<? if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ): ?>
								<? $title_color = Color::model()->findByPk($itemCollection["module_color_id"]); echo "Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title']; ?>
								<?$options = unserialize($orderLine["options"]);?>
								<? if ($options["mod_front_color_id"] > 0 ){?>
									<? 	$title_color_f = Color::model()->findByPk($options["mod_front_color_id"]);
										echo "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title']; ?>
								<? } else{
									echo "<br>Фасад: Без фасада.";
								} ?>
							<? endif;
							if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ): ?>
								<? $title_color = Color::model()->findByPk($itemCollection["front_color_id"]); echo $title_color->getMaterialLabel()." - ".$title_color['title']; ?>
							<? endif;
							if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ): ?>
								<!--<img src="/images/colors/<?//= $itemCollection["cover_color_id"]; ?>.png" style="width:15px; height:15px;">-->
								<? $title_color = Color::model()->findByPk($itemCollection["cover_color_id"]); echo $title_color['title']." (".$title_color['material'].")"; ?>
							<? endif; ?>
						</div>
						<div class="col-md-3">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<input type="text" disabled name="quantity_<?= $orderLine->id ?>" class="form-control" value="<?= $orderLine->quantity ?>"
										       placeholder="0"
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
					Итого
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


	</div>
	<a href="/admin/order/download/<?= $order->id?>" target="_blank" class="btn btn-default"> Сохранить Excel</a>
</div>


<div class="panel-footer">
	<a href="/admin/orders" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
	<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
			class="fa fa-check"></i> Сохранить
	</button>
</div>
</form>

</div>
<script type="text/javascript">

	$(".adm-module-extra-options input[type='text']").click(function () {
		var thisInput = $(this);
		var thisInputGroup = thisInput.parent();
		var thisBtn = thisInputGroup.parent();
		setTimeout(function () {
			thisBtn.removeClass("btn-success").addClass("btn-success");
			thisBtn.find("input[type='checkbox']").prop('checked', true);
		}, 1);
		var textInput = thisBtn.find("input[type='text']");
		if (textInput.val() == "") {
			textInput.val(0);
		}
	})

	$(".adm-module-extra-options").click(function () {
		var thisButton = $(this);

		if (thisButton.hasClass("btn-success")) {
			thisButton.removeClass("btn-success");
			thisButton.find("input[type='checkbox']").prop('checked', false);
		} else {
			thisButton.addClass("btn-success");
			thisButton.find("input[type='checkbox']").prop('checked', true);
			var textInput = thisButton.find("input[type='text']");
			if (textInput.val() == "") {
				textInput.val(0);
			}
		}
	});


</script>