<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование заказов</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование заказов</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-1">№</th>
						<th class="col-md-3">Дата</th>
						<th class="col-md-3">Логин</th>
						<th class="col-md-2">Сумма</th>
						<th class="col-md-2">Статус</th>
						<th class="col-md-1"></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $orders ) as $order ):
						$user     = User::model()->findByPk( $order->user_id );
						$userName = "Гость";
						if ( $user ) {
							$userName = $user->email;
						}

						?>
						<tr>
							<td><?= $order->id ?></td>
							<td><a href="/admin/order/edit/<?= $order->id ?>" class="link"><?= $order->datetime ?></a></td>
							<td><?= $userName ?></td>
							<td><?= $order->getTotalPrice() ?></td>
							<td><?= Order::$statusArray[ $order->status ]["label"] ?></td>
							<td class="text-right">
								<a href="/admin/order/edit/<?= $order->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/order/delete/<?= $order->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
		</div>
	</div>


</div>


<script type="text/javascript">

	$(function () {
		$("#a_m_orders").addClass("select");
	})

</script>