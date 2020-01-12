<?php $item     = $this->processOutput( $item );
$orderLine      = $this->processOutput( $orderLine );
$options        = $orderLine->getOptions();
$selectColor    = $options["cover_color_id"];
$width          = $options["cover_width"];
$length         = $options["cover_length"];
$factor         = $options["factor"];
$optionsChecked = array();
foreach ( $options["options_checked"] as $option ) {
	$optionsChecked[ $option["id"] ] = $option;
}
$colors = $item->getColors();
$price  = 0;
foreach ( $colors as $color ) {
	if ( $color["is_enabled"] ) {
		$price = $color["price"];
		break;
	}
}
?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<li><a href="/catalog/wall-panels" class="link">Стеновые панели</a></li>
		<li class="active"><?= $item->title ?></li>
	</ol>
</div>

<div class="qp_item">
	<form id="item-form">
		<input type="hidden" name="item_id" value="<?= $item->id ?>">
		<input type="hidden" name="order_line_id" value="<?= $orderLine->id ?>">


		<div class="qp_item-left">
			<div class="qp_item-image">
				<img class="image-link" src="<?= $item->getImage() ?>" alt=""
				     data-mfp-src="<?= $item->getImage() ?>"/>
			</div>
			<a class="qp_item-back-btn" href="<?= $this->getBackUrl() ?>"><i class="fa fa-angle-left"></i>Назад</a>

			<div class="qp_item-count">
				<div class="qp_item-count-minus"><i class="fa fa-minus"> </i></div>
				<div class="qp_item-count-number"><input name="quantity" id="item_quantity" value="<?= $orderLine->quantity ?>"></div>
				<div class="qp_item-count-plus"><i class="fa fa-plus"> </i></div>
			</div>
			<div class="qp_item-buy-btn"><a><i class="fa fa-check"> </i>Сохранить</a></div>
			<div class="qp_item-buy-success"><i class="fa fa-check"> </i>Товар добавлен в корзину</div>
		</div>
		<div class="qp_item-right">
			<div class="qp_item-title"><?= $item->title ?></div>
			<div class="qp_item-price"><span id="item-price"><?= Utils::priceFormat( $price ) ?></span><i>Р</i></div>
			<div id="clear-price" class="data-hidden"><?= $price ?></div>
			<input id="factor" name="factor" class="data-hidden" value="<?= $factor ?>">

			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-covers/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
			<div class="qp_item-description"><?= $item->description ?></div>

			<div class="qp_item-size" <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?>>
				<span>Ширина</span>
				<input name="width" id="extra-size-width" type="text" value="<?= $width ?>">
				<span>Длина</span>
				<input name="length" id="extra-size-height" type="text" value="<?= $length ?>">
				<span>мм</span>
			</div>


			<? $colors = $item->getColors();
			if ( $colors ) :?>

				<div class="qp_item-colors">

					<div class="title">Цвета</div>

					<? foreach ( $colors as $color ):
						if ( $color["is_enabled"] ):
							$colorModel = Color::model()->findByPk( $color["id"] );?>
							<div class="qp_item-color-item">
								<div class="inner <?= $selectColor == $color["id"] ? "selected" : "" ?>">
									<input type="radio" value="<?= $colorModel->id ?>" <?= $selectColor == $color["id"] ? "checked" : "" ?> name="color">

									<div class="data-price data-hidden"><?= $color["price"] ?></div>

									<img src="<?= $colorModel->getImage() ?>.png" height="75" width="75">
									<div class="qp_item-color-item-title"><?= $colorModel->title ?><div class="tr"></div></div>
									<a href='/images/colors/<?= $colorModel->image;?>.png' class="fancybox" title="<?= $colorModel->title ?>" style="text-decoration: none;">
										<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
									</a>
								</div>

							</div>
						<? endif ?>

					<? endforeach; ?>
				</div>
			<? endif ?>

			<? $options = $item->getOptions();
			if ( $options ) :?>

				<div class="qp_item-options">

					<div class="title">Опции</div>
					<? foreach ( $options as $option ):
					if ( $option["is_enabled"] ):

					$optionModel = ModuleOption::model()->findByPk( $option["id"] );?>

						<div class="qp_item-option-item" data-option="<?= $optionModel->group ?>">
							<div class="inner <?= isset( $optionsChecked[ $option["id"] ] ) ? "selected" : "" ?>">
								<input type="checkbox" value="<?= $optionModel->id ?>" <?= isset( $optionsChecked[ $option["id"] ] ) ? "checked" : "" ?> name="options[]">

								<div class="data-price data-hidden"><?= $option["price"] ?></div>

								<? if ( $optionModel->image ): ?>
									<img src="<?= $optionModel->getImage() ?>">
								<? endif ?>

								<?= $optionModel->title ?>
							</div>

						</div>
					<? endif ?>

					<? endforeach; ?>

				</div>
			<? endif ?>

		</div>
	</form>
</div>


</div>


<script type="text/javascript">
	$(function () {
		$("#nav-catalog").parent().addClass('active');
	})


	function updatePrice() {
		var options = $(".qp_item-options").find("input[type=checkbox]");
		var clearPrice = parseInt($("#clear-price").html());
		var factor = parseInt($("#factor").val());
		var count = parseInt($("#item_quantity").val());
		var optionsPrice = 0;
		$.each(options, function (key, object) {

			var $object = $(object);

			if ($object.prop("checked")) {
				optionsPrice += parseInt($object.parent().find(".data-price").html());
			}
		});
		$("#item-price").html(priceFormat(count * (clearPrice + optionsPrice) * factor));
	}


	function addToShoppingCart() {
		sendJson($("#tabletop-form").serialize(), "/add/tabletop", function (message) {
			console.log(message);
		}, function (message) {
			alert(message);
		})
	}


	$(function () {


		$("#item_quantity").change(function () {
			updatePrice();
		});

		$("#extra-size").click(function () {
			$(this).css({"display": "none"});
			$("#extra-size-form").css({"display": "table"});
		});

		$("#extra-size-width").change(function () {
			// 600 стандарт
			var width = parseInt($(this).val());
			if (width > 600 && width <= 1200) {
				$("#factor").val(2);
				updatePrice();
			} else if (width <= 600) {
				$("#factor").val(1);
				updatePrice();
			} else {
				$(this).val(1200);
				alert("Максимальная ширина 1200 мм");
				$("#factor").val(2)
				updatePrice();

			}
		});
		$("#extra-size-height").change(function () {
			// 3000 стандарт
			var width = parseInt($(this).val());
			if (width > 3000) {
				$(this).val(3000);
				alert("Максимальная длина 3000 мм");
				updatePrice();

			}
		});


		$(".qp_item-color-item").click(function () {
			var thisButton = $(this);
			if (thisButton.find(".inner").hasClass("selected")) {
				thisButton.find(".inner").removeClass("selected");
				thisButton.find("input[type=radio]").prop("checked", false);
			} else {
				$(".qp_item-color-item").find(".inner").removeClass("selected");
				thisButton.find(".inner").addClass("selected");
				thisButton.find("input[type=radio]").prop("checked", true);
			}
			var clearPrice = parseInt(thisButton.find(".data-price").html());
			$("#clear-price").html(clearPrice);
			updatePrice();

		});


		$(".qp_item-option-item").click(function () {
			var thisButton = $(this);
			if (thisButton.find(".inner").hasClass("selected")) {
				thisButton.find(".inner").removeClass("selected");
				thisButton.find("input[type=checkbox]").prop("checked", false);
			} else {
//				$(".qp_item-option-item").find(".inner").removeClass("selected");
				var dataOption = thisButton.attr("data-option");
//				alert(dataOption);
				$(".qp_item-option-item").parent().find("div[data-option=\"" + dataOption + "\"] input[type=checkbox]").prop("checked", false);
				$(".qp_item-option-item").parent().find("div[data-option=\"" + dataOption + "\"] .inner").removeClass("selected");
				thisButton.find(".inner").addClass("selected");
				thisButton.find("input[type=checkbox]").prop("checked", true);
			}

			updatePrice();

		});


		$(".qp_item-count-plus").click(function () {
			$("#item_quantity").val(parseInt($("#item_quantity").val()) + 1);
			//$(".qp_item-count-number").html($("#item_quantity").val());
			updatePrice();

		});

		$(".qp_item-count-minus").click(function () {
			var quantity = parseInt($("#item_quantity").val());
			if (quantity > 1) {
				quantity -= 1;
			}
			$("#item_quantity").val(quantity);
			updatePrice();

			//$(".qp_item-count-number").html(quantity);
		});


		$(".qp_item-buy-btn").click(function () {
			addToShoppingCard();
		});

		function addToShoppingCard() {

			if ($('input[name=color]:checked', '#item-form').val()) {
				sendJson($("#item-form").serialize(), "/shop/update/cover", function () {
					window.location.replace("<?= $this->getBackUrl() ?>");
					//$(".qp_item-buy-btn").css({"display": "none"});
					//$(".qp_item-buy-success").css({"display": "block"});
				});
			} else {
				alert("Укажите цвет");
			}
		}


		$("#clear-price").html($('input[name=color]:checked', '#item-form').parent().find(".data-price").html());

		updatePrice();

	});


</script>
