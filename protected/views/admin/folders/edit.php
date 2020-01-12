<? $folder = $this->processOutput( $folder ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/folders" class="link">Редактирование папок</a></li>
		<li class="active"><?= $folder->title ?> </li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $folder->title ?>   </h1>

	<form action="/admin/folders/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $folder->id ?>">

		<div class="row">


			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $folder->title ?>">
						</div>

						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= ( $folder->getParentModel() and $folder->getParentModel()->title != "" ) ? $folder->getParentModel()->title : "Родительская папка" ?>

									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentFolder = $folder->parent_id;
									$allFolders        = Folder::model()->findAll();
									foreach ( $allFolders as $folderItem ):
										?>
										<li>
											<input type="radio" id="folder_<?= $folderItem->id ?>" name="parent_folder"
											       value="<?= $folderItem->id ?>" <?= $folderItem->id == $currentFolder ? 'checked' : '' ?>>
											<label for="folder_<?= $folderItem->id ?>"><?= $folderItem->title ?></label>
										</li>
									<? endforeach ?>
								</ul>
							</div>

						</div>


						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= ( $folder->model and $folder->model != "" ) ? Folder::$models[ $folder->model ]["label"] : "Модель" ?>

									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentModel = $folder->model;
									$allModels        = Folder::$models;
									foreach ( $allModels as $key => $modelItem ):
										?>
										<li>
											<input type="radio" id="model_<?= $key ?>" name="model"
											       value="<?= $key ?>" <?= $key == $currentModel ? 'checked' : '' ?>>
											<label for="model_<?= $key ?>"><?= $modelItem["label"] ?></label>
										</li>
									<? endforeach ?>
								</ul>
							</div>

						</div>


						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $folder->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $folder->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show"
										       value="1" <?= $folder->is_show ? 'checked' : '' ?>>
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

						</div>
    					<div class="form-group">
    						<label>Текст картинки</label>
    						<input type="text" name="img_alt" class="form-control" placeholder="Текст картинки"
    						       value="<?= $folder->img_alt ?>">
    					</div>

					</div>
				</div>

			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Контент верх</label>
					<textarea id="ckeditor" name="content1"><?= $folder->content ?></textarea>
				</div>
				<div class="form-group">
					<label>Контент низ</label>
					<textarea id="ckeditor2" name="content2"><?= $folder->content2 ?></textarea>
				</div>
			</div>
			<div class="col-md-2">
				<?php if ( $folder->image ): ?>
					<img src="<?= $folder->getImage() ?>" width="100%">
				<?php endif; ?>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/folders" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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