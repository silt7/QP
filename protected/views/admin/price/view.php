<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Загрузка цен</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Загрузка цен</h1>
			
			<div class="table-responsive">
			<hr/>
				<a class="link" href="/admin/modulePrice" style="font-size: 20px;"><i
										class="fa fa-edit"></i>&nbsp Цены для модулей</a>	
			<hr/>
				<a class="link" href="/admin/frontPrice" style="font-size: 20px;"><i
										class="fa fa-edit"></i>&nbsp Цены для фасадов</a>					
			<hr/>
				<a class="link" href="/admin/equipmentPrice" style="font-size: 20px;"><i
						class="fa fa-edit"></i>&nbsp Цены для техники</a>	
			<hr/>
			</div>
			
		</div>
	</div>


</div>


<script type="text/javascript">

	$(function () {
		$("#a_m_price").addClass("select");
	})

</script>