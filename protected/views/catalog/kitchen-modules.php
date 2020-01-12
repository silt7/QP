<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
<? $colorsCriteria = new CDbCriteria; $colorsCriteria->condition = 'is_module=1'; $module_colors= Color::model() -> findALL($colorsCriteria);?>
<!--<div class="loader"><div class="my_loader"></div></div>-->
<div id="page" style="display:none">modal</div>
<div class="body_main">
	<div class="container">
		<ol class="left-m breadcrumb">
			<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
			<li><a href="/catalog" class="link">Каталог товаров</a></li>
			<li class="active">Кухонные модули</li>
		</ol>
	</div>
	<div class="container">
		<div class="row">
			<?php $active_memu_id = 1; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>
			<div class="col-sm-9 catalog">
				<h1>Кухонные модули</h1>
				<div class="catalog-content"><?= $section->content?></div>
				<div class="row">
					<?php if ( ! is_null( $modules ) ): ?>
						<?php foreach ( $modules as $module ):?>
							<div id="all_filtr" style="display:none"><?= JSON_encode($filtr_module);?></div>
							<div class="<?= $module["filtr"];?>">
								<div class="col-md-3 background_none" data-toggle="modal" id="module-<?= $module["id"]?>" data-target="#front-modal"
									 onclick="openModuleModal('<?= $module["id"]?>', '<?= $module["title"]; ?>', '<?= $module["image"]; ?>', '<?= $module['price'] ?>', '<?= 0;?>',this, <?= $module["pre_pay"]?>, '<?= $module["img_alt"]?>')">
									<div class="item-module-block">
										<div class="image" style="background-image:url('<?= $module["image"] ?>')"></div>
										<div class="data-options" style="display:none"><?=  $module["options"]?></div>
										<div class="data-description" style="display:none"><?= $module["description"];?></div>
										<div class="data-fronts" style="display:none"><?= JSON_encode($module["fronts"]);?></div>
										<div class="title k-ch"><?= $module["title"] ?></div>
										<!--<?if ($this->ActionPrice_gl!= 1):?>
											<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( round($module['price'] / $this->ActionPrice_gl,-1) ) ?> р.</span></span>
										<?endif;?>
										<div class='price'><?= $module['price']?> р.<a class="by-fronts">Купить</a></div>-->
										<div class='price'><a class="by-fronts">Купить</a></div>
									</div>
								</div>
							</div>
						<?endforeach; ?>
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
				<h4 class="modal-title" id="moduleModalTitle">Модуль 1</h4>
			</div>
			<div class="modal-body"  id="cart-form-controls">
				<div class="row controls">
					<div class="col-md-offset-6 col-md-3 col-sm-offset-4 col-sm-4 col-xs-6"></div>
					<!--<div class="col-md-3 col-sm-4 col-xs-6"><a class="btn btn-success" onclick="addFrontToCart()">В корзину</a></div>-->
				</div>
				<form id="front-form">
					<input hidden="hidden" type="text" name="item_id" id="frontModalItemId" value="17">
					<div class="row">
						<div class="col-md-3 col-sm-4 module-item-image">
							<a href="/images/modules/1.jpg" class="fancybox">
								<img id="moduleModalImage" src="/images/modules/1.jpg" alt=""/>
							</a>
						</div>
						<div class="col-md-9 col-sm-8">
							<p id="moduleModalDesc"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<!--<h3>Кухонный модуль <? if($selectFrontColor["id"] == 0): ?><span id="without-front-warning">Без фасада</span><? endif ?></h3>-->
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
								<input type="text" style = "display: none" name ="moduleModalPrice_inp"/>
								<input type="text" style = "display: none" name ="moduleFasadPrice_inp" value="0"/>
								<input type="text" style = "display: none" name ="color_select_module"/>
								<input type="text" style = "display: none" name ="color_select_front"/>
								<div style="display: none" id="coefficient"> </div>
								<div class="col-xs-2" style="text-align: right;"><a class="btn btn-success" onclick="addToCart('module')">В корзину</a></div>
							</div>
							<hr>
							<div class="row" style="margin:0px 30px;">
								<div class="h3" style="text-align: center;">Выберите параметры товара</div>
								<div class="catalog">
									<p class="h4">Цвета корпуса</p>
									<div class="select_colors" style="width: 100%;">
										<p class="h4">ЛДСП</p>
										<?php foreach($module_colors as $color):?>
											<div id='id_color_<?= $color["id"];?>' class='color_item_mod' style='float: left; position: relative;'>
												<div class='qp_item-color-item-title'><?= $color["title"];?>
													<div class='tr'></div>
												</div>
												<img src='/images/colors/<?= $color['id'];?>.png' style="width:50px; height:50px">
												<a href='/images/colors/<?= $color->image;?>.png' class="fancybox" title="<?= $color["title"];?>" style="text-decoration: none;" >
													<br><i class="fa fa-search-plus" style="position: absolute; top: 27px; left: 27px; font-size: 25px;"></i>
												</a>
											</div>
										<? endforeach; ?>
									</div>
									<br><hr>
									<p class="h4">Цвета фасада</p>
									<div  class="select_colors" style="margin-bottom: 5px;">
										<p class="h4">Без фасада</p>
										<div id='id_color_' class='color_item'>
											<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
											<img src='/images/without.jpg' style="border: 1px solid black" style="width:50px; height:50px">
										</div>
									</div>
									<div class="tabset">
										<? unset($arraySort[12]);?>
										<?foreach($arraySort as $item):?>
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