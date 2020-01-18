<div class="list-group list-promo">
    <? $catalogMenu       = $this->getCatalogMenuArray();?>
	<? $catalogMenu = $this->processOutput( $catalogMenu );?>
	<? foreach ( $catalogMenu as $catalogMenuItem ) :
		$link   = $catalogMenuItem->link;
		$folder = $catalogMenuItem->getFolderModel();
		if ( $folder ) {
			$link = $link."/".$folder->id;
		}
    ?>
		<a href="/<?= $link ?>" id="catalog-menu-<?= $catalogMenuItem->id ?>" style="z-index:0"
			class="list-group-item <?= ((!empty($active_memu_id) && $catalogMenuItem->id==$active_memu_id)? 'active':'')?>">
			<h4 class="list-group-item-heading"><?= $catalogMenuItem->title ?></h4>
		</a>
	<? endforeach ?>

</div>