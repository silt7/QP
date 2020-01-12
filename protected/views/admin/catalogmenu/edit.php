<? $catalogMenuItem = $this->processOutput( $catalogMenuItem ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/catalog-menu" class="link">Редактирование меню каталога</a></li>
		<li class="active"><?= $catalogMenuItem->title ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $catalogMenuItem->title ?></h1>

	<form action="/admin/catalog-menu/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $catalogMenuItem->id ?>">

		<div class="row">


			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $catalogMenuItem->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Ссылка</label>
							<input readonly type="text" name="link" class="form-control" placeholder="Название"
							       value="<?= $catalogMenuItem->link ?>">
						</div>

						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $catalogMenuItem->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $catalogMenuItem->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show"
										       value="1" <?= $catalogMenuItem->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>

						</div>
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= ( $catalogMenuItem->getFolderModel() and $catalogMenuItem->getFolderModel()->title != "" ) ? $catalogMenuItem->getFolderModel()->title : "Папка" ?>

									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentFolder = $catalogMenuItem->folder_id;
									$allFolders        = Folder::model()->findAll();
									foreach ( $allFolders as $folderItem ):
										?>
										<li>
											<input type="radio" id="folder_<?= $folderItem->id ?>" name="folder"
											       value="<?= $folderItem->id ?>" <?= $folderItem->id == $currentFolder ? 'checked' : '' ?>>
											<label for="folder_<?= $folderItem->id ?>"><?= $folderItem->title ?></label>
										</li>
									<? endforeach ?>
								</ul>
							</div>

						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>

			</div>

		</div>
		<div class="panel-footer">
			<a href="/admin/catalog-menu" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>
