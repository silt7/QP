<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin" class="link">Редактирование страниц</a></li>
		<li class="active">Заголовок страницы</li>
	</ol>
</div>

<div class="container">
	<h1 class="head">Заголовок страницы</h1>

	<form action="/admin/page/save" method="post">
		<? $page = $this->processOutput( $page ); ?>
		<input hidden="hidden" name="id" value="<?= $page->id ?>">

		<div class="row">

			<div class="col-md-8">
				Контент
				<textarea id="ckeditor" name="content"><?= $page->content ?></textarea>
				<br/>
				<br/>
				Контент 2
				<textarea id="ckeditor2" name="content2"><?= $page->content2 ?></textarea>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $page->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Пункт меню:</label>
							<input type="text" name="menu" class="form-control" placeholder="Пункт меню"
							       value="<?= $page->menu ?>">
						</div>
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $page->in_menu ? 'Показывать в меню' : 'Не показывать в меню' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show" value="0" <?= ! $page->in_menu ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не показывать в меню</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $page->in_menu ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Показывать в меню</label>
									</li>
								</ul>
							</div>

						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Ссылка на страницу (не мнять)</label>
							<input readonly type="text" name="url" class="form-control" placeholder="Ссылка на страницу"
							       value="<?= $page->url ?>">
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>

			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/pages" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>
<script type="text/javascript">

	$(function () {

		var ck_newsContent = CKEDITOR.replace('ckeditor');
		CKFinder.SetupCKEditor(ck_newsContent, '/js/lib/ckfinder/');
		var ck_newsContent2 = CKEDITOR.replace('ckeditor2');
		CKFinder.SetupCKEditor(ck_newsContent2, '/js/lib/ckfinder/');
	})


</script>