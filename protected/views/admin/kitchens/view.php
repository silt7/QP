<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование кухонных гарнитуров</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>        </div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование кухонных гарнитуров</h1>

			<a style="cursor: pointer;" onclick="UpdatePrice()">Обновить цены</a>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
					    <th class="col-md-2">id/sort</th>
						<th class="col-md-5">Название</th>
						<th class="col-md-4">Цена</th>
						<th class="col-md-1">Отображать</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $kitchens ) as $kitchen ): ?>
						<tr>
							<td><?= $kitchen->id ?> || <?= $kitchen->sorts ?></td>
							<td><a href="/admin/kitchens/edit/?id=<?= $kitchen->id ?>" class="link"><?= $kitchen->title ?></a>
							</td>
							<td><?= $kitchen->price ?>
							</td>
							<td class="text-center">
								<? if ( $kitchen->is_show == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/kitchens/edit/?id=<?= $kitchen->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/kitchens/delete/?id=<?= $kitchen->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/kitchens/create">Добавить кухонный гарнитур</a>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(function () {
		$("#a_m_kitchens").addClass("select");
	})

	function UpdatePrice(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Updatepriceall',
			dataType: "json",
			success: function(data) {
				alert(data.data);
				location.reload();
			}
		});
	}
</script>