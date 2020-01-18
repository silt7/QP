<div class="row">
    <?= $obj['page']->content;?>
</div>
<div class="row">
    <?foreach($obj['folder'] as $item):?>
        <div class="col-md-3">
			
			<a href="/catalog/<?= $obj['pathfolder'].$item->id?>" class="inner">
				<div class="edit-panel">
					<div class="title"><?= $item->title?></div>
					<div class="filtr"><img src="/images/folders/<?= $item->image?>" alt="" style="height:150px"></div>	
					<div class="arrow-link"><img src="/images/main/more_arrow.svg"></div>
				</div>
			</a>
        </div>
    <?endforeach;?>
    <?foreach($obj['list'] as $item):?>
        <div class="col-md-3">
			<a href="/catalog/<?= $obj['pathItem'].$item->id?>" class="inner">
				<div class="edit-panel">
					<div class="title"><?= $item->title?></div>
					<div class="filtr"><img src="<?= $obj['pathImg'].$item->image?>" alt="" style="height:150px"></div>
					<?if($item->price > 0):?>
						<div class="item-price"><span><?= Utils::priceFormat( $item->price  ) ?> руб.</span></div>
						<a href="/catalog/<?= $obj['pathItem'].$item->id?>" class="by-fronts">Купить</a>
					<?else:?>
						<div class="arrow-link"><img src="/images/main/more_arrow.svg"></div>
					<?endif?>
				</div>
			</a>
        </div>

    <?endforeach;?>
</div>
<div class="row">
    <h1><?= $obj['page']->content2;?></h1>
</div>
<style>
	a.inner:hover{
		text-decoration:none;
	}
	.edit-panel{
		height: 270px;
		text-align: center;
	}
	.edit-panel .title, .edit-panel .item-price{
		height: 50px;
		padding-top: 5px;
		margin-bottom:5px;
		color: #333;
		font-size: 16px;
		font-weight: 600;
	}
	.edit-panel .item-price{
		float: left;
		padding:10px;
	}
	.edit-panel:hover .filtr:before{
		display: block;
		width: 100%;
		height: 220px;
		background-blend-mode: multiply;
		position: absolute;
		left: 0;
		top: 0;
		z-index: 3;
		content: 'Посмотреть';
		font-family: ProximaNova;
		font-size: 22px;
		font-weight: 600;
		color: #fff;
		padding-top: 45%;
		opacity: 0.8;
		background-image: none;
		background-color: #ffc500;
	}
	.edit-panel .arrow-link{
		width: 35px;
		height: 35px;
		line-height: 30px;
		float: right;
		margin-top:10px;
	}
	.edit-panel .arrow-link img{
		height: auto;
		width: auto;
	}
</style>
<script type="text/javascript">
    $(function () {
		$("#catalog-menu-<?= $obj['idMenu'];?>").addClass('active');
	})
</script>