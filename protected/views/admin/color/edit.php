<? $color = $this->processOutput( $color ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/colors" class="link">Редактирование цветов</a></li>
		<li class="active"><?= $color->title ?> (<?= $color->getMaterialLabel() ?>) - <?= $color->getTypeLabel() ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $color->title ?> (<?= $color->getMaterialLabel() ?>) - <?= $color->getTypeLabel() ?>  </h1>

	<form action="/admin/color/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $color->id ?>">

		<div class="row">


			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $color->title ?>">
						</div>

						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= $color->getMaterialLabel() != "" ? $color->getMaterialLabel() : "Материал" ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentColorMaterial = $color->material;
									foreach ( Color::materials() as $colorMaterial ):
										?>
										<li>
											<input type="radio" id="type_<?= $colorMaterial['name'] ?>" name="material"
											       value="<?= $colorMaterial['name'] ?>" <?= $colorMaterial['name'] == $currentColorMaterial ? 'checked' : '' ?>>
											<label for="type_<?= $colorMaterial['name'] ?>"><?= $colorMaterial['label'] ?></label>
										</li>
									<? endforeach ?>
								</ul>
							</div>

						</div>

                        <div class="form-group">
                            <label>Дополнительные категории</label>
                            <div class="btn-group" style="border:1px solid #ddd; width: 100%">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<?= $color->getMaterialLabel() != "" ? $color->getMaterialLabel() : "Материал" ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<?  $currentColorMaterial = $color->material;
									foreach ( Color::materials() as $colorMaterial ):
										?>
										<li>
											<input type="radio" id="typeAdd_<?= $colorMaterial['name'] ?>" name="addCateg"
											       value="<?= $colorMaterial['name'] ?>" <?= $colorMaterial['name'] == $currentColorMaterial ? 'checked' : '' ?>>
											<label for="typeAdd_<?= $colorMaterial['name'] ?>"><?= $colorMaterial['label'] ?></label>
										</li>
									<? endforeach ?>
								</ul>
                                <a onClick="addCateg();"><i class="fa fa-plus-circle" style="font-size:25px;margin:5px"></i></a>
                            
                                <div>  
                                    <? foreach($decorCategories as $item): ?>
                                    <p><?= $item->categ;?></p>
                                    <?endforeach;?>
                                </div>
                            </div>
                        </div>
                        
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $color->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $color->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show"
										       value="1" <?= $color->is_show ? 'checked' : '' ?>>
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
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Тип</label>
							<br>
							<a class="btn btn-default <?= $color->is_front ? "btn-success" : "" ?> adm-module-extra-options">
								Фасад
								<input type="checkbox" name="is_front" value="1"
									<?= $color->is_front ? "checked" : "" ?> >
							</a>
							<a class="btn btn-default <?= $color->is_module ? "btn-success" : "" ?> adm-module-extra-options">
								Модуль
								<input type="checkbox" name="is_module" value="1"
									<?= $color->is_module ? "checked" : "" ?> >
							</a>
							<a class="btn btn-default <?= $color->is_tabletop ? "btn-success" : "" ?> adm-module-extra-options">
								Столешница
								<input type="checkbox" name="is_tabletop" value="1"
									<?= $color->is_tabletop ? "checked" : "" ?> >
							</a>
							<a class="btn btn-default <?= $color->is_wall_panel ? "btn-success" : "" ?> adm-module-extra-options">
								Стеновая панель
								<input type="checkbox" name="is_wall_panel" value="1"
									<?= $color->is_wall_panel ? "checked" : "" ?> >
							</a>
							<a class="btn btn-default <?= $color->is_accessory ? "btn-success" : "" ?> adm-module-extra-options">
								Аксессуар
								<input type="checkbox" name="is_accessory" value="1"
									<?= $color->is_accessory ? "checked" : "" ?> >
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php if ( $color->image ): ?>
					<img src="<?= $color->getImage() ?>.png?p=<?= rand()?>" width="100%">
				<?php endif; ?>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/colors" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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
	function addCateg(){
	   var id_color = $('input[name="id"]').val();
	   var material = $('input[name="addCateg"]:checked').val();
	   $.ajax({
	       type: 'POST',
	       url: 'addCateg',
	       dataType: 'json',
	       data: {'id_color':id_color,'categ':material},
	       success: function(data){
	           location.reload();
	       },
	       error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
	   });
	}
    


</script>