<?php $item = $this->processOutput( $item );

$std_w = $size_std['std_w'];$std_h = $size_std['std_h'];

$colors     = $item->getColors();
$price      = 0;
$price_arr  = array();
if ( $colors )
	foreach ( $colors as $color ) {
		if ( $color["is_enabled"] ) {
		  array_push($price_arr, $color["price"]);
		   //break;
		}
	}
	if(!empty($price_arr)){
		$price = min($price_arr);
	}
?>
<div class="bg-white">
<div class="container">
	<ol class="left-m breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<?foreach($patch as $itemPatch): $link = Folder::model()->findByPk( $itemPatch); ?>
			<li><a href="/catalog/stoleshnicy/<?= $link->id?>" class="link"><?= $link->title?></a></li> 
		<?endforeach;?>
		<li class="active"><?= $item->title ?></li>
	</ol>
</div>

<div class="qp_item with-menu">
    <?php $active_memu_id = 2; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>
	<form id="item-form" class="col-sm-9">
		<input type="hidden" id="item_id" name="item_id" value="<?= $item->id ?>">
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
			<div class="qp_item-price" style="color: #F32727; text-decoration:line-through;"><span style="color: #313B3E;" id="item-price-action"><?= Utils::priceFormat( round($price / $this->ActionPrice_gl, -1)) ?></span></div>
			<? endif; ?>
			<div class="qp_item-price"><span id="item-price"><?= Utils::priceFormat( $price ) ?></span> <i >р</i></div>
			<div class="tocart">
    				<div class="qp_item-buy-btn"><a></i>В корзину</a></div>
    			    <div class="qp_item-buy-success"><i class="fa fa-check"> </i>Товар добавлен в корзину</div>
			</div>
			<input id="price_l" class="data-hidden" value="<?= $price; ?>">
			<div id="clear-price" class="data-hidden"><?= $price ?></div>
			<input id="factor" name="factor" class="data-hidden" value="1">
			<input id="factor_2" name="factor_2" class="data-hidden" value="0">

			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-covers/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
		</div>
		
        <div class="qp_item-options-b">
			<h2 style="text-align: center;">ВЫБЕРИТЕ ПАРМЕТРЫ ТОВАРА</h2>
			<hr style="color: black; margin-top:0;">
			<? $colors = $item->getColors();
			if ( $colors ) :?>
				<h3 class="tabletop-dh">Цвета</h3>
				<div class="qp_item-colors">

					<? /*<div class="title">Цвета</div>*/ ?>

					<? foreach ( $colors as $color ):
						if ( $color["is_enabled"] ):
							$colorModel = Color::model()->findByPk( $color["id"] );
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
						<? endif; endif; ?>

					<? endforeach; ?>
				</div>
			<? endif ?>
			<hr>
			<h3 <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?> class="tabletop-dh qp_size-dh">Параметры товара</h3>
			<div>
			    <div class="qp_size standart-size" <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?>>Стандартный размер  <?= $item->extra_size ? "(".$std_h." мм * ".$std_w." мм)" : "" ?></div>
			    <div class="qp_size custom-size"  <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?>>Указать свой размер</div>
			</div>
			<div class="qp_empty"></div>
            <div class="qp_item-size" <?= ! $item->extra_size ? "style=\"display:none\"" : "" ?>>
				<div id="data-nostd" style="display: none;"><?if(!empty($no_standard)){echo $no_standard;}?></div>
				<span>Ширина</span>
				<input name="width" id="extra-size-width" type="text" value="<?=$std_w;?>">
				<span>Длина</span>
				<input name="length" id="extra-size-height" type="text" value="<?=$std_h;?>">
				<span>мм</span>
			</div>
			<div class="clr"></div>
			<hr class="qp_item-size-hr">
			<? $options = $item->getOptions();
			if ( $options ) :
			$ogroups = ModuleOption::$groups;
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
                    <? if ( $ogroups[$keyo]['name'] != "no_standard"): ?>
						<h3><?= $ogroups[$keyo]['label'] ?></h3>
						<? foreach ( $options as $option):
						$optionModel = ModuleOption::model()->findByPk( $option["id"] );
							if ($optionModel->is_show == 1):?>
								<div class="qp_item-option-item" data-option="<?= $optionModel->group ?>" id="o-<?= $optionModel->id ?>">
									<div class="inner">
										<input type="checkbox" value="<?= $optionModel->id ?>" name="options[]">
										<div class="data-price data-hidden"><?= $option["price"] ?></div>
										<? if ( $optionModel->image ): ?>
											<img style="width: 70px; height: 70px" src="<?= $optionModel->getImage() ?>">
										<? endif ?>
										<div class="qp_item-option-item-title"><div class="c-check"><i class="fa fa-check"></i></div><?= $optionModel->title ?></div>
									</div>
								</div>
						<? endif; endforeach; ?>
					<? endif ?>
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
</div>

<script type="text/javascript">
	$(function () {
		$("#nav-catalog").parent().addClass('active');
	}) 
	function updatePrice() {
		var options = $(".qp_item-options").find("input[type=checkbox]");
		var clearPrice = parseInt($("#clear-price").html());
		var factor = parseInt($("#factor").val());
		var factor_2 = parseInt($("#factor_2").val());
		var count = parseInt($("#item_quantity").val());
		var optionsPrice = 0;
		var ActionPrice_gl = $("#ActionPrice_gl").html();
		$.each(options, function (key, object) {
			var $object = $(object);

			if ($object.prop("checked")) {
				optionsPrice += parseInt($object.parent().find(".data-price").html());
			}
		});
		$("#item-price").html(priceFormat(count * (clearPrice + optionsPrice) * (factor+factor_2)));
		$("#item-price-action").html(priceFormat(Math.round((count * (clearPrice + optionsPrice) * (factor+factor_2))/ActionPrice_gl).toFixed(0)));
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
		$(".standart-size").click(function(){
			$("#factor").val(1);
			$("#extra-size-width").val(<?echo $std_w;?>);
			$("#extra-size-height").val(<?echo $std_h;?>);
			updatePrice();
		})
		$("#extra-size-width").change(function () {
			// 600 стандарт		
			p = jQuery.parseJSON($("#data-nostd").html());
			var width = parseInt($(this).val());
			if($("#item_id").val() == 16){
				if(width >= p.min_w && width <= p.max_w){
					factor();
					updatePrice();
				}else{
					if(width < p.min_w){
						$(this).val(p.min_w);
						alert("Минимальная ширина "+p.min_w+" мм");
						factor();
						updatePrice();
					}
					if(width > p.max_w){
						$(this).val(p.max_w);
						alert("Максимальная ширина "+p.max_w+" мм");
						factor();
						updatePrice();
					}
				}
			}
			else if($("#item_id").val() == 25){
				if(width >= p.min_w && width <= p.max_w){
					if (width <= 500){
						$("#factor").val(1);
						updatePrice();
					} else if(width > 500 && width <= 1000){
						$("#factor").val(2);
						updatePrice();
					} else if (width > 1000){
						$("#factor").val(3);
						updatePrice();
					}
				}
				else{
					$(this).val(p.max_w);
					alert("Максимальная ширина "+p.max_w+" мм \n\r Минимальная ширина "+p.min_w+" мм");
					$("#factor").val(3)
					updatePrice();
				}
			}
			else if($("#item_id").val() == 26){
				if(width >= p.min_w && width <= p.max_w){
					if (width <= 500){
						$("#factor").val(1);
						updatePrice();
					} else if(width > 500 && width <= 1000){
						$("#factor").val(2);
						updatePrice();
					} else if (width > 1000 && width <= 1500){
						$("#factor").val(3);
						updatePrice();
					} else if (width > 1500){
						$("#factor").val(4);
						updatePrice();
					}
				}
				else{
					$(this).val(p.max_w);
					alert("Максимальная ширина "+p.max_w+" мм \n\r Минимальная ширина "+p.min_w+" мм");
					$("#factor").val(4)
					updatePrice();
				}
			}
			else{
				if (width > 600 && width <= p.max_w) {
					$("#factor").val(2);
					updatePrice();
				} else if (width >= p.min_w && width <= 600) {
					$("#factor").val(1);
					updatePrice();
				} else {
					$(this).val(p.max_w);
					alert("Максимальная ширина "+p.max_w+" мм \n\r Минимальная ширина "+p.min_w+" мм");
					$("#factor").val(2);
					updatePrice();
				}
			}
		});
		$("#extra-size-height").change(function () {
			// 3000 стандарт
			p = jQuery.parseJSON($("#data-nostd").html());
			var width = parseInt($(this).val());
			if($("#item_id").val() == 16){
				if (width >= p.min_h && width <= p.max_h){
					factor();
					updatePrice();
				}
				else{
					if(width < p.min_h){
						$(this).val(p.min_h);
						alert("Минимальная длина: "+p.min_h+" мм");
						factor();
						updatePrice();
					}
					if(width > p.max_h){
						$(this).val(p.max_h);
						alert("Максимальная длина: "+p.max_h+" мм");
						factor();
						updatePrice();
					}					
				}
			}
			else{
				if (width > p.max_h || width < p.min_h) {
					
					$(this).val(p.max_h);
					alert("Максимальная длина: "+p.max_h+" мм \n\r Минимальная длина: "+p.min_h+" мм");
					$("#factor_2").val(0);
					updatePrice();
				}
			}
		});
		function factor(){
			var width = parseInt($("#extra-size-width").val());
			var length = parseInt($("#extra-size-height").val());
			if(((width >600)&&(length<=1500))||((length>1500)&&(width<=600))){
				$("#factor").val(2);
			}
			else if((length>1500)&&(width>600)){
				$("#factor").val(4);
			}
			else{
				$("#factor").val(1);
			}

		}
		
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
/* 				sendJson($("#item-form").serialize(), "/shopping-cart/cover/add", function () {
					$(".qp_item-buy-btn").css({"display": "none"});
					$(".qp_item-buy-success").css({"display": "block"});
					alert("Товар добавлен в корзину");
					location.reload();
				}); */
				$.ajax({
					type: "POST",
					url: '/shopping-cart/cover/add',
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
			} else {
				alert("Укажите цвет");
			}


		}

	});
    $(function() {
        var box = $('.fix'); // float-fixed block

        var top = box.offset().top - parseFloat(box.css('marginTop').replace(/auto/, 0));
        $(window).scroll(function(){
            var windowpos = $(window).scrollTop();
            if(windowpos < top) {
                box.css('position', 'static');
            } else {
                box.css('position', 'fixed');
                box.css('top', 0);
            }
        });
    });

</script>