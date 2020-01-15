
<div class="row">
	<div class="qp_item-title"><?= $obj['item']->title ?></div>
	<div class="col-sm-4">
		<div class="qp_item-image">
			<a href="<?= $obj['item']->getImage() ?>" class="fancybox">
			<img class="image-link" src="<?= $obj['item']->getImage() ?>" alt="<?= $obj['item']->title ?>"
					data-mfp-src="<?= $obj['item']->getImage() ?>"/></a>
		</div>
		<a class="qp_item-back-btn" href="<?= $this->getBackUrl() ?>"><i class="fa fa-angle-left"></i>Назад</a>
	</div>
	<div class="col-sm-8">
		<? if($obj['item']->description) ?>
		<div class="qp_item-description"><?= $obj['item']->description ?></div>
        <div class="qp_item-price-caption">ЦЕНА:</div>
	    <div class="qp_item-price"><span id="item-price"><?= Utils::priceFormat( 0  ) ?></span> <i >р</i></div>
	    <div class="tocart">
    		 <div class="qp_item-buy-btn"><a></i>Купить</a></div>
	    </div>
	</div>
</div>