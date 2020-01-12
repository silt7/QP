<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование цветов</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование цветов</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-1">id</th>
						<th class="col-md-1"></th>
						<th class="col-md-6">Заголовок</th>
						<th class="col-md-3">Материал</th>
						<th class="col-md-1">Отображать</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $colors ) as $color ): ?>
						<tr>
							<td><?= $color->id ?></td>
							<td><img src="<?= $color->getImage() ?>.png" width="30px"></td>
							<td><a href="/admin/color/edit/?id=<?= $color->id ?>" class="link"><?= $color->title ?></a>
							</td>

							<td>
								<?= $color->getMaterialLabel() ?>
							</td>
							<td class="text-center">
								<? if ( $color->is_show == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/color/edit/?id=<?= $color->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/color/delete/?id=<?= $color->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/color/create">Добавить цвет</a>
		</div>
	</div>


</div>


<script type="text/javascript">

	$(function () {
		$("#a_m_colors").addClass("select");
	})

</script>