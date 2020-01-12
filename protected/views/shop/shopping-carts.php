<? $shoppingCarts = $this->processOutput( $shoppingCarts );
?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/profile" class="link">Профиль</a></li>
		<li class="active">Мои корзины</li>
	</ol>
</div>
<div class="container qp_profile-orders">
	<h1 class="head">Мои корзины</h1>

	<?
	if ( $shoppingCarts )
		foreach ( $shoppingCarts as $shoppingCart ):
			?>
			<div class="row">
				<div class="col-sm-9"><?= $shoppingCart->title ? $shoppingCart->title : "без названия"; ?> </div>
				<div class="col-sm-2">
					<a href="/shopping-cart/load/<?= $shoppingCart->id; ?>" class="more pull-right">Загрузить</a>
				</div>
				<div class="col-sm-1"><a href="/shopping-cart/remove/<?= $shoppingCart->id; ?>" class="more pull-right"><i class="fa fa-trash"></i></a></div>

			</div>

		<? endforeach ?>
</div>
