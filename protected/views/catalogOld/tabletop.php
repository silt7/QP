<?php $tabletop = $this->processOutput( $tabletop );
$colors         = $tabletop->getColors();
$price          = 0;
foreach ( $colors as $color ) {
	if ( $color["is_enabled"] ) {
		$price = $color["price"];
		break;
	}
}
?>
<div class="container">
	<ol class="left-m breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<li><a href="/tabletops" class="link">Столешницы</a></li>
		<li class="active"><?= $tabletop->title ?></li>
	</ol>
</div>
<div class="container">

	<div class="row">
		<form id="tabletop-form" method="post">
			<input type="text" hidden="hidden" name="item_id" value="<?= $tabletop->id ?>">

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>

			<div class="col-sm-9">
				<div class="tabletop-container">
					<p>

					<h3><?= $tabletop->title ?></h3></p>
					<div class="col-sm-8 description"><?= $tabletop->description ?></div>
					<div class="col-sm-4 image"><img src="<?= $tabletop->getImage() ?>" alt="<?= $tabletop->title?>"></div>
					<div class="col-sm-12 info">
						<div class="row">
							<div class="count col-sm-3">
								<div class="col-xs-6">Количество</div>
								<div class="input-group col-xs-6">
									<input type="text" name="quantity" id="tabletop-count" class="form-control" value="1" placeholder="0"
									       aria-describedby="count">
									<span class="input-group-addon" id="count">шт</span>
								</div>
							</div>
							<div class="count col-sm-3">
								<div id="clear-price" style="display: none">10000</div>
								<div class="col-xs-6" id="total-price" style="text-align: right"><?= Utils::priceFormat( $price ) ?></div>
								<div class="col-xs-6">Рублей</kr></div>
							</div>
							<div class="count col-sm-1">
								<a class="btn btn-success" onclick="addToShoppingCart()">В корзину</a>
							</div>
							<div class="count col-sm-5">
								<a class="btn btn-default" id="extra-size">Не стандартный размер</a>
								<div class="input-group col-xs-10" id="extra-size-form" style="display: none">
									<span class="input-group-addon" id="count">ширина</span>

									<input type="text" name="count" id="tabletop-count" class="form-control" value="600" placeholder="0"
									       aria-describedby="count">
									<span class="input-group-addon" id="count"> х длина </span>
									<input type="text" name="count" id="tabletop-count" class="form-control" value="3000" placeholder="0"
									       aria-describedby="count">
									<span class="input-group-addon" id="count"> мм </span>
								</div>
							</div>
						</div>


					</div>

					<div class="col-sm-12 colors">
						<? $colorCounter = 1; ?>
						<? $colorsInRow = 8; ?>
						<? $isRowClose = true; ?>
						<? foreach ( $tabletop->getColors() as $color ): ?>
							<? if ( $colorCounter == 1 ):
								$isRowClose = false;?>
								<div class="front-colors-row">
							<?php endif ?>

							<? $colorModel = Color::model()->findByPk( $color["id"] ); ?>
							<div class="front-color-item">
								<img src="<?= $colorModel->getImage() ?>">

								<div class="title"><?= $colorModel->title ?></div>
								<div class="data-price" style="display: none"><?= $color["price"] ?></div>
								<input type="radio" hidden="hidden"
								       value="<?= $colorModel->id ?>"
								       name="tabletop_color" class="m-front-color">
							</div>
							<? if ( $colorCounter == $colorsInRow ):
								$colorCounter = 1;
								$isRowClose   = true;
								?>
								<div class="clear-left"></div>
								</div>
							<?
							else :
								$colorCounter ++;
							endif?>


						<? endforeach ?>
					</div>


				</div>
				<div class="col-sm-12 options" id="tabletop-options">
					<? $group = ""; ?>
					<div class="row">
						<? if ($tabletop->getOptions()) foreach ($tabletop->getOptions() as $option): ?>

						<? $optionModel = ModuleOption::model()->findByPk( $option["id"] ); ?>
						<? if ($group != $option["group"]):
						$group = $option["group"];?>
					</div>
					<div class="row">
						<? endif; ?>
						<a class="btn btn-default data-option-btn">
							<input type="text" hidden="hidden" class="data-price" value="<?= $option["price"] ?>">
							<input hidden="hidden" name="options[]" type="checkbox" value="<?= $option["id"] ?>"><?= $optionModel->title; ?>
						</a>

						<? endforeach ?>

					</div>
				</div>

			</div>

	</div>
</div>
</div>


<script type="text/javascript">
	$(function () {
		$("#nav-catalog").parent().addClass('active');
	})


	$(".front-color-item").click(function () {
		var thisButton = $(this);
		if (thisButton.hasClass("front-color-item-selected")) {
			thisButton.removeClass("front-color-item-selected").find("input.m-front-color").prop("checked", false);
			$("#constructor-hint .c-h-front-color .c-h-color").html("выберете цвет");
		} else {
			$(".front-color-item-selected").removeClass("front-color-item-selected");
			$(".front-color-item-selected").find("input.m-front-color").prop("checked", false);

			thisButton.addClass("front-color-item-selected").find("input.m-front-color").prop("checked", true);
			var clearPrice = parseInt(thisButton.find(".data-price").html());
			$("#clear-price").html(clearPrice);
			updatePrice();

		}
	})


	$(".data-option-btn").click(function () {

		var thisButton = $(this);

		if (thisButton.hasClass("btn-default")) {
			thisButton.parent().find("input[type=checkbox]").prop("checked", false);
			thisButton.parent().find(".btn-success").removeClass("btn-success").addClass("btn-default")
			thisButton.removeClass("btn-default").addClass("btn-success").find("input[type=checkbox]").prop("checked", true);

		} else {
			thisButton.removeClass("btn-success").addClass("btn-default").find("input[type=checkbox]").prop("checked", false);
		}
		updatePrice();
	})


	$("#tabletop-count").change(function () {
		updatePrice();
	});

	$("#extra-size").click(function () {
		$(this).css({"display": "none"});
		$("#extra-size-form").css({"display": "table"});
	});

	function updatePrice() {
		var options = $("#tabletop-options").find("input[type=checkbox]");
		var clearPrice = parseInt($("#clear-price").html());
		var count = parseInt($("#tabletop-count").val());
		var price = 0;
		$.each(options, function (key, object) {

			var $object = $(object);

			if ($object.prop("checked")) {
				price += parseInt($object.parent().find(".data-price").val());
			}
		});
		$("#total-price").html(priceFormat(count * (clearPrice + price)));
	}


	function addToShoppingCart() {
		sendJson($("#tabletop-form").serialize(), "/add/tabletop", function (message) {
			console.log(message);
		}, function (message) {
			alert(message);
		})
	}

</script>