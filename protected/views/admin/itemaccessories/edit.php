<? $colors = $this->processOutput( $colors ); ?>
<? $options = $this->processOutput( $options ); ?>
<? $accessory = $this->processOutput( $accessory ); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/item-accessories" class="link">Редактирование аксессуаров</a></li>
		<li class="active"><?= $accessory->title ?></li>
	</ol>
</div>

<div class="container">
<h1 class="head"><?= $accessory->title ?></h1>

<form action="/admin/item-accessories/save" method="post" enctype="multipart/form-data">
<input hidden="hidden" name="id" value="<?= $accessory->id ?>">

<div class="row">


	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Заголовок</label>
					<input type="text" name="title" class="form-control" placeholder="Название"
					       value="<?= $accessory->title ?>">
				</div>


				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<i class="fa fa-eye"></i> <?= $accessory->is_show ? 'Отображать' : 'Не отображать' ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<input type="radio" id="ex2_2_1" name="is_show"
								       value="0" <?= ! $accessory->is_show ? 'checked' : '' ?>>
								<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
							</li>
							<li>
								<input type="radio" id="ex2_2_2" name="is_show"
								       value="1" <?= $accessory->is_show ? 'checked' : '' ?>>
								<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
							</li>
						</ul>
					</div>

				</div>
				<!--
				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<i class="fa fa-eye"></i> <?//= $accessory->show_cover ? 'Отображать в покрытиях' : 'Не отображать в покрытиях' ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<input type="radio" id="ex3_2_1" name="show_cover"
								       value="0" <?//= ! $accessory->show_cover ? 'checked' : '' ?>>
								<label for="ex3_2_1"><i class="fa fa-close"></i> Не отображать в покрытиях</label>
							</li>
							<li>
								<input type="radio" id="ex3_2_2" name="show_cover"
								       value="1" <?//= $accessory->show_cover ? 'checked' : '' ?>>
								<label for="ex3_2_2"><i class="fa fa-check"></i> Отображать в покрытиях</label>
							</li>
						</ul>
					</div>

				</div>
				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<i class="fa fa-eye"></i> <?//= $accessory->show_wall ? 'Отображать в сп' : 'Не отображать в сп' ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<input type="radio" id="ex4_2_1" name="show_wall"
								       value="0" <?//= ! $accessory->show_wall ? 'checked' : '' ?>>
								<label for="ex3_2_1"><i class="fa fa-close"></i> Не отображать в сп</label>
							</li>
							<li>
								<input type="radio" id="ex4_2_2" name="show_wall"
								       value="1" <?//= $accessory->show_wall ? 'checked' : '' ?>>
								<label for="ex4_2_2"><i class="fa fa-check"></i> Отображать в сп</label>
							</li>
						</ul>
					</div>

				</div>
				-->
				<div class="form-group">

					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
							<?= ( $accessory->getFolderModel() and $accessory->getFolderModel()->title != "" ) ? $accessory->getFolderModel()->title : "Папка" ?>

							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?  $currentFolder = $accessory->folder_id;
							$criteria          = new CDbCriteria();
							$criteria          = "model='accessory'";
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
					<label>предоплата</label>

					<div class="input-group">
						<input type="text" name="pre_pay" class="form-control" value="<?= $accessory->pre_pay ?>" placeholder="0"
						       aria-describedby="pre_pay">
						<span class="input-group-addon" id="pre_pay">%</span>
					</div>
				</div>
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Цена</label>

					<div class="input-group">
						<input type="text" name="price" class="form-control" value="<?= $accessory->price ?>" placeholder="0"
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
        				   value="<?= $accessory->img_alt ?>">
        		</div>
				<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

			</div>
		</div>


		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Опции</label>
					<br>

					<?php
					$modelOptions = $accessory->getOptions();
					$optionGroup  = "";
					foreach ( $options as $option ):
						if ( $optionGroup != $option->getGroupLabel() ) {
							$optionGroup = $option->getGroupLabel();
							echo '<br><h4>' . $optionGroup . '</h4>';
						}
						$isChecked = false;
						$price     = "";

						if ( $modelOptions != null and isset( $modelOptions[ $option->id ] ) ) {
							$isChecked = $modelOptions[ $option->id ]['is_enabled'];
							$price     = $modelOptions[ $option->id ]['price'];
						}



						?>



						<a class="btn btn-default <?= $isChecked ? "btn-success" : "" ?> adm-module-extra-options"> <?= $option->title ?>
							<div class="input-group pull-right">
								<input type="text" name="option_<?= $option->id ?>" class="form-control" value="<?= $price ?>" placeholder="0"
								       aria-describedby="option-<?= $option->id ?>">
								<span class="input-group-addon" id="option-<?= $option->id ?>">руб</span>
							</div>

							<input type="checkbox" name="options[]" value="<?= $option->id ?>"
								<?= $isChecked ? "checked" : "" ?> >
						</a>
					<? endforeach; ?>
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<textarea id="ckeditor" name="description"><?= $accessory->description ?></textarea>
				</div>

			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<span class="text-danger">*</span>
					<label>Цвета</label>
					<br>

					<?php
					$modelColors = $accessory->getColors();
					$colorGroup  = "";
					foreach ( $colors as $color ):
						if ( $colorGroup != $color->getMaterialLabel() ) {
							$colorGroup = $color->getMaterialLabel();
							echo '<br><h4>' . $colorGroup . '</h4>';
						}
						$isChecked = false;
						$price     = "";

						if ( $modelColors != null and isset( $modelColors[ $color->id ] ) ) {
							$isChecked = $modelColors[ $color->id ]['is_enabled'];
							$price     = $modelColors[ $color->id ]['price'];
						}



						?>



						<a class="btn btn-default <?= $isChecked ? "btn-success" : "" ?> adm-module-extra-options"> <?= $color->title ?>
							<div class="input-group pull-right" style="display: none">
								<input type="text" name="color_<?= $color->id ?>" class="form-control" value="<?= intval( $price ) ?>" placeholder="0"
								       aria-describedby="count-<?= $color->id ?>">
								<span class="input-group-addon" id="count-<?= $color->id ?>">руб</span>
							</div>
							<input type="checkbox" name="colors[]" value="<?= $color->id ?>"
								<?= $isChecked ? "checked" : "" ?> >
						</a>
					<? endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<?php if ( $accessory->image ): ?>
			<img src="<?= $accessory->getImage() ?>" width="100%">
		<?php endif; ?>
	</div>
</div>
<div class="panel-footer">
	<a href="/admin/item-accessories" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
	<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
			class="fa fa-check"></i> Сохранить
	</button>
</div>
</form>

</div>

<script type="text/javascript">

	$(".adm-module-extra-options input[type='text']").click(function () {
		var thisInput = $(this);
		var thisInputGroup = thisInput.parent();
		var thisBtn = thisInputGroup.parent();
		setTimeout(function () {
			thisBtn.removeClass("btn-success").addClass("btn-success");
			thisBtn.find("input[type='checkbox']").prop('checked', true);
		}, 1);
		var textInput = thisBtn.find("input[type='text']");
		if (textInput.val() == "") {
			textInput.val(0);
		}
	})

	$(".adm-module-extra-options").click(function () {
		var thisButton = $(this);

		if (thisButton.hasClass("btn-success")) {
			thisButton.removeClass("btn-success");
			thisButton.find("input[type='checkbox']").prop('checked', false);
		} else {
			thisButton.addClass("btn-success");
			thisButton.find("input[type='checkbox']").prop('checked', true);
			var textInput = thisButton.find("input[type='text']");
			if (textInput.val() == "") {
				textInput.val(0);
			}
		}
	});


	$(function () {

		var ck_newsContent = CKEDITOR.replace('ckeditor');
		CKFinder.SetupCKEditor(ck_newsContent, '/js/lib/ckfinder/');
	})


</script>