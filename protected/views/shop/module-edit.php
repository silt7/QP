<?php 
	$item        = $this->processOutput( $item );
	$orderLine         = $this->processOutput( $orderLine );
	$options           = $orderLine->getOptions();
	$selectModuleColor = $options['module_color_id'];
	$selectFrontColor  = $options["mod_front_color_id"];
	
	$priceCriteria            = new CDbCriteria;
	$priceCriteria->select    = 'price_color';
	$priceCriteria->condition = 'id_module=:id_module';
	$priceCriteria->params    = array( ':id_module' => $item->id);
	$priceModule =  PriceModuleColor::model()->findAll($priceCriteria);
	
	$arrPriceFront = array();
	foreach(unserialize($item->fronts) as $front){
		$frontCriteria            = new CDbCriteria;
		$frontCriteria->condition = 'id_front=:id_front';
		$frontCriteria->params    = array( ':id_front' => $front["id"]);
		$priceColors = PriceFrontColor::model()->findAll( $frontCriteria );

		foreach($priceColors as $priceColor){
			$ColorCategory = ColorCategory::model()->findByPk( $priceColor["id_category"] );
			$material = $ColorCategory["name"];
			if(empty($arrPriceFront[$material])){
				$arrPriceFront[$material] = $priceColor["price_category"] * $front["count"];
			}
			else{
				$arrPriceFront[$material] += $priceColor["price_category"] * $front["count"];
			}
		}
	}
?>
<div id="selectColor" hidden><?= $selectFrontColor?></div>

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
			<div class="qp_item-price"><span id="item-price"><?= $orderLine->price;?></span> <i>р</i></div>
			<input type="radio" name="moduleModalPrice_inp" value="<?= isset($priceModule[0]->price_color)?$priceModule[0]->price_color:0?>" style="display:none;" checked>
			<input type="radio" name="moduleModalPrice_one" value="<?= isset($priceModule[0]->price_color)?$priceModule[0]->price_color:0?>" style="display:none;" checked>
			<input type="radio" name="moduleFasadPrice_inp" value="0" style="display:none;" checked>
			<input type="radio" name="color_select_module" value="<?= $selectModuleColor;?>" style="display:none;" checked>
			<input type="radio" name="color_select_front" value="<?= $selectFrontColor;?>" style="display:none;" checked>
			
			<div id="clear-price" class="data-hidden"><? //= $price ?></div>
			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-module/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
			<div class="qp_item-description"><?= $item->description ?></div>
			<div id="pre_pay" style="display:none;"><?= $item["pre_pay"] ?></div>
			<input id="pre_pay_inp" name="moduleModalPricePrepay_inp" value="<?= $item["pre_pay"] ?>" style="display:none;">			
				
			<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
			<? $colorsCriteria = new CDbCriteria; $colorsCriteria->condition = 'is_module=1'; $module_colors= Color::model() -> findALL($colorsCriteria);?>
			<div>
				<p class="h1">Цвета модуля</p>
				<div class="select_colors">
					<h3>ЛДСП</h3>
					<?php foreach($module_colors as $color):?>
						<div id='id_color_<?= $color["id"];?>' class='color_item_mod' style='float: left; position: relative;'>
							<div class='qp_item-color-item-title'><?= $color["title"];?>
								<div class='tr'></div>
							</div>
							<img src='/images/colors/<?= $color['id'];?>.png'  width='75' height='75' <?= $selectModuleColor == $color["id"] ? "style='border: 5px solid rgb(255, 201, 13);'" : "" ?>>
							<a href='/images/colors/<?= $color->image;?>.png' class="fancybox" title="<?= $color["title"];?>" style="text-decoration: none;">
								<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
							</a>
						</div>
					<? endforeach; ?>
				</div>
				<br><hr>
				<p class="h1">Цвета фасада</p>
				<div  class="select_colors">
					<h3>Без фасада</h3>
					<div id='id_color_-1' class='color_item'>
						<div id="color_select_front" style="display:none">0</div>
						<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
						<img src='/images/without.jpg'  width='75' height='75' <?= $selectFrontColor == -1 ? "style='border: 5px solid rgb(255, 201, 13);'" : "style='border: 1px solid black'" ?>>
					</div>
				</div>
				<? foreach($arraySort as $item):?>
					<div class="select_colors">
						<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
						foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
						<h3><?= $name_categ==1?$item[0]:""?></h3>
						<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
							<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
								<div id="color_select_front" style="display:none"><?= isset($arrPriceFront[$itemColor->material])?$arrPriceFront[$itemColor->material]:"";?></div>
								<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>			
								<img src='/images/colors/<?= $itemColor->image;?>.png' <?= $selectFrontColor == $itemColor->id ? "style='border: 5px solid rgb(255, 201, 13);'" : "" ?>>
								<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
									<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
								</a>
							</div>
						<?endforeach;endif;endforeach;?>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(".color_item_mod").click(function () {
		id = $(this).attr("id").substr(9);
		$('input[name=color_select_module]:checked', '#item-form').val(id);
		updatePrice();
	})
	$(".color_item").click(function () {
		id = $(this).attr("id").substr(9);
		price = $(this).find("#color_select_front").html();
		$('input[name=color_select_front]:checked', '#item-form').val(id);
		$('input[name=moduleFasadPrice_inp]:checked', '#item-form').val(price);
		updatePrice();
	})
	function updatePrice() {
		var count = parseInt($("#item_quantity").val());
		var priceM = $('input[name=moduleModalPrice_one]:checked', '#item-form').val();
		var priceF = $('input[name=moduleFasadPrice_inp]:checked', '#item-form').val();
		var price = (parseInt(priceM) + parseInt(priceF)) * count;
		$('input[name=moduleModalPrice_inp]:checked', '#item-form').val(price);
		$('#item-price').html(price);
	}
	$(".qp_item-count-plus").click(function () {
		$("#item_quantity").val(parseInt($("#item_quantity").val()) + 1);
		updatePrice();
	});

	$(".qp_item-count-minus").click(function () {
		var quantity = parseInt($("#item_quantity").val());
		if (quantity > 1) {
			quantity -= 1;
		}
		$("#item_quantity").val(quantity);
		updatePrice();
	});
	$(".qp_item-buy-btn").click(function () {
		addToShoppingCard();
	});
	function addToShoppingCard() {
		if ($('input[name=color_select_module]:checked', '#item-form').val() && $('input[name=color_select_front]:checked', '#item-form').val()) {
			sendJson($("#item-form").serialize(), "/shop/update/module", function () {
				window.location.replace("<?= $this->getBackUrl() ?>");
			});
		} else {
			alert("Укажите цвет");
		}
	}
</script>