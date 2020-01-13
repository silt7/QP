<script type="text/javascript">
    //var redirect = '/catalog/kuhonnaya-tehnika';
    //history.pushState('', '', redirect);
</script>
<?php $items = $this->processOutput( $items ); 
if (isset($patch[0])){
	$activeLink = Folder::model()->findByPk(array_shift($patch));
}
$patch = array_reverse ($patch);
?>
<div class="body_main">
<div class="container">
	<ol class="left-m breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<?foreach($patch as $itemPatch): $link = Folder::model()->findByPk( $itemPatch); ?>
			<li><a href="/catalog/kuhonnaya-tehnika/<?= $link->id?>" class="link"><?= $link->title?></a></li> 
		<?endforeach;?>
		<li class="active"><?= $activeLink->title?></li>
	</ol>
</div>
<div class="container">

	<div class="row">


		<?php $active_memu_id = 6; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>

		<div class="col-sm-9">
			
			<div class="qp_item-list catalog">
			    <h1><?= $activeLink->title ?></h1>
				<?php $folders = $this->processOutput( $folders ); ?>
				<? if ( ! is_null( $folders ) ): ?>
				    <? if(!empty($section->content)){?>
				        <div class="catalog-content"><?= $section->content?></div>
				    <?}?>
				<?foreach ( $folders as $folder ): if(!$folder->is_show) continue;  ?>

					<div class="qp_item-list-cell item-list-cell-folders">
						<a href="/catalog/kuhonnaya-tehnika/<?= $folder->id; ?>" class="inner">
							<br><?= $folder->title ?>
							<? if ( $folder->image ): ?>
								<img src="<?= $folder->getImage() ?>" alt="<?= $folder->title?>">
							<? endif; ?>
							
							<a href="/catalog/kuhonnaya-tehnika/<?= $folder->id; ?>" class="by-fronts">Смотреть</a> 
						</a>
					</div>
				<? endforeach;?>  
					
				<?endif; ?>
				<? if ( ! is_null( $items ) ): foreach ( $items as $item ): if(!$item->is_show) continue; ?>

					<div class="qp_item-list-cell">
						<a href="/catalog/equipment/<?= $item->id; ?>" class="inner">
							<img src="<?= $item->getImage() ?>" alt="<?= $item->title?>">
							<span class="e-title"><?= $item->title ?></span>
							<br>
							<!--							<?if ($this->ActionPrice_gl!= 1):?>
								<span class="yellow-p without_action"><span><?= Utils::priceFormat( round($item->price  / $this->ActionPrice_gl,-1) ) ?> р.</span></span>
							<?endif;?>-->
							<span class="yellow-p"><span id="withAction"><?= Utils::priceFormat( $item->price ) ?>р.</span><a href="/catalog/equipment/<?= $item->id; ?>" class="by-fronts">Купить</a></span>
						</a>
					</div>
				<? endforeach;  endif; ?>
			</div>


		</div>
	</div>
</div>
</div>
<form action="/shopping-cart/cover/add" method="post" id="item-form" style="display:none">
    <input type="hidden" id="item_id" name="item_id" value="">
    <input name="quantity" id="item_quantity" value="1">
</form>
<script type="text/javascript">
	$(function () {
		$("#nav-catalog").parent().addClass('active');
	});
	    $('a.by-fronts').click(function(){
/*         $('#item_id').val($(this).attr('data-id'));
                sendJson($("#item-form").serialize(), "/shopping-cart/equipment/add", function () {
					alert("Товар добавлен в корзину");
					location.reload();
				}); */
    });


</script>