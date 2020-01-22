<? $item = $this->processOutput( $item ); ?>
<div class="body_main">
	<div class="container">
	<ol class="left-m breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<? if($this->getBackUrl() == "http://qp-kuhni.ru/catalog/kuhonnye-aksessuary/47"): ?>
			<li><a href="/catalog/kuhonnye-aksessuary/8" class="link">Кухонные столешницы</a></li>
			<li><a href="/catalog/kuhonnye-aksessuary/47" class="link">Аксессуары для столешницы</a></li>
		<?elseif($this->getBackUrl() == "http://qp-kuhni.ru/catalog/kuhonnye-aksessuary/48"):?>
			<li><a href="/catalog/kuhonnye-aksessuary/9" class="link">Стеновые панели</a></li>
			<li><a href="/catalog/kuhonnye-aksessuary/48" class="link">Аксессуары для панелей</a></li>
		<?else:?>
			<?foreach($patch as $itemPatch): $link = Folder::model()->findByPk( $itemPatch); ?>
				<li><a href="/catalog/kuhonnye-aksessuary/<?= $link->id?>" class="link"><?= $link->title?></a></li> 
			<?endforeach;?>
		<?endif;?>
				<li class="active"><?= $item->title ?></li>
		</ol>
	</div>
<div class="qp_item  with-menu">
	<form id="item-form">
		<input type="hidden" name="item_id" value="<?= $item->id ?>">
		<?php if($this->getBackUrl() == "http://qp-kuhni.ru/catalog/kuhonnye-aksessuary/47"){
					$active_memu_id = 2; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); }
				elseif($this->getBackUrl() == "http://qp-kuhni.ru/catalog/kuhonnye-aksessuary/48"){
					$active_memu_id = 3; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); }
				else{
					$active_memu_id = 5; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); 
				}
	 ?>
        
        <div class="col-sm-9">
<div class="row">
			<div class="qp_item-title"><?= $item->title ?></div>
			<div class="qp_item-left">
				<div class="qp_item-image">
					<a href="<?= $item->getImage() ?>" class="fancybox">
					<img class="image-link" src="<?= $item->getImage() ?>" alt="<?= $item->title ?>"
						 data-mfp-src="<?= $item->getImage() ?>"/></a>
				</div>
				<? /*<a class="qp_item-back-btn" href="<?= $this->getBackUrl() ?>"><i class="fa fa-angle-left"></i>Назад</a> */ ?>

				
				<? /*<div class="qp_item-buy-btn"><a><i class="fa fa-shopping-cart"> </i>Купить</a></div>
				<div class="qp_item-buy-success"><i class="fa fa-check"> </i>Товар добавлен в корзину</div> */ ?>
			</div>
			<div class="qp_item-right">
				<? if($item->description) ?>
				<div class="qp_item-description"><?= $item->description ?></div>
			</div>
		</div>
		<div class="row fix">
			<div class="qp_item-price-caption">КОЛИЧЕСТВО:&nbsp</div>
			<div class="qp_item-count">
			    <div class="qp_item-count-number"><input name="quantity" id="item_quantity" value="1"></div>
				<div class="qp_item-count-minus"><i class="fa fa-minus"> </i></div>
				<div class="qp_item-count-plus"><i class="fa fa-plus"> </i></div>
				<!--<div class="qp_item-count-sht">шт</div>-->
			</div>
			<div class="qp_item-price-caption">ЦЕНА:</div>
			<div id="ActionPrice_gl" style="display:none"><?= $this->ActionPrice_gl;?></div>
			<? if($this->ActionPrice_gl != 1):?>
			<div class="qp_item-price" style="color: #F32727; text-decoration:line-through;"><span style="color: #313B3E;" id="item-price-action"><?= Utils::priceFormat( round($item->price  / $this->ActionPrice_gl, -1)) ?></span></div>
			<? endif; ?>
			<div class="qp_item-price"><span id="item-price"><?= Utils::priceFormat( $item->price  ) ?></span> <i >р</i></div>
			<div class="tocart">
    				<div class="qp_item-buy-btn"><a></i>В корзину</a></div>
    			    <div class="qp_item-buy-success"><i class="fa fa-check"> </i>Товар добавлен в корзину</div>
			</div>
			<input id="price_l" class="data-hidden" value="<?= $item->price ; ?>">
			<div id="clear-price" class="data-hidden"><?= $item->price  ?></div>
			<input id="factor" name="factor" class="data-hidden" value="1">
			<input id="factor_2" name="factor_2" class="data-hidden" value="0">

			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-covers/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
		</div>
	    </div>
		<?$colors = unserialize($item -> colors);?>
		<?if ( $colors ) :?>
			<hr style="color: black; margin-top:0;">
			<h3 class="tabletop-dh">Цвета</h3>
			<div class="qp_item-colors">
				<? foreach ( $colors as $color ):
					if ( $color["is_enabled"] ):
						$colorModel = Color::model()->findByPk( $color["id"] );
						if (isset($colorModel)):
							if ( $colorModel->is_show == 1 ):?>
							<div class="qp_item-color-item">
								<div class="inner">
									<input type="radio" value="<?= $colorModel->id ?>" name="color">

									<div class="data-price data-hidden"><?= $color["price"] ?></div>

									<img src="<?= $colorModel->getImage() ?>.png" height="75" width="75">
									<div class="qp_item-color-item-title"><?= $colorModel->title ?><div class="tr"></div></div>
									<a href='/images/colors/<?= $colorModel->image;?>.png' class="fancybox" title="<?= $colorModel->title ?>" style="text-decoration: none;">
										<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
									</a>
								</div>

							</div>
					<? endif; endif; endif;?>

				<? endforeach; ?>
			</div>
		<?endif;?>
			<div class="qp_item-options-b" style="float: right;">
				<? $options = $item->getOptions();
				if ( $options ) :
					echo '<hr>';
				$ogroups = array(
					'loop'                    => array( 'name' => 'loop', 'label' => 'Петли' ),
					'guides'                  => array( 'name' => 'guides', 'label' => 'Направляющие' ),
					'milling'                 => array( 'name' => 'milling', 'label' => 'Фрезеровка' ),
					'aluminum_frame'          => array( 'name' => 'aluminum_frame', 'label' => 'Алюминиевая рамка' ),
					'glass_color'             => array( 'name' => 'glass_color', 'label' => 'Цвет стекла' ),
					'left_part'               => array( 'name' => 'left_part', 'label' => 'Левый край' ),
					'right_part'              => array( 'name' => 'right_part', 'label' => 'Правый край' ),
					'bevel'               => array( 'name' => 'bevel', 'label' => 'Скос' ),
					'curve'              => array( 'name' => 'curve', 'label' => 'Закругление' ),
					'2_border_radius'         => array( 'name' => '2_border_radius', 'label' => 'Двухстороннее закругление' ),
					'washing_color'           => array( 'name' => 'washing_color', 'label' => 'Цвет мойки' ),
					'height'                  => array( 'name' => 'height', 'label' => 'Высота' ),
					'3d_color'                => array( 'name' => '3d_color', 'label' => 'Цвет 3D канта' ),
					'double_sided_lamination' => array( 'name' => 'double_sided_lamination', 'label' => 'Двухсторонняя ламинация' ),
				);
				?>
					<div class="qp_item-options">
						<? /*<div class="title">Опции</div>*/ ?>
						<?  $optionsg = Array(); $i = 0; foreach ( $options as $option ): 
							if ( $option["is_enabled"] ):
								 $optionsg[$option["group"]][$i]['id'] = $option["id"];
								 $optionsg[$option["group"]][$i]['price'] = $option["price"];
								 /*$optionModel = ModuleOption::model()->findByPk( $option["id"] );  ?><br>
								<div class="qp_item-option-item" data-option="<?= $optionModel->group ?>">
									<div class="inner">
										<input type="checkbox" value="<?= $optionModel->id ?>" name="options[]">
										<div class="data-price data-hidden"><?= $option["price"] ?></div>
										<? if ( $optionModel->image ): ?>
											<img src="<?= $optionModel->getImage() ?>">
										<? endif ?>
										<?= $optionModel->title ?>
										<?= $ogroups[$optionModel->group]['label'] ?>
									</div>
								</div>
							<? */ $i++; endif ?>

						<? endforeach;  ?>
					<? $optionsg = array_reverse($optionsg); foreach ( $optionsg as $keyo=>$options ): ?>
					<div class="qp_item-option-item-wraper wraper-x-<?= count($options) ?>">
						<h3><?= $ogroups[$keyo]['label'] ?></h3>
						<? foreach ( $options as $option):
						$optionModel = ModuleOption::model()->findByPk( $option["id"] );?>
								<div class="qp_item-option-item" data-option="<?= $optionModel->group ?>" id="o-<?= $optionModel->id ?>">
									<div class="inner">
										<input type="checkbox" value="<?= $optionModel->id ?>" name="options[]">
										<div class="data-price data-hidden"><?= $option["price"] ?></div>
										<? if ( $optionModel->image ): ?>
											<img src="<?= $optionModel->getImage() ?>">
										<? endif ?>
										<div class="qp_item-option-item-title"><div class="c-check"><i class="fa fa-check"></i></div><?= $optionModel->title ?></div>
									</div>
								</div>
						<? endforeach; ?>
					</div>
					
					<? endforeach; ?>
					</div>
				<? endif ?>
						
				<hr>
				<a class="qp_item-back-btn" href="<?= $this->getBackUrl() ?>"><i class="fa fa-angle-left"></i>Назад</a>
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
		var count = parseInt($("#item_quantity").val());
		var optionsPrice = 0;
		$.each(options, function (key, object) {

			var $object = $(object);

			if ($object.prop("checked")) {
				optionsPrice += parseInt($object.parent().find(".data-price").html());
			}
		});
		$("#item-price").html(priceFormat(count * (clearPrice + optionsPrice)));
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
/* 
			sendJson($("#item-form").serialize(), "/shopping-cart/accessory/add", function () {
				$(".qp_item-buy-btn").css({"display": "none"});
				$(".qp_item-buy-success").css({"display": "block"});
			}); */
			$.ajax({
				type: "POST",
				url: '/shopping-cart/accessory/add',
				dataType: "json",
				data: $("#item-form").serialize(),
				success: function(data){
					p = jQuery.parseJSON(data.data);
					var count  = parseInt($("#shopping-cart-quantity").text()) + parseInt(p.quantity);
					$("#shopping-cart-quantity").text(count);
					var price = parseInt($("#shopping-cart-price").text().replace(/\s+/g, '')) + parseInt(p.quantity) * parseInt(p.price);
					$("#shopping-cart-price").text(price);
					alert('Товар добавлен в корзину');
				}
			});
		}

	});


</script>