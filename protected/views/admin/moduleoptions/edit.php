<? $moduleOption = $this->processOutput( $moduleOption ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/module-options" class="link">Редактирование опций</a></li>
		<li class="active"><?= $moduleOption->title ?> (<?= $moduleOption->getGroupLabel() ?>)</li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $moduleOption->title ?> (<?= $moduleOption->getGroupLabel() ?>)</h1>

	<form action="/admin/module-option/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $moduleOption->id ?>">

		<div class="row">
			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $moduleOption->title ?>">
							<label>Цена</label>
						   <input type="text" name="price" class="form-control" placeholder="Цена"
						   value="<?= $moduleOption->price ?>">
						</div>
						<!--
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>предоплата</label>

							<div class="input-group">-->
								<input type="hidden" name="pre_pay" class="form-control" value="0<? //= $moduleOption->pre_pay ?>" placeholder="0"
								       aria-describedby="pre_pay">
								<!--<span class="input-group-addon" id="pre_pay">%</span>
							</div>
						</div>
						-->
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= $moduleOption->getGroupLabel() != "" ? $moduleOption->getGroupLabel() : "Тип" ?>

									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentGroup = $moduleOption->group;
									foreach ( ModuleOption::$groups as $group ):
										?>
										<li>
											<input type="radio" id="type_<?= $group['name'] ?>" name="group"
											       value="<?= $group['name'] ?>" <?= $group['name'] == $currentGroup ? 'checked' : '' ?>>
											<label for="type_<?= $group['name'] ?>"><?= $group['label'] ?></label>
										</li>
									<? endforeach ?>
								</ul>
							</div>

						</div>


						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $moduleOption->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $moduleOption->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show"
										       value="1" <?= $moduleOption->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>

						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Картинка</label>
							<input type="file" name="image" class="filestyle" data-buttonName="btn-primary" data-buttonText="image"
							       data-buttonBefore="true">
							<input type="checkbox" name="del_img" value="y"/> Пометить на удаление
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>

			</div>
			<div class="col-md-5">
				<?php if ( $moduleOption->image ): ?>
					<img src="<?= $moduleOption->getImage() ?>?p=<?= date("YmdHis");?>" width="35%">
				<?php endif; ?>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/module-options" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>
