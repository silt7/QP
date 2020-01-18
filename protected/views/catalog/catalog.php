<div class="container catalog">
	<div class="row">
		<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/breadcrumb.tpl" ); ?>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/left-menu.tpl" ); ?>
		</div>
		<div class="col-sm-9">
			<div class="row catalog">
				<h1><?= $obj['title'] ?></h1>
			</div>
			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/catalog/{$obj['template']}.tpl" ); ?>
		</div>
	</div>
	<div class="row" id="content">
		<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/banner.php" );  ?>
		<script>
			$('.a-calc').removeAttr('href');
			$('#free-payment').click(function(){
				$('#hide-button').trigger('click');
			})
		</script>
		<a id="hide-button" data-toggle="modal" data-target="#calculate-price-modal" style="display:none">скрытый вызов</a>
		<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>
	</div>
</div>
<div class="modal" id="buy" tabindex="-1" role="dialog" aria-labelledby="Сообщение" aria-hidden="true">
	<div class="container" style="text-align:center;">
		<div class="container" style="margin-top:15%; width: 60%; text-align:center;">
			<div class="row div-form" style="background: #fff;">
				<div><p style="font-size: 28px; font-weight:bold; padding:15px;">Данный товар можно купить по телефону 8 (812) 952 97 83 или в салоне по адресу: Шлиссельбургский проспект, ТЦ Эврика, дом 3-7, этаж 2, офис 87.</p>
				</div>
				<div data-dismiss="modal" id="closeModal" style="background:rgb(255,197,0,0.5); border-radius:5px; width:60px; margin: 20px auto; font-size: 26px; cursor: pointer;"><span aria-hidden="true">ОК</span><span
					class="sr-only">ОК</span></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function () {
		$("#nav-catalog").addClass('active');
    })
</script>