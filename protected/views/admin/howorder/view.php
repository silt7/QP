﻿<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Как правильно заказать кухню?</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование</h1>
						<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-6">Заголовок</th>
						<th class="col-md-3">Содержание</th>
						<th class="col-md-1">Отображать</th>
						<th></th>
					</tr>
					</thead>
					<tbody >
					<?php foreach ( $this->processOutput( $HowOrder ) as $newItem ): ?>
						<tr >
							<td><a href="/admin/howorder/edit/?id=<?= $newItem->id ?>" class="link"><?= $newItem->title ?></a></td>
							<td><a href="/admin/howorder/edit/?id=<?= $newItem->id ?>" class="link"><?//= substr($newItem->description, 100); ?></a></td>
							<td class="text-center">
								<? if ( $newItem->is_show == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/howorder/edit/?id=<?= $newItem->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/howorder/delete/?id=<?= $newItem->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<i class="fa fa-plus-circle"></i> <a class="link" href="/admin/howorder/create">Добавить запись</a>
		</div>
	</div>


</div>


<script type="text/javascript">
 	$(function () {
		$("#a_m_howorder").addClass("select");
	}) 
</script>