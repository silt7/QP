<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
<div id="page" style="display:none">front</div>
<div class="body_main">
	<div class="container">
		<ol class="left-m breadcrumb">
			<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
			<li><a href="/catalog" class="link">Каталог товаров</a></li>
			<li class="active">Кухонные фасады</li>
		</ol>
	</div>
	<div class="container" style="background: #fff;">
		<div class="row">
			<?php $active_memu_id = 4; $catalogMenu = $this->getCatalogMenuArray(); $openCatalogItemId = null; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>
			<div class="col-sm-9 catalog">
				<h1>Кухонные фасады</h1>
				<div class="catalog-content"><?= $section->content?></div>
				<div class="row">
					<?php if ( ! is_null( $fronts ) ): ?>
					<div id="all_filtr" style="display:none"><?= JSON_encode($filtr_front);?></div>
						<?php foreach ( $fronts as $frontsItem ):?>
							<div class="<?= $frontsItem['filtr'];?>">
								<div class="col-md-3" data-toggle="modal" id="front-<?= $frontsItem["id"] ?>" data-target="#front-modal" style="height:315px;"
										onclick="openFrontModal('<?= $frontsItem["id"] ?>','<?= $frontsItem["title"] ?>', '<?= $frontsItem["price"] ?>', '<?= $frontsItem["image"] ?>', 'front-<?= $frontsItem["id"] ?>', '<?= $frontsItem["img_alt"] ?>')">
									<div class="item-module-block">
										<div class="data-options" style="display: none"><?= $frontsItem["options"] ?></div>
										<div class="data-nostd" style="display: none"><?if(!empty($frontsItem["no_standard"])){echo $frontsItem["no_standard"];}?></div>
										<div class="data-description" style="display: none"><?= $frontsItem["description"] ?></div>

										<div class="image" style="background-image:url('<?= $frontsItem["image"] ?>')"></div>
										<? if($frontsItem['id'] > 5){ ?>
											<div class="title"><?= $frontsItem["title"] ?></div>
											<!--
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( round($frontsItem["price"]  / $this->ActionPrice_gl,-1) ) ?> р.</span></span>
											<?endif;?>
											<div class="price by-price"><?= $frontsItem["price"] ?> р.<a class="by-fronts">Купить</a></div>
											-->
											<div class="price by-price"><a class="by-fronts">Купить</a></div>
										<? }else {?> <div class="title"><?= $frontsItem["title"] ?></div><div class="price"></div><?}?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

				</div>
				
				<div class="catalog-content"><?= $section->content2?></div>
			</div>		
		</div>
	</div>
</div>
<div class="modal module-modal" id="front-modal" tabindex="-1" role="dialog" aria-labelledby="Подробная информация" aria-hidden="true">
	<div class="modal-dialog modal-md" style="width:70%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<h4 class="modal-title" id="frontModalTitle">Модуль 1</h4>
			</div>
			<div class="modal-body">
				<div class="row controls" id="cart-form-controls">
					<div class="col-md-offset-6 col-md-3 col-sm-offset-4 col-sm-4 col-xs-6"></div>
					
				</div>
				<form id="front-form">
					<input type="text" name="item_id" id="frontModalItemId" style="display:none;">
					<div class="row">
						<div class="col-md-3 col-sm-4 image"><a href="/images/item_modules/cfcd208495d565ef66e7dff9f98764da.jpg" class="fancybox"><img id="frontModalImage" src="/images/item_modules/cfcd208495d565ef66e7dff9f98764da.jpg" alt=""/></a></div>
						<div class="col-md-9 col-sm-8">
							<div id="moduleModalDesc"></div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-12 col-sm-12">
							<div class="row" style="margin: 0 30px;">
								<div class="price col-xs-2">
									Количество
								</div>
								<div class=" col-xs-2">	
									<div class="input-group">
										<input type="text" name="quantity" id="frontModalItemQuantity" class="form-control" value="1" placeholder="0"
											   aria-describedby="count-1">
										<span class="input-group-addon" id="count-1"><span class="plus">+</span><span class="minus">-</span>шт</span>
									</div>
								</div>
								<input type="hidden" id="color_select_front" name="color_select_front" value="<?= $selectFrontColor["id"]?>">
								<div class=" col-xs-2 price">Цена</div>
								<div class="data-options data-price" style="display: none"></div>
								<div style = "display: none" id="frontModalPrice"></div>
								<div class="col-xs-4 total-price" id="frontModalTotalPrice"></div>
								<div style="display: none" id="coefficient"> </div>
								<div class="col-xs-2" style="text-align: right;"><a class="btn btn-success" onclick="addToCart('front')">В корзину</a></div>
							</div>
							<hr>
							<div class="row" style="margin: 0 30px;">
								<div class="h3">Выберите параметры товара</div>
								<div class="tabset">
								<?unset($arraySort[12]);?>
									<? foreach($arraySort as $item):?>
										<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
											foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
										<input type="radio" name="tabset" id="<?= $itemColor['material'];?>" aria-controls="<?= $itemColor['material'];?>" checked>
										<label for="<?= $itemColor['material'];?>"><?= $name_categ==1?$item[0]:""?></label>
									<?endforeach;?>
									<div class="tab-panels">							  
									<? foreach($arraySort as $item):?>									
										<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
											foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
										<section id="<?= $itemColor['material'];?>" class="tab-panel">
											<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
												<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
													<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>
													<img src='/images/colors/<?= $itemColor->image;?>.png' style="width:50px; height:50px">
													<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
														<br><i class="fa fa-search-plus" style="position: absolute; top: 27px; left: 27px; font-size: 25px;"></i>
													</a>
												</div>
											<?endforeach;endif;endforeach;?>
										</section>										
									<?endforeach;?>		
									</div>
								</div>
							</div>
							<div id="wxh">
								<div id="range" style="display: none"></div>
								<br>
								<ul style="list-style-type: none;">
									<li>Длина:&nbsp&nbsp&nbsp <input type="text" name="LENGTH" id="front_length" value="0" onkeyUp="return proverka(this);"> (мм)<div id="nostdH">от 100 мм до 2200 мм</div></li>
									<li>Ширина:&nbsp <input type="text" name="WIDTH" id="front_width" value="0" onkeyUp="return proverka(this);"> (мм)<div id="nostdW">от 100 мм до 1200 мм</div></li>
								</ul>
							</div>
							
							<p class="h4" style="margin:0px 30px; display:none;">Опции</p>
							<div id="frontModalOptions" class="module-modal-options" style="margin:0px 55px;">
								<!--									<a class="btn btn-default">Опция 1</a>-->
								<!--									<a class="btn btn-default">Опция 2</a>-->
								<!--									<a class="btn btn-default">Опция 3</a>-->
							</div>

						</div>

					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script src="/js/modalModule.js" type="text/javascript"></script>