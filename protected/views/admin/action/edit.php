<? $action = $this->processOutput( $action ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/actions" class="link">Редактирование акций</a></li>
		<li class="active"><?= $action->title ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $action->title ?></h1>

	<form action="/admin/action/save" method="post">
		<input hidden="hidden" name="id" value="<?= $action->id ?>">

		<div class="row">

			<div class="col-md-8">
				<textarea id="ckeditor" name="text"><?= $action->text ?></textarea>
				<br/>
				<br/>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $action->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Короткое описание</label>
							<input type="text" name="short_text" class="form-control" placeholder="Короткое описание"
							       value="<?= $action->short_text ?>">
						</div>
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $action->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $action->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $action->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>
						</div>


						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>

			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/actions" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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
	})


</script>