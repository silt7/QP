<?php $item  = $this->processOutput( $item );
$orderLine   = $this->processOutput( $orderLine );
$options     = $orderLine->getOptions();
$selectFrontColor = $options["front_color_id"];

$arrPriceFront = array();
$frontCriteria            = new CDbCriteria;
$frontCriteria->condition = 'id_front=:id_front';
$frontCriteria->params    = array( ':id_front' => $item->id );
$priceColors = PriceFrontColor::model()->findAll( $frontCriteria );
foreach($priceColors as $priceColor){
	$ColorCategory = ColorCategory::model()->findByPk( $priceColor["id_category"] );
	$material = $ColorCategory["name"];
	if(empty($arrPriceFront[$material])){
		$arrPriceFront[$material] = $priceColor["price_category"];
	}
	else{
		$arrPriceFront[$material] += $priceColor["price_category"];
	}
}
?>
<div id="selectColor" hidden><?= $selectFrontColor?></div>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<li><a href="/catalog/fronts" class="link">Фасады</a></li>
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
			<div class="qp_item-price"><span id="item-price"><?= $orderLine->price;?></span> <i>Р</i></div>
			<div id="clear-price" class="data-hidden"><? //= $price ?></div>
			<input type="radio" name="front_color_id" value="<?= $selectFrontColor?>" style="display:none;" checked>
			<input type="radio" name="color_select_front" value="<?= $orderLine->price;?>" style="display:none;" checked>
			

			<? if ( $this->checkRole( "admin" ) ): ?>
				<a href="/admin/item-front/edit/<?= $item->id ?>" class="qp_item-edit"><i class="fa fa-pencil"></i></a>
			<? endif; ?>
			
			<br>
			<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
			<? $colorsCriteria = new CDbCriteria; $colorsCriteria->condition = 'is_module=1'; $module_colors= Color::model() -> findALL($colorsCriteria);?>
			<div> 
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
	$(".color_item").click(function () {
		id = $(this).attr("id").substr(9);
		price = $(this).find("#color_select_front").html();
		$('input[name=front_color_id]:checked', '#item-form').val(id);
		$('input[name=color_select_front]:checked', '#item-form').val(price);
		updatePrice();
	})
	function updatePrice() {
		var count = parseInt($("#item_quantity").val());
		var priceF = $('input[name=color_select_front]:checked', '#item-form').val();
		var price = parseInt(priceF) * count;
		//$('input[name=color_select_front]:checked', '#item-form').val(price);
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
		if ($('input[name=front_color_id]:checked', '#item-form').val()) {
			sendJson($("#item-form").serialize(), "/shop/update/front", function (data) {
				window.location.replace("<?= $this->getBackUrl() ?>");
			});
		} else {
			alert("Укажите цвет");
		}
	}
</script>
