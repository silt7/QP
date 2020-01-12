<?php $items = $this->processOutput( $items ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/catalog" class="link">Каталог товаров</a></li>
		<li class="active">Барные стойки</li>
	</ol>
</div>
<div class="container">

	<div class="row">


		<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/catalog-menu.php" ); ?>

		<div class="col-sm-10">

			<div class="qp_item-list">
				<div class="title">Барные стойки</div>
				<?php $folders = $this->processOutput( $folders ); ?>
				<? if ( ! is_null( $folders ) ): foreach ( $folders as $folder ): ?>

					<div class="qp_item-list-cell">
						<a href="/catalog/folder/<?= $folder->id; ?>" class="inner">
							<? if ( $folder->image ): ?>
								<img src="<?= $folder->getImage() ?>">
							<? endif; ?>
							<?= $folder->title ?>
						</a>
					</div>
				<? endforeach;  endif; ?>
				<? if ( ! is_null( $items ) ): foreach ( $items as $item ): ?>

					<div class="qp_item-list-cell">
						<a href="/catalog/bar/<?= $item->id; ?>" class="inner">
							<img src="<?= $item->getImage() ?>">
							<?= $item->title ?>
						</a>
					</div>
				<? endforeach;  endif; ?>
			</div>


		</div>
	</div>
</div>


<script type="text/javascript">
	$(function () {
		$("#nav-catalog").parent().addClass('active');
	})


</script>
