<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li class="active">Редактирование страниц</li>
	</ol>
</div>

<div class="container">

	<div class="row">
		<div class="col-sm-4">
			<h4 class="promo">Быстрые ссылки</h4>

			<?php require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/admin/admin/admin-menu.php" ); ?>        </div>
		<div class="col-sm-8">
			<h1 class="head">Редактирование страниц</h1>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th class="col-md-4">Заголовок</th>
						<th>Пункт меню</th>
						<th class="col-md-2">Показать в меню</th>
						<th>URL</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->processOutput( $pages ) as $page ): ?>
						<tr>
							<td><a href="/admin/page/edit/?id=<?= $page->id ?>" class="link"><?= $page->title ?></a>
							</td>
							<td><?= $page->menu ?></td>
							<td class="text-center">
								<? if ( $page->in_menu == 0 ): ?><i class="fa fa-close"></i>
								<? else: ?>
									<i class="fa fa-check"></i>
								<?endif ?>
							</td>
							<td>/<?= $page->url ?></td>
							<td class="text-right">
								<a href="/<?= $page->url ?>" class="tool-link" target="_blank"
								   data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте"><i
										class="fa fa-external-link"></i></a>
								<a href="/admin/page/edit/?id=<?= $page->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Редактировать"><i
										class="fa fa-edit"></i></a>
								<!--		
								<a href="/admin/page/delete/?id=<?//= $page->id ?>" class="tool-link"
								   data-toggle="tooltip" data-placement="top" title="Удалить"><i
										class="fa fa-trash-o"></i></a>
								-->		
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<hr/>
			<!--i class="fa fa-plus-circle"></i> <a class="link" href="">Создать страницу</a-->
		</div>
	</div>


</div>
<script type="text/javascript">

	$(function () {
		$("#a_m_pages").addClass("select");
	})

</script>