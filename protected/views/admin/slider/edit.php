<? $slide = $this->processOutput( $slide ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/slider" class="link">Редактирование слайдов</a></li>
		<li class="active"><?= $slide->title ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $slide->title ?></h1>

	<form action="/admin/slider/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $slide->id ?>">

		<div class="row">


			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $slide->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Короткое описание</label>
							<input type="text" name="text" class="form-control" placeholder="Короткое описание"
							       value="<?= $slide->text ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Ссылка</label>
							<input type="text" name="link" class="form-control" placeholder="Ссылка"
							       value="<?= $slide->link ?>">
						</div>
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $slide->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show" value="0" <?= ! $slide->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $slide->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<span class="text-danger">*</span>
								<label>Порядок</label>
								<input type="text" name="order" class="form-control" placeholder="Ссылка"
									   value="<?= $slide->orderIMG ?>">
							</div>
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Картинка</label>
							<input type="file" name="image" class="filestyle" data-buttonName="btn-primary" data-buttonText="image"
							       data-buttonBefore="true">
						</div>
						<div class="form-group">
							<label>Текст картинки</label>
							<input type="text" name="img_alt" class="form-control" placeholder="Текст картинки"
							       value="<?= $slide->img_alt ?>">
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>

			</div>
			<div class="col-md-6">
				<?php if ( $slide->image ): ?>
					<img src="/images/slider/<?= $slide->image ?>" width="100%">
				<?php endif; ?>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/slider" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>
