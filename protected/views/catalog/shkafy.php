<div class="body_main">
	<div class="container">
		<ol class="left-m breadcrumb">
			<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
			<li><a href="/catalog" class="link">Каталог товаров</a></li>
			<li class="active"><?= $folderItem->title;?></li>
		</ol>
	</div>
	<div class="container">
		<div class="row">
			<?php $active_memu_id = 7; require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>
			<div class="col-sm-9">
				<div class="qp_item-list catalog">
					<h1><?= $folderItem->title;?></h1>
					<?= $folderItem->content;?>
					<?php $folders = Folder::model()->findAll( "parent_id=".$folderItem->id ); ?>
					<?foreach ( $folders as $item ): if(!$item->is_show) continue; ?>
					<? if (!empty($item->content)){echo '<p>'.$item->content.'</p>';} ?>
					<div class="qp_item-list-cell item-list-cell-folders">
						<a href="/catalog/shkafy/<?= $item->id; ?>" class="inner">
							<br><?= $item->title ?>
							<? if ( $item->image ): ?>
								<img src="<?= $item->getImage() ?>" alt="<?= $item->title?>">
							<? endif; ?>
							<a href="/catalog/shkafy/<?= $item->id; ?>" class="by-fronts">Смотреть</a> 
							
						</a>
					</div>
				    <? endforeach;?>  
				    <bre>
				</div>
				<?= $folderItem->content2;?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$("#nav-shkafy").parent().addClass('active');
	})
</script>