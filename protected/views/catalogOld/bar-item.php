<?php $item = $this->processOutput( $item );
$colors     = $item->getColors();
$price      = 0;
if ( $colors )
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
		<li><a href="/catalog/bars" class="link">Барные стойки</a></li>
		<li class="active"><?= $item->title ?></li>
	</ol>
</div>

<div class="qp_item">
	<form id="item-form">
		<input type="hidden" name="item_id" value="<?= $item->id ?>">


		<div class="qp_item-left">
			<div class="qp_item-image">
				<img class="image-link" src="<?= $item->getImage() ?>" alt=""
				     data-mfp-src="<?= $item->getImage() ?>"/>
			</div>
			<a class="qp_item-back-btn" href="<?= $this->getBackUrl() ?>"><i class="fa fa-angle-left"></i>Назад</a>

			<div class="qp_item-count">
				<div class="qp_item-count-minus"><i class="fa fa-minus"> </i></div>
				<div class="qp_item-count-number"><input name="quantity" id="item_quantity" value="1"></div>
				<div class="qp_item-count-plus"><i class="fa fa-plus"> </i></div>
			</div>
			<div class="qp_item-buy-btn"><a><i class="fa fa-shopping-cart"> </i>Купить</a></div>
			<div class="qp_item-buy-success"><i class="fa fa-check"> </i>Товар добавлен в корзину</div>
		</div>
		<div class="qp_item-right">
			<div class="qp_item-title"><?= $item->title ?></div>
			<div class="qp_item-price"><span id="item-price"><?= Utils::priceFormat( $price ) ?></span> <i class="fa fa-rub"></i></div>
			<div id="clear-price" class="data-hidden"><?= $price ?></div>
			<input id="factor" name="factor" class="data-hidden" value="1">

			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-covers/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
			<div class="qp_item-description"><?= $item->description ?></div>

			<div class="qp_item-size" <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?>>
				<span>Ширина</span>
				<input name="width" id="extra-size-width" type="text" value="600">
				<span>Длина</span>
				<input name="length" id="extra-size-height" type="text" value="3000">
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
								<div class="inner">
									<input type="radio" value="<?= $colorModel->id ?>" name="color">

									<div class="data-price data-hidden"><?= $color["price"] ?></div>

									<img src="<?= $colorModel->getImage() ?>">
									<?= $colorModel->title ?>
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
						$optionModel = ModuleOption::model()->findByPk( $option["id"] );?>

						<div class="qp_item-option-item" data-option="<?= $optionModel->group ?>">
							<div class="inner">
								<input type="checkbox" value="<?= $optionModel->id ?>" name="options[]">

								<div class="data-price data-hidden"><?= $option["price"] ?></div>

								<? if ( $optionModel->image ): ?>
									<img src="<?= $optionModel->getImage() ?>">
								<? endif ?>

								<?= $optionModel->title ?>
							</div>

						</div>
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
				sendJson($("#item-form").serialize(), "/shopping-cart/cover/add", function () {
					$(".qp_item-buy-btn").css({"display": "none"});
					$(".qp_item-buy-success").css({"display": "block"});
				});
			} else {
				alert("Укажите цвет");
			}


		}

	});


</script>
