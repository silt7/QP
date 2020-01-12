<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование отзывов</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>
		</div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование отзывов</h1>
						<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-6">ФИО</th>
						<th class="col-md-3">Отзыв</th>
						<th class="col-md-1">Отображать</th>
						<th class="col-md-1">Новый</th>
						<th></th>
					</tr>
					</thead>
					<tbody >
					<?php foreach ( $this->processOutput( $reviews ) as $review ): ?>
						<tr >
							<td><a href="/admin/review/edit/?id=<?= $review->id ?>" class="link"><?= $review->fio ?></a></td>
							<td><a href="/admin/review/edit/?id=<?= $review->id ?>" class="link"><?= $review->text ?></a></td>
							<td class="text-center">
								<? if ( $review->is_show == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<? if ( $review->new_ch == 0 ): ?>
								<td class="text-center" style="background: #00D19F;">
								<i>NEW!</i>
								<? else: ?>
								<td class="text-center">
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td class="text-right">
								<a href="/admin/review/edit/?id=<?= $review->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<a href="/admin/review/delete/?id=<?= $review->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div>


<script type="text/javascript">
 	$(function () {
		$("#a_m_reviews").addClass("select");
	}) 
</script>