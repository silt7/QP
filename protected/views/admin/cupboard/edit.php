<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/cupboard" class="link"><?= $this->pageTitle?></a></li>
		<li class="active"><?= $cupboard->title ?></li>
	</ol>
</div>

<div class="container">
<h1 class="head"><?= $cupboard->title ?></h1>

<form action="/admin/cupboard/save" method="post" enctype="multipart/form-data">
<input hidden="hidden" name="id" value="<?= $cupboard->id ?>">

<div class="row">


	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Заголовок</label>
					<input type="text" name="title" class="form-control" placeholder="Название"
					       value="<?= $cupboard->title ?>">
				</div>


				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<i class="fa fa-eye"></i> <?= $cupboard->is_show ? 'Отображать' : 'Не отображать' ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<input type="radio" id="ex2_2_1" name="is_show"
								       value="0" <?= ! $cupboard->is_show ? 'checked' : '' ?>>
								<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
							</li>
							<li>
								<input type="radio" id="ex2_2_2" name="is_show"
								       value="1" <?= $cupboard->is_show ? 'checked' : '' ?>>
								<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
							</li>
						</ul>
					</div>

				</div>
				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<?= ( $cupboard->getFolderModel() and $cupboard->getFolderModel()->title != "" ) ? $cupboard->getFolderModel()->title : "Папка" ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?  $currentFolder = $cupboard->folder_id;
							$criteria          = new CDbCriteria();
							$criteria          = "model='cupboard'";
							$allFolders        = Folder::model()->findAll( $criteria );
							foreach ( $allFolders as $folderItem ):
								?>
								<li>
									<input type="radio" id="folder_<?= $folderItem->id ?>" name="folder_id"
									       value="<?= $folderItem->id ?>" <?= $folderItem->id == $currentFolder ? 'checked' : '' ?>>
									<label for="folder_<?= $folderItem->id ?>"><?= $folderItem->title ?></label>
								</li>
							<? endforeach ?>
						</ul>
					</div>

				</div>
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Цена</label>

					<div class="input-group">
						<input type="text" name="price" class="form-control" value="<?= $cupboard->price ?>" placeholder="0"
						       aria-describedby="price">
						<span class="input-group-addon" id="price">руб</span>
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
        				   value="<?= $cupboard->img_alt ?>">
        		</div>
				<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

                <div class="form-group">
                	<?php if ( $cupboard->image ): ?>
                		<img src="<?= $cupboard->getImage() ?>" width="100%">
                	<?php endif; ?>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<textarea id="ckeditor" name="description"><?= $cupboard->description ?></textarea>
				</div>

			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<textarea id="ckeditor2" name="description2"><?= $cupboard->description2 ?></textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-2">
		<?php if ( $cupboard->image ): ?>
			<img src="<?= $cupboard->getImage() ?>" width="100%">
		<?php endif; ?>
	</div>
</div>
<div class="panel-footer">
	<a href="/admin/cupboard" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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
	$(function () {
		var ck_newsContent = CKEDITOR.replace('ckeditor2');
		CKFinder.SetupCKEditor(ck_newsContent, '/js/lib/ckfinder/');
	})

</script>