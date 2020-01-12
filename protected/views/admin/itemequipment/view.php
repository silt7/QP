<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование техники</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>        </div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование техники</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
					    <th class="col-md-1">id</th>
						<th class="col-md-4">Заголовок</th>
						<th class="col-md-4">Папка</th>
						<th class="col-md-1">Предоплата</th>

						<th class="col-md-2">Отображать</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $equipment ) as $equipmentItem ): ?>
						<tr>
						    <td>	<?= $equipmentItem['id'] ?></td>
							<td><a href="/admin/item-equipment/edit/<?= $equipmentItem['id'] ?>" class="link"><?= $equipmentItem['title'] ?></a>
							</td>
							<td>
								<?= $equipmentItem['title2'] ?>
							</td>
							<td>
								<?= $equipmentItem['pre_pay'] ?> %
							</td>
							<td class="text-center">
								<? if ( $equipmentItem['is_show'] == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/item-equipment/edit/<?= $equipmentItem['id'] ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/item-equipment/delete/<?= $equipmentItem['id'] ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/item-equipment/create">Добавить аксессуар</a>
		</div>
	</div>


</div>

<script type="text/javascript">

	$(function () {
		$("#a_m_item_equipment").addClass("select");
	})

</script>