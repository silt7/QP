<div class="col-sm-3">
	<? /*<h4 class="promo">Разделы</h4> */ ?> 

	<div class="list-group list-promo">

		<?php $catalogMenu = $this->processOutput( $catalogMenu );
		$openCatalogItemId = $this->processOutput( $openCatalogItemId );
		//print_r($catalogMenu);
		?>

		<?php foreach ( $catalogMenu as $catalogMenuItem ) :
			$link   = $catalogMenuItem->link;
			$folder = $catalogMenuItem->getFolderModel();
			if ( $folder ) {
				$link = $link."/".$folder->id;
			}

			?>



			<a href="/<?= $link ?>" id="catalog-menu-<?= $catalogMenuItem->id ?>" style="z-index:0"
			   class="list-group-item <?= ((!empty($active_memu_id) && $catalogMenuItem->id==$active_memu_id)? 'active':'')?>">
				<h4 class="list-group-item-heading"><?= $catalogMenuItem->title ?></h4>
<!--				--><?// if ( $catalogMenuItem->folder_id && $openCatalogItemId == $catalogMenuItem->id ) :
				//					$folder        = $catalogMenuItem->getFolderModel();
				//					$folderChildes = $folder->getChildModels();
				//					if ( $folderChildes ) :
				//						foreach ( $folderChildes as $folderChild ):
				?>
				<!--							<a href="/catalog/folder/--><? //= $folderChild->id ?><!--" class="list-group-item">--><? //= $folderChild->title ?><!--</a>-->
				<!---->
				<!--							--><?//
				//							$subFolderChildes = $folderChild->getChildModels();
				//							if ( $subFolderChildes ) :
				//								foreach ( $subFolderChildes as $folderChild ):
				?>
				<!--									<a href="/catalog/folder/--><? //= $folderChild->id ?><!--" class="list-group-item">-->
				<? //= $folderChild->title ?><!--</a>-->
				<!---->
				<!--								--><?// endforeach;
				//							endif; endforeach;
				//					endif;
				//				endif
				?>
			</a>

		<?php endforeach ?>


	</div>
	<div id="filtr_module">
	<? $i=0; if(!empty($filtr_module)): ?>
	<h3 class="filter-title">Отбор товаров</h3>
	<form action="kitchenmodules" method="GET">
		<? foreach($filtr_module as $item_filtr_module): ?>
		<label class="label-filter <? if(isset($_POST['filtr_'.$i])and($_POST['filtr_'.$i] != "")) echo 'l-check'; ?> r" for="filtr_<?= $i ?>"><div class="c-check"><i class="fa fa-check"></i></div><?= $item_filtr_module ?></label>
			<input type="checkbox" class="filtr-check" id="filtr_<?= $i ?>" name="filtr_<?= $i++ ?>" value="<?= $item_filtr_module ?>" <? if(isset($_POST['filtr_'.($i-1)])and($_POST['filtr_'.($i-1)] != "")) echo 'checked="checked"'; ?>><br>
		<? endforeach; ?>
		<label class="label-filter f_all" for="filtr_all"><div class="c-check"><i class="fa fa-check"></i></div>Все</label>
		<input type="checkbox" id="filtr_all" name="filtr_all" value="all"><br>
		<!--<input type="submit" value="Применить" class="filter-submit">-->
	</form>
	<? endif; ?>
	</div>
	
	
	<div id="filtr_front">
	<? $i=0; if(!empty($filtr_front)): ?>
	<h3 class="filter-title">Отбор товаров</h3>
	<form action="fronts" method="GET" id="filter-form">
		<? foreach($filtr_front as $item_filtr_module): ?>
		<label class="label-filter <?if(isset($_POST['filtr_'.$i])and($_POST['filtr_'.$i] != "")) echo 'l-check';?> r" for="filtr_<?= $i ?>"><div class="c-check"><i class="fa fa-check"></i></div><?= $item_filtr_module ?></label>
			<input type="checkbox" class="filtr-check" id="filtr_<?= $i ?>" name="filtr_<?= $i++ ?>" value="<?= $item_filtr_module ?>" <? if(isset($_POST['filtr_'.($i-1)])and($_POST['filtr_'.($i-1)] != "")) echo 'checked="checked"'; ?>><br>
		<? endforeach; ?>
		<label class="label-filter f_all" for="filtr_all"><div class="c-check"><i class="fa fa-check"></i></div>Все</label>
		<input type="checkbox" id="filtr_all" name="filtr_all" value="all"><br>
		<!--<input type="submit" value="Сбросить" class="filter-submit">-->
	</form>
	<? endif; ?>
	</div>
	
	<div id="color_block_cont_m"></div>
</div>