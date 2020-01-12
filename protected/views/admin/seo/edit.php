<? $seo = $this->processOutput( $seo ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/seo" class="link">Редактирование SEO</a></li>
		<li class="active"><?= $seo->title ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $seo->title ?></h1>

	<form action="/admin/seo/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $seo->id ?>">

		<div class="row">

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Title</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $seo->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Description</label>
							<input type="text" name="desription" class="form-control" placeholder="Короткое описание"
							       value="<?= $seo->desription ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Keywords</label>
							<input type="text" name="keywords" class="form-control" placeholder="Короткое описание"
							       value="<?= $seo->keywords ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>URL</label>
							<input type="text" name="url" class="form-control" placeholder="Короткое описание"
							       value="<?= $seo->url ?>">
						</div>

						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>

				</div>


			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/seo" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>