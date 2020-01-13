<script type="text/javascript">
    //var redirect = '/catalog/kuhonnye-aksessuary';
    //history.pushState('', '', redirect);
</script>
<?php $accessories = $this->processOutput( $items ); 
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
			<li><a href="/catalog/kuhonnye-aksessuary/<?= $link->id?>" class="link"><?= $link->title?></a></li> 
		<?endforeach;?>
		<li class="active"><?= $activeLink->title?></li>
	</ol>
</div>
<div class="container">
	

	<div class="row">

        
		<?php $active_memu_id = 5; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>

		<div class="col-sm-9">

			<div class="qp_item-list catalog">
			    <h1><?= $activeLink->title ?></h1>
				<?php $folders = $this->processOutput( $folders ); ?>
				<? if ( ! is_null( $folders ) ):?>
				<div class="catalog-content"><?= $section->content?></div>
				<?foreach ( $folders as $folder ): if(!$folder->is_show) continue; ?>
					<? if (!empty($folder->content)){echo '<p>'.$folder->content.'</p>';} ?>
					
					<div class="qp_item-list-cell item-list-cell-folders">
						<a href="/catalog/kuhonnye-aksessuary/<?= $folder->id; ?>" class="inner">
							<br><?= $folder->title ?>
							<? if ( $folder->image ): ?>
								<img src="<?= $folder->getImage() ?>" alt="<?= $folder->title?>">
							<? endif; ?>
							<a href="/catalog/kuhonnye-aksessuary/<?= $folder->id; ?>" class="by-fronts">Смотреть</a> 
							
						</a>
					</div>
				<? endforeach;?>  
					<div class="catalog-content"><?= $section->content2?></div>
				<?endif; ?>
				<? if ( ! is_null( $accessories ) ): foreach ( $accessories as $accessory ): if(!$accessory->is_show) continue; ?>

					<div class="qp_item-list-cell">
						<a href="/catalog/accessory/<?= $accessory->id; ?>" class="inner">
							<img src="<?= $accessory->getImage() ?>"  alt="<?= $accessory->title?>">
							<span class="e-title"><?= $accessory->title ?></span>
							<br>
							<?if ($this->ActionPrice_gl!= 1):?>
								<span class="yellow-p without_action"><span><?= Utils::priceFormat( round($accessory->price / $this->ActionPrice_gl,-1) ) ?> р.</span></span>
							<?endif;?>
							<span class="yellow-p"><span id="withAction"><?= Utils::priceFormat( $accessory->price ) ?>р.</span><a href="/catalog/accessory/<?= $accessory->id; ?>" class="by-fronts">Купить</a></span>
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
/* 	$('#item_id').val($(this).attr('data-id'));
			sendJson($("#item-form").serialize(), "/shopping-cart/accessory/add", function () {
				alert("Товар добавлен в корзину");
				location.reload();
			}); */
    });
</script>