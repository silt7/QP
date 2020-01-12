<div class="container">
	<div class="row">
		<h1><?= $katalogKuhon->title;?></h1>
		<?= $katalogKuhon->content;?>
	</div>
</div>
<div id="content">
	<div class="container">
		<div class="row expKitchen">
			<?php if ( $kitchens ) : foreach ( $kitchens as $kitchen ): ?>
				<div class="col-xs-12 col-sm-6 col-md-4 kitchen-block">
					<a class="kitchens__link" href="/kitchen/<?= $kitchen->urlT!=""?$kitchen->urlT:$kitchen->id ?>">
						<div class="edit-panel">
							<!--<h4 class="kitchen__title"><?= $kitchen->title ?></h4>-->
							<div class="filtr">
							    <img src="/images/kitchens/prev/<?= $kitchen->image ?>" width="100" alt="<?= $kitchen->title ?> от <?= $kitchen->price ?> рублей"/>
							    <div class="arrow-link"><img src="/images/main/more_arrow.svg"></div>
							</div>
							<noindex>
								<div  class="kitchens__price"  rel="nofollow">
								    <span class="kitchens__price_text">Стоимость:</span>
									<?if ($this->ActionPrice_gl!= 1):?>
											<span class="kitchens__price_old"><?= Utils::priceFormat( round($kitchen->price  / $this->ActionPrice_gl,-1) ) ?> руб.</span>
									<?endif;?>
									<span class="kitchens__price_actual">  <?= $kitchen->price ?> <!--<i class="fa fa-rub" aria-hidden="true"></i> -->руб.</span>
								</div>
							</noindex>
							<!--
							<div class="kitchens__btn">
								<noindex>
								<span class="kitchens-more" rel="nofollow">Подробнее <i class="fa fa-info" aria-hidden="true"></i></span>
							  <!-- <a href="" class="kitchen-order">Заказть</a> --
								</noindex>
							</div>-->
						</div>
					</a>
				</div>
			<?php endforeach;
			endif;
			?>
			<a href="/gotovye-kuhni" style="color: #323232;text-decoration: none"><button><span style="display:table-cell;vertical-align:middle;width: 190px;">Посмотреть еще кухни</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<?= $katalogKuhon->content2;?>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$("#nav-catalog").addClass('active');
	})
</script>