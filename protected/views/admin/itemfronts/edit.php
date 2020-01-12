<? $itemFront = $this->processOutput( $itemFront ); ?>
<? $colors = $this->processOutput( $colors ); ?>
<? $options = $this->processOutput( $options ); ?>
<?
	if(substr($itemFront->pre_pay,0,1) == "a"){
		$pre_pay = unserialize($itemFront->pre_pay);
	}
	else{
		$pre_pay[0] = 0;
		$pre_pay[1] = 0;
		$pre_pay[2] = 0;
	}
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/item-fronts" class="link">Редактирование фасадов</a></li>
		<li class="active"><?= $itemFront->title ?></li>
	</ol>
</div>

<div  class="container">
	<h1 class="head"><?= $itemFront->title ?></h1>
	<form action="/admin/item-front/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $itemFront->id ?>">
		<div class="row">
				<div class="panel panel-default" style="display:inline-block;">
					<div class="panel-body" style="width:50%; float: left; margin-right: 50px;">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $itemFront->title ?>">
						</div>


						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $itemFront->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $itemFront->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show"
										       value="1" <?= $itemFront->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>

						</div>

						<div class="form-group">
							<span class="text-danger">*</span>
							<label>предоплата</label>
							<br>ЛДСП:
							<div class="input-group" style="width: 30%;">
								 <input type="text" name="pre_pay_ldsp" class="form-control" value="<?= $pre_pay[0] ?>" placeholder="0"
								       aria-describedby="pre_pay">
								<span class="input-group-addon" id="pre_pay">%</span>
							</div>
							<br>МДФ:
							<div class="input-group" style="width: 30%;">
								 <input type="text" name="pre_pay_mdf" class="form-control" value="<?= $pre_pay[1]?>" placeholder="0"
								       aria-describedby="pre_pay_plast">
								<span class="input-group-addon" id="pre_pay">%</span>
							</div>
							<br>Пластик:
							<div class="input-group" style="width: 30%;">
								 <input type="text" name="pre_pay_plast" class="form-control" value="<?= $pre_pay[2]?>" placeholder="0"
								       aria-describedby="pre_pay">
								<span class="input-group-addon" id="pre_pay">%</span>
							</div>
						</div>
						
						<div class="form-group">
							<textarea id="ckeditor" name="description"><?= $itemFront->description ?></textarea>
						</div>
						<div class="form-group">
							<label>Фильтр</label>

							<div class="input-group">
								<input type="text" name="filtr" class="form-control" value="<?= $itemFront->filtr ?>">
							</div>
						</div>
			
						<div class="form-group" style="width: 250px;">
							<span class="text-danger">*</span>
							<label>Картинка</label>
							<input type="file" name="image" class="filestyle" data-buttonName="btn-primary" data-buttonText="image"
								   data-buttonBefore="true">
							<input type="checkbox" name="del_img" value="y"/> Пометить на удаление	
						</div>
						<div class="form-group">
							<label>Текст картинки</label>
							<input type="text" name="img_alt" class="form-control" placeholder="Текст картинки"
							       value="<?= $itemFront->img_alt ?>">
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
					<?php if ( $itemFront->image ): ?>
						<img src="<?= $itemFront->getImage() ?>?p=<?= date("YmdHis");?>" width="200px">
					<?php endif; ?> 
					<br>
				</div>
				<!--
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Цвета</label><span style="color: red"></span>
							<br>

							<?php
							$modelColors = $itemFront->getColors();
							$colorGroup  = "";
							foreach ( $colors as $color ):
								if ( $colorGroup != $color->getMaterialLabel() ) {
									$colorGroup = $color->getMaterialLabel();
									echo '<br><p style="font-size:20px; font-weight: bold; margin-top: 25px;">' . $colorGroup . '</p>';
									$priceCriteria            = new CDbCriteria;
									$pr=0;
									foreach($price as $itemPrice){
										if ($itemPrice['name'] == $color->material){
											$pr = $itemPrice['price_category'];
										}
									}
									
							?>		
									<div class="input-group pull-right" style="margin-bottom: 25px;">
										<span class="input-group-addon" id="count-<?= $color->id ?>">Цена</span>
										<input type="text" class="form-control" value="<?= $pr?>" placeholder="0"
										       aria-describedby="count-<?= $color->id ?>" style="margin-left: 0;width: 150px;" disabled>				
									</div>

							<?		for($i=0; $i < count($count_milling); $i++){
										$sch = $i + 1;
										$frez="price_fr".$sch;
										$pr = 0;
										$issetFrez = 0;
										foreach($priceFrez as $itemPrice){
											if ($itemPrice['name'] == $color->material){
												$pr = $itemPrice[$frez];
												$issetFrez = $itemPrice['frez'];
											}
										}
										if($issetFrez == 1):
							?>
										<a  class="btn btn-default <?= $pr > 0 ? "btn-success" : "" ?> adm-module-extra-options"> <?= $count_milling[$i]?>
											<div class="input-group pull-right">
												<input type="text" class="form-control" value="<?= $pr?>" placeholder="0" disabled>
												<span class="input-group-addon">руб</span>
											</div>
										</a>
								
							<?			endif;
									}	
								}
								
								$isChecked = false;
								if ( $modelColors != null and isset( $modelColors[ $color->id ] ) ) {
									$isChecked = $modelColors[ $color->id ]['is_enabled'];
								}
							?>
								<a style="width: 300px"  class="btn btn-default <?= $isChecked ? "btn-success" : "" ?> adm-module-extra-options"> <?= $color->title ?>
									<div class="input-group pull-right" style="display: none;">
										<input type="text"  name="color_<?= $color->id ?>" class="form-control" value="0" placeholder="0"
											   aria-describedby="count-<?= $color->id ?>" >
									</div>
									<input type="checkbox" name="colors[]" value="<?= $color->id ?>"
										<?= $isChecked ? "checked" : "" ?> >
								</a>	
		
							<? endforeach; ?>
						</div>
					</div>
				</div>
				-->
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Опции</label>
							<br>

							<?php
							$modelOptions = $itemFront->getOptions();
							$optionGroup  = "";
							foreach ( $options as $option ):
								if($option->group != 'milling'):
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
											<span class="input-group-addon" id="option-<?= $option->id ?>">шт.</span>
											<input type="text" class="form-control" value="<?= $option["price"]*$price?>" disabled><span class="input-group-addon">руб.</span>
										</div>

										<input type="checkbox" name="options[]" value="<?= $option->id ?>"
											<?= $isChecked ? "checked" : "" ?> >
									</a>
							<?endif; endforeach; ?>
						</div>
					</div>
				</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/item-fronts" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>

<!--
<div class="modal module-modal" id="front-modal"  tabindex="-1" role="dialog" aria-labelledby="Подробная информация" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close closes" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<h4 class="modal-title" id="frontModalTitle">Модуль 1</h4>
			</div>
			<div class="modal-body">
				<div>
					id_front = <span id="id_front">???</span><br>
					id_color = <span id="id_color">???</span>
					<a class="btn btn-default btn-success adm-module-extra-options"> Фрезировка 1
						<div class="input-group pull-right">
							<input type="text" name="option-?" class="form-control" value="148" placeholder="0"
								   aria-describedby="option-?">
							<span class="input-group-addon" id="option-?">руб</span>
						</div>

						<input type="checkbox" name="options[]" value="">
					</a>
					<a class="btn btn-default btn-success adm-module-extra-options"> Фрезировка 2
						<div class="input-group pull-right">
							<input type="text" name="option-?" class="form-control" value="200" placeholder="0"
								   aria-describedby="option-?">
							<span class="input-group-addon" id="option-?">руб</span>
						</div>

						<input type="checkbox" name="options[]" value="">
					</a>
					<a class="btn btn-default btn-success adm-module-extra-options"> Фрезировка 3
						<div class="input-group pull-right">
							<input type="text" name="option-?" class="form-control" value="300" placeholder="0"
								   aria-describedby="option-?">
							<span class="input-group-addon" id="option-?">руб</span>
						</div>

						<input type="checkbox" name="options[]" value="">
					</a>
					<a class="btn btn-default btn-success adm-module-extra-options"> Фрезировка 4
						<div class="input-group pull-right">
							<input type="text" name="option-?" class="form-control" value="400" placeholder="0"
								   aria-describedby="option-?">
							<span class="input-group-addon" id="option-?">руб</span>
						</div>

						<input type="checkbox" name="options[]" value="">
					</a>
					<a class="btn btn-default btn-success adm-module-extra-options"> Аллюминивая рамка
						<div class="input-group pull-right">
							<input type="text" name="option-?" class="form-control" value="500" placeholder="0"
								   aria-describedby="option-?">
							<span class="input-group-addon" id="option-?">руб</span>
						</div>

						<input type="checkbox" name="options[]" value="">
					</a>
				</div>
				<div class="row controls">
					<div class="col-md-offset-6 col-md-3 col-sm-offset-4 col-sm-4 col-xs-6"><a class="btn btn-danger closes" data-dismiss="modal">Закрыть</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<script type="text/javascript">
	$(".closes").click(function(){
		$("#front-modal").hide();
	})
	$(".link_frez").click(function(){
		$("#front-modal").show();

		var id_color= $(this).attr("name");
		
		$("#id_color").html(id_color);
		//alert(ddd);
	})
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