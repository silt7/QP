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
			<h1 class="head">Редактирование опций</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-1"></th>
						<th class="col-md-4">Заголовок</th>
						<th class="col-md-3">Тип</th>
						<th class="col-md-2">Предоплата</th>
						<th class="col-md-1">Отображать</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $moduleOptions ) as $moduleOption ): ?>
						<tr>
							<td></td>
							<td><a href="/admin/module-option/edit/?id=<?= $moduleOption->id ?>"
							       class="link"><?= $moduleOption->title ?></a>
							</td>
							<td><?= $moduleOption->getGroupLabel() ?>
							</td>
							<td>
								<?= $moduleOption->pre_pay ?> %
							</td>
							<td class="text-center">
								<? if ( $moduleOption->is_show == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/module-option/edit/?id=<?= $moduleOption->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/module-option/delete/?id=<?= $moduleOption->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/module-option/create">Добавить опцию</a>
		</div>
	</div>


</div>


<script type="text/javascript">

	$(function () {
		$("#a_m_module_options").addClass("select");
	})

</script>