<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование раздела: Наши цвета</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
			<?$OurColors = OurColors::model()->findAll( );?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование заказов</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-6">Заголовок</th>
						<th class="col-md-3">Статус</th>
						<th class="col-md-3"></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
						<?foreach($OurColors as $item):?>
							<tr>
								<td><?= $item->name_categ;?></td>
								<td>
									<? if ( $item->is_show == 0 ): ?><i class="fa fa-close"></i>
									<? else: ?>
										<i class="fa fa-check"></i>
									<?endif ?>
								</td>
								<td>
									<a href="/admin/our-colors/edit/<?= $item->id ?>" class="tool-link"
									   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
											class="fa fa-edit"></i></a>
									<a href="/admin/our-colors/delete/<?= $item->id ?>" class="tool-link"
									   data-toggle="tooltip" data-placement="top" title="Удалить"><i
											class="fa fa-trash-o"></i></a>
								</td>
							</tr>
						<?endforeach;?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/our-colors/create">Добавить</a>
		</div>
	</div>


</div>


<script type="text/javascript">

	$(function () {
		$("#a_m_our_colors").addClass("select");
	})

</script>