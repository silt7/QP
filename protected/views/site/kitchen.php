<?
$price = 0;
if($kitchen->deconstruct == 0){
	$price = $kitchen->price;
}
else{
	$price = $kitchen->price2;
}
?>
<? $kitchen = $this->processOutput( $kitchen ); 
   $this->pageTitle = $kitchen->title;
	$designer = Page::model()->findByPk( 14 );
	$frontColorCriteria            = new CDbCriteria;
	$frontColorCriteria->condition = 'is_show=:is_show and type=:type';
	$frontColorCriteria->params    = array( ':is_show' => "1", ':type' => 'front' );
	$frontColorCriteria->order     = "material asc";
	$frontColors = Color::model()->findAll( $frontColorCriteria );
?>
<!-- fotorama.css & fotorama.js. -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
<style>
	.fotorama--fullscreen .fotorama__fullscreen-icon {
        width:40px;
        height:40px;
        background: url(/images/close.png) no-repeat;
        background-size: 100%;
        margin: 10px;
    }
	.kitchen-page a.Rectangle-3{
		background:#ffc500;
		color:#323232;
		cursor:pointer;
		text-align:center;	
		position:absolute;	
		bottom:15px;
	}
	.kitchen-page a.Rectangle-3 span{
		background: #fff;
		width: 25px;
		height: 25px;
		display: inline-block;
		text-align: center;
		border-radius: 15px;
		vertical-align: middle;
		line-height: 25px;
	}
	#content .edit-panel{
		margin-right:10px;
		margin-left: 10px;
		background: #fff;
	}
	.kitchen-page .kitchen-page__fotorama{
		cursor:pointer;
	}
	#content .kitchen-block .edit-panel:hover .filtr2:before {
		content: '';
		display: block;
		width: 100%;
		height: 250px;
		opacity: 0.5;
		background-image: none;
		background-color: #ffc500;
		position: absolute;
		left: 0;
		top: 0;
		z-index: 3;
	}
	@media only screen and (max-width: 900px){
		.kitchen-page a.Rectangle-3{
			bottom:-40px;
		}
		.kitchens__price_actual{
			width:100%;
			display:block;
		}
		.fotorama__fullscreen-icon{
			width:100%;
			height:100%;
			background: none;
		}
	}
</style>
<div id="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-5 title"><?= $kitchen->title ?></div>
			<div class="col-md-7 bc">
				<ol>
					<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
					<li><a href="/gotovye-kuhni" class="link">Готовые кухни</a></li>
					<li class="active"><?= $kitchen->title ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>

<!-- Новый контейнер-->
<div id="content" class="container kitchen-page">
	<div class="row">
		<!-- Начало Главного блока -->
		<div class="col-md-8">
			<div class="row" style=" display: flex;flex-wrap: wrap;">
				<div class="col-md-7 kitchen-page__main-title" style="border-right:none;">
					<h1 style='font-size:32px;'><?= $kitchen->title ?></h1>
					<div id="id_kitchen" style="display:none"><?= $kitchen->id ?></div>
					<div class="row">
						<div class="col-md-12">
						    <noindex>
    							<div class="kitchens__price"  rel="nofollow">
    							<span>Стоимость: </span>
    								<span style="color: #F32727; text-decoration: line-through;padding-left:25px;padding-right:25px;"><span style="color: #000">
    								<?if ($this->ActionPrice_gl!= 1):?>
    									<span style="color: #F32727; text-decoration: line-through;"><span style="color: #333"><?= Utils::priceFormat( round($price  / $this->ActionPrice_gl,-1) ) ?> руб.</span></span>
    								<?endif;?>
    								</span></span>
    								<span class="kitchens__price_actual" style="color:#ffc500;"><?= Utils::priceFormat($price) ?> руб.</h3><!-- <i class="fa fa-rub" aria-hidden="true"></i> --></span>
    							</div>
    						</noindex>
						</div>
					</div>
				</div>
				<div class="col-md-5" style="position:relative;">
					<!--<a class="kitchen-page__btn-info" href="" data-toggle="modal" data-target="#callback-modal"><i class="fa fa-info-circle" aria-hidden="true"></i> Бесплатная консультация по этой кухне или подбор похожей</a>-->
					<a class="Rectangle-3" data-toggle="modal" data-target="#callback-modal" onclick="typeModal('order');">
						Заказать кухню <span><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
					</a>
				</div>
			</div>
			<div style="position: relative;">
				<div class="kitchen-page__kitchen-info" data-toggle="modal" data-target="#calculate-price-modal" style="cursor:pointer;">
					<i class="fa fa-calculator" aria-hidden="true"></i> Можем изготовить эту кухню по индивидуальным размерам и цветам
				</div>
				<div class="kitchen-page__fotorama">
					<div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-arrows="always">
						
						<img src="/images/kitchens/<?= $kitchen->image ?>">
						<? if(!empty($kitchen->img_add)): $imagesAdd = unserialize($kitchen->img_add);?>
						 
						 <? foreach($imagesAdd as $item):?>
							<img src="/images/kitchens/<?= $item['img'];?>" alt="<?= $item['alt'];?>"/>
						<? endforeach ?>
						<? endif ?>
					</div>
				</div>
			</div>
			<!--
			<div class="kitchen-page__kitchen-readmore" data-toggle="modal" data-target="#callback-modal">
                 <i class="fa fa-calculator" aria-hidden="true"></i> Можем изготовить эту кухню по индивидуальным размерам и цветам <span class="kitchen-page__kitchen-readmore_more">Подробнее</span>
             </div>
			 -->
			<div id="call-block">				
				<div class="row">	
					<div class="col-lg-6">
						<div id="free-design" data-toggle="modal" data-target="#designer-modal" class="main-banner" style="background: url('/images/main/callDesign.jpg');" onclick="typeModal('design')">
							<p>Бесплатный вызов<br>дизайнера</p>
							<button>Заказать вызов дизайнера<img src="/images/main/btn_cost.svg"></button>
							<!--<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>-->
						</div>
					</div>
					<div class="col-lg-6">
						<a class="a-calc" data-toggle="modal" data-target="#calculate-price-modal" style="text-decoration:none"> <!--onclick="yaCounter31370493.reachGoal(free-payment');"--><div id="free-payment" class="main-banner" style="background: url('/images/main/free-calc.png');"> 
						<!--data-toggle="modal" onclick="initPopupSliders()" data-target="#calculate-price-modal"-->
							<p>Рассчитать по размерам</p>
							<button>Получить проект мечты<img src="/images/main/btn_project.svg"></button>
							<!--<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>-->
						</div></a>
					</div>
				</div>			
			</div>
			<? if($kitchen->description!=""):?>
				<div class="kitchen-page__item">
					<h2 class="kitchen-page__item_title">
						Описание <?= $kitchen->title ?>
					</h2>
					<p id="moduleModalDesc"><?= htmlspecialchars_decode($kitchen->description, ENT_NOQUOTES)?></p>
				</div>
			<?endif?>
			<? if($kitchen->description2!=""):?>
				<div class="kitchen-page__item">
					<h3 class="kitchen-page__item_title">
						Характеристики <?= $kitchen->title ?>
					</h3>
					<p id="moduleModalDesc"><?= htmlspecialchars_decode($kitchen->description2, ENT_NOQUOTES)?></p>
				</div>
			<?endif?>
			
			
			<? if($kitchen->deconstruct == 1):?>
				<!--
				<div class="kitchen-page__item">
					<h4 class="kitchen-page__item_title">
						Основные товары
					</h4>
					<div class="row">
						<?if(isset($kitchenDeconstruct['module'])):?>
							<?foreach($kitchenDeconstruct['module'] as $item):?>
								<?if($item->price > 0):?>
									<? $module = ItemModule::model()->findByPk($item->id_module);?>
									<div class="col-md-3" id="<?= $item->id_module?>">
										<div class="item-module-block module_b" data-toggle="modal" data-target="#kitchen-modal">
											<div class="image" style="background-image:url('/images/item_modules/<?= $module["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $module["options"]?></div>
											<div class="data-description" style="display:none"><?= $module["description"];?></div>
											<div class="title k-ch"><?= $module["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?> р.</span></span>
											<?endif;?>
											<div class='price'><?= $item ->price?> р.<a class="by-fronts">Купить</a></div>
											<div id="front_title" style="display:none"><?//= //$module["front_title"] ?><br></div>
											<div id="front_price" style="display:none"><?//= //$module["price_front"] ?></div>
											<div id="front_price_prepay" style="display:none"><?//=// $module["front_price_prepay"] ?></div>
											<div id="front_option" style="display:none"><?//=// $module["front_options"];?></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstruct['front'])):?>
							<?foreach($kitchenDeconstruct['front'] as $item):?>
								<?if($item->price > 0):?>
									<? $front = ItemFront::model()->findByPk($item->id_front);?>
									<div class="col-md-3" id="<?= $item->id_front?>">
										<div class="item-module-block front_b" data-toggle="modal" data-target="#kitchen-front">
											<div class="image" style="background-image:url('/images/item_fronts/<?= $front["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $front["options"]?></div>
											<div class="data-description" style="display:none"><?= $front["description"];?></div>
											<div class="title k-ch"><?= $front["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?> р.</span></span>
											<?endif;?>
											<div class='price'><?= $item ->price?> р.<a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstruct['cover'])):?>
							<?foreach($kitchenDeconstruct['cover'] as $item):?>
								<?if($item->price > 0):?>
									<? $cover = ItemCover::model()->findByPk($item->id_cover);?>
									<div class="col-md-3" id="<?= $item->id_cover?>">
										<div class="item-module-block cover_b" data-toggle="modal" data-target="#kitchen-cover">
											<div class="image" style="background-image:url('/images/item_tabletops/<?= $cover["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $cover["options"]?></div>
											<div class="data-description" style="display:none"><?= $cover["description"];?></div>
											<div class="title k-ch"><?= $cover["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?> р.</span></span>
											<?endif;?>
											<div class='price'><?= $item ->price?> р.<a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstruct['access'])):?>
							<?foreach($kitchenDeconstruct['access'] as $item):?>
								<?if($item->price > 0):?>
									<? $cover = Accessory::model()->findByPk($item->id_access);?>
									<div class="col-md-3" id="<?= $item->id_access?>">
										<div class="item-module-block cover_b" data-toggle="modal" data-target="#kitchen-cover">
											<div class="image" style="background-image:url('/images/item_tabletops/<?= $cover["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $cover["options"]?></div>
											<div class="data-description" style="display:none"><?= $cover["description"];?></div>
											<div class="title k-ch"><?= $cover["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?> р.</span></span>
											<?endif;?>
											<div class='price'><?= $item ->price?> р.<a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					</div>
				</div>
				-->
				<div class="kitchen-page__item">
					<h4 class="kitchen-page__item_title">
						<!--Дополнительные товары-->
					</h4>
					<div class="row">
						<?if(isset($kitchenDeconstructAdd['module'])):?>
							<?foreach($kitchenDeconstructAdd['module'] as $item):?>
								<?if($item->price > 0):?>
									<? $module = ItemModule::model()->findByPk($item->id_module);?>
									<div class="col-md-3" id="<?= $item->id_module?>">
										<div class="item-module-block module_b" data-toggle="modal" data-target="#kitchen-modal">
											<div class="image" style="background-image:url('/images/item_modules/<?= $module["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $module["options"]?></div>
											<div class="data-description" style="display:none"><?= $module["description"];?></div>
											<div class="title k-ch"><?= $module["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?//= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?> </span></span>
											<?endif;?>
											<div class='price'><?//= $item ->price?> <a class="by-fronts">Купить</a></div>
											<div id="front_title" style="display:none"><?//= //$module["front_title"] ?><br></div>
											<div id="front_price" style="display:none"><?//= //$module["price_front"] ?></div>
											<div id="front_price_prepay" style="display:none"><?//=// $module["front_price_prepay"] ?></div>
											<div id="front_option" style="display:none"><?//=// $module["front_options"];?></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstructAdd['front'])):?>
							<?foreach($kitchenDeconstructAdd['front'] as $item):?>
								<?if($item->price > 0):?>
									<? $front = ItemFront::model()->findByPk($item->id_front);?>
									<div class="col-md-3" id="<?= $item->id_front?>">
										<div class="item-module-block front_b" data-toggle="modal" data-target="#kitchen-front">
											<div class="image" style="background-image:url('/images/item_fronts/<?= $front["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $front["options"]?></div>
											<div class="data-description" style="display:none"><?= $front["description"];?></div>
											<div class="title k-ch"><?= $front["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?//= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?></span></span>
											<?endif;?>
											<div class='price'><?//= $item ->price?><a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstructAdd['cover'])):?>
							<?foreach($kitchenDeconstructAdd['cover'] as $item):?>
								<?if($item->price > 0):?>
									<? $cover = ItemCover::model()->findByPk($item->id_cover);?>
									<div class="col-md-3" id="<?= $item->id_cover?>">
										<div class="item-module-block cover_b" data-toggle="modal" data-target="#kitchen-cover">
											<div class="image" style="background-image:url('/images/item_tabletops/<?= $cover["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $cover["options"]?></div>
											<div class="data-description" style="display:none"><?= $cover["description"];?></div>
											<div class="title k-ch"><?= $cover["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?//= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?></span></span>
											<?endif;?>
											<div class='price'><?//= $item ->price?><a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
						<?if(isset($kitchenDeconstructAdd['access'])):?>
							<?foreach($kitchenDeconstructAdd['access'] as $item):?>
								<?if($item->price > 0):?>
									<? $cover = Accessory::model()->findByPk($item->id_access);?>
									<div class="col-md-3" id="<?= $item->id_access?>">
										<div class="item-module-block cover_b" data-toggle="modal" data-target="#kitchen-cover">
											<div class="image" style="background-image:url('/images/item_tabletops/<?= $cover["image"] ?>')"></div>
											<div class="data-options" style="display:none"><?= $cover["options"]?></div>
											<div class="data-description" style="display:none"><?= $cover["description"];?></div>
											<div class="title k-ch"><?= $cover["title"] ?></div>
											<?if ($this->ActionPrice_gl!= 1):?>
												<span class="yellow-p without_action" style="bottom: 40px !important;left: 32px;"><span><?//= Utils::priceFormat( $item ->price / $this->ActionPrice_gl,-1) ?></span></span>
											<?endif;?>
											<div class='price'><?//= $item ->price?><a class="by-fronts">Купить</a></div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					</div>
				</div>
			<?endif?>
			
		</div>

	<!-- Конец Главного блока -->

	<!-- Начало правого блока -->
		<div class="col-md-4">	
			<div style="margin-top: 35px;" class="main-right">
				<div class="main-right-title">
					<div class="main-right-title-up"></div>
					<div class="main-right-title-down">Интересные товары</div>
				</div>
				<?if(!empty($kitchenLikeIt)):?>
				<div class="kitchen-page__right kitchen-block">			
					<div style="margin-top:120px;">&nbsp </div>
					<?foreach($kitchenLikeIt as $item): ?>
						<?$kitchenItem = Kitchen::model()->findByPk($item->id);?>
						<a class="kitchens__link you_like" href="/kitchen/<?= $kitchenItem->id?>">
							<div class="edit-panel">
								<div class="filtr">
								<!--<h4 class="kitchen__title"><?= $kitchenItem->title?></h4>-->
								<img src="/images/kitchens/<?= $kitchenItem->id?>.jpg" width="100" alt="<?= $kitchenItem->title?>">
								<div class="arrow-link"><img src="/images/main/more_arrow.svg"></div>
								</div>
								<!--<a data-id="" class="by-fronts">Купить</a>-->
								<noindex>
									<div class="kitchens__price" rel="nofollow">
										<span>Стоимость:</span><br>
										<? $priceItem = $kitchenItem->deconstruct == 1 ? $kitchenItem->price2:$kitchenItem->price?>
										<span style="color: #F32727; text-decoration: line-through;"><span style="color: #000"><?= Utils::priceFormat( round($priceItem  / $this->ActionPrice_gl,-1) ) ?> руб.</span></span>
										<span class="kitchens__price_actual"> <?= Utils::priceFormat($priceItem);?> руб. <!--<i class="fa fa-rub" aria-hidden="true"></i>--> </span>
									</div>
								</noindex>
								<!--<div class="kitchens__btn">
								  <noindex>
									<span class="kitchens-more" rel="nofollow">Подробнее <i class="fa fa-info" aria-hidden="true"></i></span>
								  <!-- <a href="" class="kitchen-order">Заказть</a> --
								  </noindex>

								</div>-->
							</div>
						</a>
					<?endforeach;?>
					<?foreach($withBuy as $item):?>
						<a class="kitchens__link you_like" href="/catalog/<?= $item['path']?>">
							<div class="edit-panel">
								<div class="filtr2">
								<!--<h4 class="kitchen__title"><?= $item['title']?></h4>-->
								<img src="/images<?= $item['img']?>" width="100">
								<div class="arrow-link" style="top: 180px;"><img src="/images/main/more_arrow.svg"></div>
								</div>
								<div class="kitchens__btn">
									  <span class="kitchen__title"><?= $item['title']?></span>
									  <noindex>
									  <div style="margin-top:5px;">
										<span class="kitchens__price_actual" style="color:#333;line-height: 35px;"> <?= Utils::priceFormat($item['price']);?> руб.</span>
										<span class="kitchens-more" rel="nofollow" style="float:right;">Купить</span>
									  <!-- <a href="" class="kitchen-order">Заказть</a> -->
									  </div>
									  </noindex>
								</div>
							</div>
						</a>
					<?endforeach;?>
				</div>
				<?endif?>
			</div>
		</div>
		<!-- Конец правого блока -->
	</div>
<!--     <div class="row">
    	<h1 style="padding-left: 25px;"><?= $kitchen->title ?></h1>
    </div>
	<div class="row">
		<div class="col-md-4 kitchen-img">
			<div class="qp_item-image">
				<a href="/images/kitchens/<?= $kitchen->image ?>" class="fancybox">
				<img class="image-link" src="/images/kitchens/<?= $kitchen->image ?>" alt="<?= $kitchen->img_alt ?>"
					 data-mfp-src="/images/kitchens/<?= $kitchen->image ?>"/></a>
			</div>
		</div>
		<div class="col-md-8 for-h1">

			<h3>Цена: 
			<?if ($this->ActionPrice_gl!= 1):?>
					<span style="color: #F32727; text-decoration: line-through;"><span style="color: #333"><?= Utils::priceFormat( round($kitchen->price  / $this->ActionPrice_gl,-1) ) ?> р.</span></span>
			<?endif;?>
			<?= $kitchen->price ?> руб.</h3>

			<p id="moduleModalDesc"><?= htmlspecialchars_decode($kitchen->description, ENT_NOQUOTES)?></p>
			<br>
			<table style="margin-bottom: 10px; width: 100%;">
			<tr>
			<td style="width: 50%;">
			<a href="#" data-toggle="modal" data-target="#designer-modal" >
				<div style="background: url(/images/new/banner1_mini.png); width: 343px; height: 130px; margin: 0 auto;" class="banner_div_mini">
					<span class="bannerOrder_b_mini">Заказать</span>
				</div>
			</a>
			</td>
			<td style="width: 50%;">
			<a href="#" data-toggle="modal" onclick="initPopupSliders()" data-target="#calculate-price-modal" >
				<div style="background: url(/images/new/banner2_mini.png); width: 343px; height: 130px; margin: 0 auto;" class="banner_div_mini">
					<span class="bannerOrder_b_mini">Заказать</span>
				</div>
			</a>
			</td>
			</tr>
		</table>
		</div>
	</div>

 -->
</div>
<div id="question" style="margin-top:10px">
    <div class="container" style="text-align:center;">
        <div class="row div-form" style="padding: 15px;">
            <p class="h2">Остались вопросы?</p>
            <p class="text">Заполните заявку и наш менеджер ответит<br>
            на все ваши вопросы</p>
            <form role="form" action="/files/mail/mail.php" method="POST" id="call-form">
                <input type="hidden" name="question" value="y">
	            <div class="row">
	                <div class="col-lg-2" ></div>
	                <div class="col-lg-4" ><input type="text" name="name" placeholder="Ваше имя" required ></div>
	                <div class="col-lg-4"><input type="text" id="phoneF2" name="phone" placeholder="Ваш номер телефона" required></div>
	                <div class="col-lg-2" ></div>
	            </div>
	            <div class="row">
	                <div class="col-lg-2"></div>
	            	<div class="col-lg-8">
		                <textarea name="comment" placeholder="Комментарий"></textarea>
		                <div class="policy">Нажимая «Заказать рассчет стоимости», вы даёте согласие на обработку своих 
		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
		                и принимаете <b><a href="#">условия</a></b></div>
		                <button>Заказать обратный звонок<img src="/images/main/btn_callback.svg" style="margin-left:15px"/></button>
		            </div>      
	            	<div class="col-lg-2"></div>
	            </div>
            </form>
        </div>
    </div>
</div>

<!-- КОНЕЦ Новый контейнер-->

<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>
<script  type="text/javascript">
 	$(".kitchen-page__fotorama").click(function(){
		var fotorama = $(".fotorama")
		  .fotorama({allowfullscreen: true})
		  .data('fotorama');
		fotorama.requestFullScreen();
		return false;
	}); 
	$(document).bind('pageinit', function(){
	   $('.kitchen-page__fotorama').vclick(function() {
		   alert('dd');
	   });
	});
</script>
<script type="text/javascript">
	function initPopupSliders() {

		setTimeout(function () {

			var isMobile = {
				Android: function () {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function () {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function () {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function () {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function () {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function () {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};

			if (isMobile.any()) {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 2,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});


			} else {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});


			}
		}, 10);
	}
	$(".calculate-price-modal-front-color-item").click(function () {
		var thisColor = $(this);
		thisColor.parent().find(".calculate-price-modal-front-color-item-selected").removeClass("calculate-price-modal-front-color-item-selected");
		thisColor.addClass("calculate-price-modal-front-color-item-selected");
		thisColor.find("input[type=radio]").prop("checked", true);
	});

	$(".configuration-type").click(function () {
		var thisBlock = $(this);
		$(".configuration-type-selected").removeClass("configuration-type-selected")
		thisBlock.addClass("configuration-type-selected");
		thisBlock.find("input").prop("checked", true);
	});
</script>

<script>
/*
	$(".qp_item-buy-btn").click(function(){
		var id_kitchen = $('#id_kitchen').html();
		$.ajax({
			type: "POST",
			url: '/site/Buycomplect',
			dataType: "json",
			data: {id_kitchen:id_kitchen},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				var count  = parseInt($("#shopping-cart-quantity").text()) + parseInt(p.quantity);
				$("#shopping-cart-quantity").text(count);
				var price = parseInt($("#shopping-cart-price").text().replace(/\s+/g, '')) + parseInt(p.quantity) * parseInt(p.price);
				$("#shopping-cart-price").text(price);
				alert('Элементы комплекта добавлены в корзину');
				location.reload();
			}
		})
	})
*/
</script>

<div class="modal" id="kitchen-modal" tabindex="-1" role="dialog" aria-labelledby="Опции модуля" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции модуля</p>
			</div>
			<div class="modal-body">
				<div id="id_select_module" style="display:none"></div>
				<div id="color_select_module" style="display:none"></div>
				<div id="color_select_front" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_module" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<? $colorsCriteria = new CDbCriteria; $colorsCriteria->condition = 'is_module=1'; $module_colors= Color::model() -> findALL($colorsCriteria);?>
					<div id="container_color" >
						<div id="fronts-color" action="" method="POST" onclick="addModuleToCart()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</div>
						<p class="h1">Цвета модуля</p>
						<div class="select_colors">
							<h3>ЛДСП</h3>
							<?php foreach($module_colors as $color):?>
								<div id='id_color_<?= $color["id"];?>' class='color_item_mod' style='float: left; position: relative;'>
									<div class='qp_item-color-item-title'><?= $color["title"];?>
										<div class='tr'></div>
									</div>
									<img src='/images/colors/<?= $color['id'];?>.png'  width='75' height='75'>
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
								<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
								<img src='/images/without.jpg' style="border: 1px solid black" width='75' height='75'>
							</div>
						</div>
						<? foreach($arraySort as $item):?>
							<div class="select_colors">
								<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
									foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
								<h3><?= $name_categ==1?$item[0]:""?></h3>
								<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
									<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
										<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>
										<img src='/images/colors/<?= $itemColor->image;?>.png'>
										<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
											<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
										</a>
									</div>
								<?endforeach;endif;endforeach;?>
							</div>
						<?endforeach;?>
						<div ><form id="moduleOptions"></form></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(".module_b").click(function(){
		$(".color_item_mod  img").css("border","");
		$(".color_item  img").css("border","");
		var id_module = $(this).parent().attr("id");
		$("#id_select_module").html(id_module);

		var id_kitchen = $('#id_kitchen').html();

		$(".color_item img").css("border","");
		$.ajax({
			type: "POST",
			url: '/site/Selmodulebutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_module:id_module},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_module").html(p.selColorModule);
				$(".color_item_mod[id$=id_color_" + p.selColorModule + "]  img").css("border","5px solid rgb(255, 201, 13)");
				$("#color_select_front").html(p.selColorFront);
				$(".color_item[id$=id_color_" + p.selColorFront + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_module").val(1);
				}
				else{
					$("#count_select_module").val(p.count);
				}

				$("#moduleOptions").html("");
				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					$("#moduleOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
					$.each(group, function (key, object) {
						if (object["is_enabled"]) {
							if(object["sel_option"] == 'y'){
								$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
							else{
								$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
						}
					});
				})

			}
		})

	})

	function addModuleToCart() {
		var id_module = $("#id_select_module").html();
		var id_kitchen = $('#id_kitchen').html();
		var color_select_module = $("#color_select_module").html();
		var color_select_front = $("#color_select_front").html();
		var count_select_module = $("#count_select_module").val();
		$.ajax({
			type: "POST",
			async: false,
			url: '/site/Editmodule',
			dataType: "json",
			data: $("#moduleOptions").serialize() + "&viewKitchen=yes&id_kitchen="+id_kitchen+"&id_module="+id_module+"&color_select_module="+
			color_select_module+"&color_select_front="+color_select_front+"&count_select_module="+count_select_module,
			success: function (data) {
				price = data.data;
			}
		})
		$.ajax({
			type: "POST",
			url: '/add/module',
			dataType: "json",
			data: {item_id:id_module,quantity:$("#count_select_module").val(),
				moduleModalPrice_inp:price,moduleFasadPrice_inp:color_select_front,
				color_select_module:$("#color_select_module").html(),color_select_front:$("#color_select_front").html()},
			success: function(data){
				p = jQuery.parseJSON(data.data);
				var count  = parseInt($("#shopping-cart-quantity").text()) + parseInt(p.quantity);
				$("#shopping-cart-quantity").text(count);
				var price = parseInt($("#shopping-cart-price").text().replace(/\s+/g, '')) + parseInt(p.quantity) * parseInt(p.price);
				$("#shopping-cart-price").text(price);
				alert('Товар добавлен в корзину');
			}
		});
		$("#kitchen-modal").modal('hide');
	}

	$('body').on('click','.data-option-btn',function () {
		var thisButton = $(this);
		if (thisButton.hasClass("btn-default")) {
			thisButton.parent().find("input[type=checkbox]").prop("checked", false);
			thisButton.parent().find(".btn-success").removeClass("btn-success").addClass("btn-default")
			thisButton.removeClass("btn-default").addClass("btn-success").find("input[type=checkbox]").prop("checked", true);
		} else {
			thisButton.removeClass("btn-success").addClass("btn-default").find("input[type=checkbox]").prop("checked", false);
		}
	})


	$(".color_item_mod").click(function(){
		$("#color_select_module").html($(this).attr("id").substr(9));
	})
	$(".color_item").click(function(){
		$("#color_select_front").html($(this).attr("id").substr(9));
	})

</script>

<div class="modal" id="kitchen-front" tabindex="-1" role="dialog" aria-labelledby="Опции фасада" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции фасада</p>
			</div>
			<div class="modal-body">
				<div id="id_select_front2" style="display:none"></div>
				<div id="color_select_front2" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_front2" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<div id="container_color" >
						<div id="fronts-color" action="" method="POST" onclick="edit_front()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</div>
						<p class="h1">Цвета фасада</p>
						<div  class="select_colors">
							<h3>Без фасада</h3>
							<div id='id_color_-1' class='color_item'>
								<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
								<img src='/images/without.jpg' style="border: 1px solid black" width='75' height='75'>
							</div>
						</div>
						<? foreach($arraySort as $item):?>
							<div class="select_colors">
								<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
									foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
								<h3><?= $name_categ==1?$item[0]:""?></h3>
								<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
									<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
										<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>
										<img src='/images/colors/<?= $itemColor->image;?>.png'>
										<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
											<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
										</a>
									</div>
								<?endforeach;endif;endforeach;?>
							</div>
						<?endforeach;?>
						<div ><form id="frontOptions"></form></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(".front_b").click(function(){
		$(".color_item  img").css("border","");
		$("#frontOptions").html("");
		var id_front = $(this).parent().attr("id");
		$("#id_select_front2").html(id_front);

		var id_kitchen =  $('#id_kitchen').html();
		$.ajax({
			type: "POST",
			url: '/site/Selfrontbutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_front:id_front},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_front2").html(p.selColor);
				$(".color_item[id$=id_color_" + p.selColor + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_front2").val(1);
				}
				else{
					$("#count_select_front2").val(p.count);
				}

				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					$("#frontOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
					$.each(group, function (key, object) {
						if (object["is_enabled"]) {
							if(object["sel_option"] == 'y'){
								$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
							else{
								$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
						}
					});
				})
			}
		})
	})
	function edit_front(){
		var id_front = $("#id_select_front2").html();
		var color_select_front = $("#color_select_front2").html();
		var count_select_front = $("#count_select_front2").val();
		$.ajax({
			type: "POST",
			url: '/add/front',
			dataType: "json",
			data: {item_id:id_front,quantity:count_select_front,
				front_color_id:color_select_front},
			success: function(data){
				p = jQuery.parseJSON(data.data);
				var count  = parseInt($("#shopping-cart-quantity").text()) + parseInt(p.quantity);
				$("#shopping-cart-quantity").text(count);
				var price = parseInt($("#shopping-cart-price").text().replace(/\s+/g, '')) + parseInt(p.quantity) * parseInt(p.price);
				$("#shopping-cart-price").text(price);
				alert('Товар добавлен в корзину');
			}
		});
		$("#kitchen-front").modal('hide');
	}
	$(".color_item").click(function () {
		id = $(this).attr("id").substr(9);
		$("#color_select_front2").html(id);
	})
</script>

<div class="modal" id="kitchen-cover" tabindex="-1" role="dialog" aria-labelledby="Опции столешницы" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции столешницы</p>
			</div>
			<div class="modal-body">
				<div id="id_select_cover" style="display:none"></div>
				<div id="color_select_cover" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_cover" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<div id="container_color" >
						<form id="fronts-color" action="" method="POST" onclick="edit_cover()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</form>
						<p class="h1">Цвета</p>
						<div  class="select_colors"><div id="coverColors"></div></div>

						<div ><form id="coverOptions"></form></div>
						<div class="qp_item-size">
							<span>Ширина</span>
							<input name="width" id="extra-size-width" type="text" value="" OnKeyPress="NumericText()"/>
							<span>Длина</span>
							<input name="length" id="extra-size-height" type="text" value="" OnKeyPress="NumericText()"/>
							<span>мм</span>
							<input name="koffCost" id="koffCost" type="text" value="1" OnKeyPress="NumericText()" style="display:none;"/>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<!----------------Скрипты для работы с столешницами, входящих в расчет кухни-------------------->
<script type="text/javascript">
	$(".cover_b").click(function(){
		$(".color_item  img").css("border","");
		$("#coverOptions").html("");
		$("#coverColors").html("");
		$(".qp_item-size").css("display","none");
		var id_cover = $(this).parent().attr("id");
		$("#id_select_cover").html(id_cover);

		var id_kitchen = $('#id_kitchen').html();

		$.ajax({
			type: "POST",
			url: '/site/Selcoverbutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_cover:id_cover},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_cover").html(p.selColor);
				var colors = (eval("(" + JSON.stringify(p.colors) + ")"));
				$.each(colors, function (id, object) {
					$("#coverColors").append('<div id="id_color_' + object["id"] + '" class="color_item">' +
						'<div class="qp_item-color-item-title"><div class="tr"></div>'+ object["title"] +'</div>'+
						'<img src="/images/colors/'+ object["id"] +'.png">'+
						'<a href="/images/colors/'+ object["id"] +'.png" class="fancybox" title="'+  object["title"] +'" style="text-decoration: none;">'+
						'<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i></a>'+
						'</div>');
				});
				$(".color_item[id$=id_color_" + p.selColor + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_cover").val(1);
				}
				else{
					$("#count_select_cover").val(p.count);
				}

				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					if(keyGroup!="no_standard"){
						$("#coverOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
						$.each(group, function (key, object) {
							if (object["is_enabled"]) {
								if(object["sel_option"] == 'y'){
									$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
								}
								else{
									$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
								}
							}
						});
					}
				})
				if(p.extraSize == 1){
					$(".qp_item-size").css("display","block");
				}
				$(".qp_item-size input[name$='koffCost']").val(p.koffCost);
				$(".qp_item-size input[name$='width']").val(p.stdW);
				$(".qp_item-size input[name$='length']").val(p.stdH);
			}
		})
	})
	function edit_cover(){
		var id_cover = $("#id_select_cover").html();
		var color_select_cover = $("#color_select_cover").html();
		var count_select_cover = $("#count_select_cover").val();
		var koffCost = $("#koffCost").val();
		var width = $("#extra-size-width").val();
		var height = $("#extra-size-height").val();
		$.ajax({
			type: "POST",
			url: '/shopping-cart/cover/add',
			dataType: "json",
			data: {item_id:id_cover,quantity:count_select_cover,
				color:color_select_cover,factor:koffCost,factor_2:0,width:width,length:height},
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
	$('body').on('click','.color_item', function () {
		$('.color_item img').css("border","none");
		id = $(this).attr("id").substr(9);
		$(this).find('img').css("border","5px solid rgb(255, 201, 13)");
		$("#color_select_cover").html(id);
	})
	$('body').on('change','#extra-size-width', function () {
		updateKoffCost();
	})
	$('body').on('change','#extra-size-height', function () {
		updateKoffCost();
	})
	function updateKoffCost(){
		var id_cover = $("#id_select_cover").html();
		var sizeW = $("#extra-size-width").val();
		var sizeH = $("#extra-size-height").val();
		$.ajax({
			type: "POST",
			url: '/site/Coverextrasize',
			dataType: "json",
			data: {id_cover:id_cover,sizeW:sizeW,sizeH:sizeH},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				$("#koffCost").val(p.koff);
			}
		})
	}
</script>