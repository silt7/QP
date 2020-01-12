<? $kitchen = $this->processOutput( $kitchen ); ?>
<? $images = unserialize($kitchen->img_add);?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/kitchens" class="link">Редактирование кухонных гарнитуров</a></li>
		<li class="active"><?= $kitchen->title ?></li>
	</ol>
</div>

<div class="container">
	<h1 class="head"><?= $kitchen->title ?></h1>

	<form action="/admin/kitchens/save" method="post" enctype="multipart/form-data" id="kitchen-form">
		<input hidden="hidden" name="id" value="<?= $kitchen->id ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
								   value="<?= $kitchen->title ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Цена (руб)</label>
							<input type="text" name="price" class="form-control" placeholder="Цена"
								   value="<?= $kitchen->price ?>">
						</div>
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $kitchen->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
											   value="0" <?= ! $kitchen->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $kitchen->is_show ? 'checked' : '' ?>>
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
								   value="<?= $kitchen->img_alt ?>">
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Картинка (дополнительно)</label>
							<input type="file" name="imageAdd[]" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Image" multiple="multiple" accept="image/png,image/jpeg" data-buttonBefore="true">
						</div>
						<div class="form-group">
							<label>URL</label>
							<input type="text" name="urlT" class="form-control" placeholder="url"
								   value="<?= $kitchen->urlT ?>">
						</div>
						<div class="form-group">
							<label>Порядок</label>
							<input type="text" name="sort" class="form-control" placeholder="Порядок"
								   value="<?= $kitchen->sorts ?>">
						</div>
						<div class="form-group">
							<label>Категория</label><br>
							<?$categ = unserialize($kitchen->filtr);if(empty($categ)){$categ=array('0'=>'empty');}?>

							<div class="btn-group">
								<table>
									<tr>
										<td><input type="checkbox" name="classic" value="1" <?= in_array('classic',$categ) ? "checked" : "";?>>&nbspКлассические&nbsp </td>
										<td><input type="checkbox" name="modern" value="1" <?= in_array('modern',$categ) ? "checked" : "";?>>&nbspСовременные&nbsp </td>
										<td><input type="checkbox" name="ugol" value="1" <?= in_array('ugol',$categ) ? "checked" : "";?>>&nbspУгловые&nbsp </td>
										<td><input type="checkbox" name="direct" value="1" <?= in_array('direct',$categ) ? "checked" : "";?>>&nbspПрямые&nbsp </td>
									</tr>
									<tr>
										<td><input type="checkbox" name="premium" value="1" <?= in_array('premium',$categ) ? "checked" : "";?>>&nbspПремиум&nbsp </td>
										<td><input type="checkbox" name="low" value="1" <?= in_array('low',$categ) ? "checked" : "";?>>&nbspНедорогие&nbsp </td>
										<td><input type="checkbox" name="little" value="1" <?= in_array('little',$categ) ? "checked" : "";?>>&nbspМаленькие&nbsp </td>
										<td><input type="checkbox" name="big" value="1" <?= in_array('big',$categ) ? "checked" : "";?>>&nbspБольшие&nbsp </td>
									</tr>
									<tr>
									    <td><input type="checkbox" name="p-obraz" value="1" <?= in_array('p-obraz',$categ) ? "checked" : "";?>>&nbspП-образная&nbsp </td>
										<td><input type="checkbox" name="ostrov" value="1" <?= in_array('ostrov',$categ) ? "checked" : "";?>>&nbspС островком&nbsp </td>
										<td><input type="checkbox" name="bar" value="1" <?= in_array('bar',$categ) ? "checked" : "";?>>&nbspС барной стойкой&nbsp </td>
										<td><input type="checkbox" name="vstraivaemye" value="1" <?= in_array('vstraivaemye',$categ) ? "checked" : "";?>>&nbspВстраиваеиые&nbsp </td>
									</tr> 
								</table>
							</div>
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>


			</div>

			<div class="col-md-6">
				<?php if ( $kitchen->image ): ?>
					<img src="/images/kitchens/<?= $kitchen->image ?>" width="100%">
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
		<? if(!empty($images)):?>
			<?foreach($images as $image):?>
				<?php if ( $image ): ?>
				<div class="col-md-3">
					<br><img src="/images/kitchens/<?= $image['img'] ?>" width="100%">
					&nbsp&nbsp&nbsp
					<input type="checkbox" name="<?= str_replace(".","",$image['img']) ?>" value="1">&nbspПометить на удаление
					<br>
				</div>
				<?php endif; ?>
			<?endforeach;?>
		<?endif;?>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<span>Описание</span>
				<div class="form-group">
					<textarea id="ckeditor" name="description"><?= $kitchen->description ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<span>Характеристики</span>
				<div class="form-group">
					<textarea id="ckeditor2" name="description2"><?= $kitchen->description2 ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body" >
					<div class="form-group" >
						<input type="checkbox" name="deconstruct" value="1" <?= $kitchen->deconstruct==1?"checked":"" ?> >
						&nbspРазобрать
						<input type="text" name="id_kitchen" class="form-control" value="<?= $kitchen->id ?>" style="display:none">
					</div>
					<div class="form-group">
						<p class="h1">Элементы входящие в итоговую стоимость</p>
						<span class="text-danger">*</span>
						<label>Введите id модуля</label>
						<table><tr>
								<td><input type="text" name="id_module" class="form-control" value="" OnKeyPress="NumericText()" style="width: 50px;"></td>
								<td><input type="button" id="addModule" value="Добавить" style="margin:10px;"></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<div id="selModule">
							<? foreach($kitchenmodule as $item): ?>
								<div id="mod_<?= $item -> id_module?>" kitchenmodule="<?= $item->id;?>">
									<? $title = ItemModule::model()->findByPk( $item -> id_module ) -> title;?>
									<br><input type='text' name='cost' id="priceModule" value="<?= $item->price?>" disabled style="text-align:right;">
									<input type='button' value='...' class="module_b" data-toggle="modal" data-target="#kitchen-modal">
									<?= $title?>
									<a class="del_module">[х]</a>
								</div>
							<? endforeach; ?>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<span class="text-danger">*</span>
						<label>Введите id фасада</label>
						<table><tr>
								<td><input type="text" name="id_front" class="form-control" value="" OnKeyPress="NumericText()" style="width: 50px;"></td>
								<td><input type="button" id="addFront" value="Добавить" style="margin:10px;"></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<div id="selFront">
							<? foreach($kitchenfront as $item): ?>
								<div id="front_<?= $item -> id_front?>" kitchenFront="<?= $item->id;?>">
									<? $title = ItemFront::model()->findByPk( $item -> id_front ) -> title;?>
									<br><input type='text' name='cost' id="priceFront" value="<?= $item->price?>" disabled style="text-align:right;">
									<input type='button' value='...' class="front_b" data-toggle="modal" data-target="#kitchen-front">
									<?= $title?>
									<a class="del_front">[х]</a>
								</div>
							<? endforeach; ?>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<span class="text-danger">*</span>
						<label>Введите id столешницы</label>
						<table><tr>
								<td><input type="text" name="id_cover" class="form-control" value="" OnKeyPress="NumericText()" style="width: 50px;"></td>
								<td><input type="button" id="addCover" value="Добавить" style="margin:10px;"></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<div id="selCover">
							<? foreach($kitchencover as $item): ?>
								<div id="cover_<?= $item -> id_cover?>">
									<? $title = ItemCover::model()->findByPk( $item -> id_cover ) -> title;?>
									<br><input type='text' name='cost' id="priceFront" value="<?= $item->price?>" disabled style="text-align:right;">
									<input type='button' value='...' class="cover_b" data-toggle="modal" data-target="#kitchen-cover">
									<?= $title?>
									<a class="del_cover">[х]</a>
								</div>
							<? endforeach; ?>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<span class="text-danger">*</span>
						<label>Введите id Аксессуара</label>
						<table><tr>
								<td><input type="text" name="id_access" class="form-control" value="" OnKeyPress="NumericText()" style="width: 50px;"></td>
								<td><input type="button" id="addAccess" value="Добавить" style="margin:10px;"></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<div id="selAccess">
							<? foreach($kitchenaccess as $item): ?>
								<div id="access_<?= $item -> id_access?>">
									<? $title = Accessory::model()->findByPk( $item -> id_access ) -> title;?>
									<br><input type='text' name='cost' id="priceAccess" value="<?= $item->price?>" disabled style="text-align:right;">
									<input type='button' value='...' class="access_b" data-toggle="modal" data-target="#kitchen-access">
									<?= $title?>
									<a class="del_access">[х]</a>
								</div>
							<? endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<p class="h1">Вам понравится</p>
				<span class="text-danger">*</span>
				<label>Введите id кухни</label>
				<table><tr>
						<td><input type="text" name="id_kitchenLike" class="form-control" value="" OnKeyPress="NumericText()" style="width: 50px;"></td>
						<td><input type="button" id="addKitchen" value="Добавить" style="margin:10px;"></td>
					</tr>
				</table>
			</div>
			<div class="form-group">
				<div id="selkitchenLike">
					<? foreach($kitchenLikeIt as $item): ?>
						<div id="kitchenLike_<?= $item -> id_kitchenLike?>">
							<? $title = Kitchen::model()->findByPk( $item -> id_kitchenLike ) -> title;?>
							<?= $title?>
							<a class="del_kitchenLike">[х]</a>
						</div>
					<? endforeach; ?>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/kitchens" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Сохранить
			</button>
		</div>
	</form>

</div>
<script>
	$("#addKitchen").click(function(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Selkitchen',
			dataType: "json",
			data: $("#kitchen-form").serialize(),
			success: function(data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				/*if(p.title != ""){
					p2= "<div id='mod_" + p.id_module + "'><br><input type='text' name='cost' disabled>" +
						"<input type='button' value='...' data-toggle='modal' data-target='#kitchen-modal'>"
						+ p.title + "<a class='del_module'>[х]</a></div>";
					var selmodule = $("#selModule").html();
					$("#selModule").html(selmodule + p2);
				}*/
				location.reload();
			}
		});
	});
	$(".del_kitchenLike").click(function(){
		var id_kitchenLike = $(this).parent().attr("id").substr(12);
		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Delkitchen',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_kitchenLike:id_kitchenLike},
			success: function (data) {
				alert(data.data);
				$("#kitchenLike_"+id_kitchenLike).remove();
			}
		})
	})
</script>
<div class="modal" id="kitchen-modal" tabindex="-1" role="dialog" aria-labelledby="Опции модуля" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции модуля</p>
			</div>
			<div class="modal-body">
				<div id="id_kitchenModule" style="display:none"></div>
				<div id="id_select_module" style="display:none"></div>
				<div id="color_select_module" style="display:none"></div>
				<div id="color_select_front" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_module" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					Дополнительный элемент: <input type="checkbox" id="addition_select_module" name="addition">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<? $colorsCriteria = new CDbCriteria; $colorsCriteria->condition = 'is_module=1'; $module_colors= Color::model() -> findALL($colorsCriteria);?>
					<div id="container_color" >
						<form id="fronts-color" action="" method="POST" onclick="edit_module()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</form>
						<p class="h1">Цвета модуля</p>
						<div class="select_colors">
							<h3>ЛДСП</h3>
							<?php foreach($module_colors as $color):?>
								<div id='id_color_<?= $color["id"];?>' class='color_item_mod' style='float: left; position: relative;'>
									<div class='qp_item-color-item-title'><?= $color["title"];?>
										<div class='tr'></div>
									</div>
									<img src='/images/colors/<?= $color['id'];?>.png'  width='75' height='75'>
									<a href='/images/colors/<?= $color->image;?>.png' class="fancybox" title="<?= $color["title"];?>" style="text-decoration: none;">
										<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
									</a>
								</div>
							<? endforeach; ?>
						</div>
						<br><hr>
						<p class="h1">Цвета фасада</p>
						<div  class="select_colors">
							<h3>Без фасада</h3>
							<div id='id_color_-1' class='color_item'>
								<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
								<img src='/images/without.jpg' style="border: 1px solid black" width='75' height='75'>
							</div>
						</div>
						<? foreach($arraySort as $item):?>
							<div class="select_colors">
								<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
									foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
								<h3><?= $name_categ==1?$item[0]:""?></h3>
								<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
									<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
										<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>
										<img src='/images/colors/<?= $itemColor->image;?>.png'>
										<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
											<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
										</a>
									</div>
								<?endforeach;endif;endforeach;?>
							</div>
						<?endforeach;?>
						<div ><form id="moduleOptions"></form></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(function () {
		var ck_newsContent = CKEDITOR.replace('ckeditor');
		CKFinder.SetupCKEditor(ck_newsContent, '/js/lib/ckfinder/');
	})
	$(function () {
		var ck_newsContent2 = CKEDITOR.replace('ckeditor2');
		CKFinder.SetupCKEditor(ck_newsContent2, '/js/lib/ckfinder/');
	})
	function NumericText(){
		var key = window.event.keyCode;
		if(key < 48 || key>57){
			window.event.returnValue = false;
		}
	}

</script>

<!----------------Скрипты для работы с модулями, входящих в расчет кухни-------------------->
<script type="text/javascript">

	$(".module_b").click(function(){
		$(".color_item_mod  img").css("border","");
		$(".color_item  img").css("border","");
		var id_module = $(this).parent().attr("id").substr(4);
		var id_kitchenModule = $(this).parent().attr("kitchenmodule");
		$("#id_select_module").html(id_module);
		$("#id_kitchenModule").html(id_kitchenModule);

		var id_kitchen = $('input[name$="id"]').val();

		$(".color_item img").css("border","");
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Selmodulebutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_module:id_module,id_kitchenModule:id_kitchenModule},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_module").html(p.selColorModule);
				$(".color_item_mod[id$=id_color_" + p.selColorModule + "]  img").css("border","5px solid rgb(255, 201, 13)");
				$("#color_select_front").html(p.selColorFront);
				$(".color_item[id$=id_color_" + p.selColorFront + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_module").val(1);
				}
				else{
					$("#count_select_module").val(p.count);
				}
				if(p.addition == 1){
					$("#addition_select_module").prop('checked',true);
				}
				else{
					$("#addition_select_module").prop('checked',false);
				}

				$("#moduleOptions").html("");
				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					$("#moduleOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
					$.each(group, function (key, object) {
						if (object["is_enabled"]) {
							if(object["sel_option"] == 'y'){
								$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
							else{
								$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
						}
					});
				})

			}
		})

	})

	$("#addModule").click(function(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Selmodule',
			dataType: "json",
			data: $("#kitchen-form").serialize(),
			success: function(data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				if(p.title != ""){
					p2= "<div id='mod_" + p.id_module + "'><br><input type='text' name='cost' disabled>" +
						"<input type='button' value='...' data-toggle='modal' data-target='#kitchen-modal'>"
						+ p.title + "<a class='del_module'>[х]</a></div>";
					var selmodule = $("#selModule").html();
					$("#selModule").html(selmodule + p2);
				}
				location.reload();
			}
		});
	});

	$(".del_module").click(function(){
		var id_module = $(this).parent().attr("id").substr(4);
		var id_kitchen = $('input[name$="id"]').val();
		var id_kitchenModule = $(this).parent().attr("kitchenmodule");
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Delmodule',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_module:id_module,id_kitchenModule:id_kitchenModule},
			success: function (data) {
				alert(data.data);
				$("#mod_"+id_module).remove();
			}
		})
	})

	function edit_module(){
		var id_module = $("#id_select_module").html();
		var id_kitchen = $('input[name$="id"]').val();
		var color_select_module = $("#color_select_module").html();
		var color_select_front = $("#color_select_front").html();
		var count_select_module = $("#count_select_module").val();
		var id_kitchenModule   = $("#id_kitchenModule").html();
		addition_select_module = 0;
		if ($("#addition_select_module").prop("checked")){
			addition_select_module = 1;
		}
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Editmodule',
			dataType: "json",
			data: $("#moduleOptions").serialize() + "&id_kitchen="+id_kitchen+"&id_module="+id_module+"&color_select_module="+
			color_select_module+"&color_select_front="+color_select_front+"&count_select_module="+count_select_module+
			"&addition_select_module="+addition_select_module+"&id_kitchenModule="+id_kitchenModule,
			success: function (data) {
				if (data.data >= 0){
					alert("Сохранено!");
				}
				else{
					alert("Не верно заданы параметры!");
				}

			}
		})
	}

	$(".color_item_mod").click(function () {
		id = $(this).attr("id").substr(9);
		$("#color_select_module").html(id);
	})
	$(".color_item").click(function () {
		id = $(this).attr("id").substr(9);
		$("#color_select_front").html(id);
	})

	$('body').on('click','.data-option-btn',function () {
		var thisButton = $(this);
		if (thisButton.hasClass("btn-default")) {
			thisButton.parent().find("input[type=checkbox]").prop("checked", false);
			thisButton.parent().find(".btn-success").removeClass("btn-success").addClass("btn-default")
			thisButton.removeClass("btn-default").addClass("btn-success").find("input[type=checkbox]").prop("checked", true);
		} else {
			thisButton.removeClass("btn-success").addClass("btn-default").find("input[type=checkbox]").prop("checked", false);
		}
	})

</script>


<div class="modal" id="kitchen-front" tabindex="-1" role="dialog" aria-labelledby="Опции фасада" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции фасада</p>
			</div>
			<div class="modal-body">
				<div id="id_kitchenFront" style="display:none"></div>
				<div id="id_select_front2" style="display:none"></div>
				<div id="color_select_front2" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_front2" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					Дополнительный элемент: <input type="checkbox" id="addition_select_front" name="addition_f">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<div id="container_color" >
						<form id="fronts-color" action="" method="POST" onclick="edit_front()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</form>
						<p class="h1">Цвета фасада</p>
						<div  class="select_colors">
							<h3>Без фасада</h3>
							<div id='id_color_-1' class='color_item'>
								<div class='qp_item-color-item-title'>Без фасада<div class='tr'></div></div>
								<img src='/images/without.jpg' style="border: 1px solid black" width='75' height='75'>
							</div>
						</div>
						<? foreach($arraySort as $item):?>
							<div class="select_colors">
								<?$name_categ=0;foreach($item[1] as $itemCateg){if(isset($arrCategColor[$itemCateg])){
									foreach($arrCategColor[$itemCateg] as $itemColor){if(!empty($itemColor)){$name_categ=1;}}}}?>
								<h3><?= $name_categ==1?$item[0]:""?></h3>
								<?foreach($item[1] as $itemCateg):if(isset($arrCategColor[$itemCateg])):foreach($arrCategColor[$itemCateg] as $itemColor):?>
									<div id='id_color_<?= $itemColor->id;?>' class='color_item' style="position: relative">
										<div class='qp_item-color-item-title'><div class='tr'></div><?= $itemColor->title;?></div>
										<img src='/images/colors/<?= $itemColor->image;?>.png'>
										<a href='/images/colors/<?= $itemColor->image;?>.png' class="fancybox" title="<?= $itemColor->title;?>" style="text-decoration: none;">
											<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i>
										</a>
									</div>
								<?endforeach;endif;endforeach;?>
							</div>
						<?endforeach;?>
						<div ><form id="frontOptions"></form></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<!----------------Скрипты для работы с фасадамиы, входящих в расчет кухни-------------------->
<script type="text/javascript">
	$("#addFront").click(function(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Selfront',
			dataType: "json",
			data: $("#kitchen-form").serialize(),
			success: function(data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				location.reload();
			}
		});
	});
	$(".del_front").click(function(){
		var id_front = $(this).parent().attr("id").substr(6);
		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Delfront',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_front:id_front},
			success: function (data) {
				alert(data.data);
				$("#front_"+id_front).remove();
			}
		})
	})

	$(".front_b").click(function(){
		$(".color_item  img").css("border","");
		$("#frontOptions").html("");
		var id_front = $(this).parent().attr("id").substr(6);
		var id_kitchenFront = $(this).parent().attr("kitchenFront");
		$("#id_kitchenFront").html(id_kitchenFront);
		$("#id_select_front2").html(id_front);


		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Selfrontbutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_front:id_front,id_kitchenFront:id_kitchenFront},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_front2").html(p.selColor);
				$(".color_item[id$=id_color_" + p.selColor + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_front2").val(1);
				}
				else{
					$("#count_select_front2").val(p.count);
				}

				if(p.addition == 1){
					$("#addition_select_front").prop('checked',true);
				}
				else{
					$("#addition_select_front").prop('checked',false);
				}

				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					$("#frontOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
					$.each(group, function (key, object) {
						if (object["is_enabled"]) {
							if(object["sel_option"] == 'y'){
								$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
							else{
								$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
							}
						}
					});
				})
			}
		})
	})
	function edit_front(){
		var id_front = $("#id_select_front2").html();
		var id_kitchen = $('input[name$="id"]').val();
		var id_kitchenFront = $("#id_kitchenFront").html();
		var color_select_front = $("#color_select_front2").html();
		var count_select_front = $("#count_select_front2").val();
		addition_select_front = 0;
		if ($("#addition_select_front").prop("checked")){
			addition_select_front = 1;
		}
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Editfront',
			dataType: "json",
			data: $("#frontOptions").serialize() + "&id_kitchen="+id_kitchen+"&id_front="+id_front+
			"&color_select_front="+color_select_front+"&count_select_front="+count_select_front+
			"&addition_select_front="+addition_select_front+"&id_kitchenFront="+ id_kitchenFront,
			success: function (data) {
				if (data.data >= 0){
					alert("Сохранено!");
				}
				else{
					alert("Не верно заданы параметры!");
				}
			}
		})
	}
	$(".color_item").click(function () {
		id = $(this).attr("id").substr(9);
		$("#color_select_front2").html(id);
	})
</script>


<div class="modal" id="kitchen-cover" tabindex="-1" role="dialog" aria-labelledby="Опции столешницы" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции фасада</p>
			</div>
			<div class="modal-body">
				<div id="id_select_cover" style="display:none"></div>
				<div id="color_select_cover" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_cover" value="1" placeholder="Количество" OnKeyPress="NumericText()">
					Дополнительный элемент: <input type="checkbox" id="addition_select_cover" name="addition_c">
					<? $categoryColor = new ItemFront; $arraySort = $categoryColor -> sortCategoryColors(); $arrCategColor = $categoryColor -> getColorsCategory();?>
					<div id="container_color" >
						<form id="fronts-color" action="" method="POST" onclick="edit_cover()" style="position:absolute; right: 3%; z-index:999;">
							<input type="submit" value="Выбрать">
						</form>
						<p class="h1">Цвета</p>
						<div  class="select_colors"><div id="coverColors"></div></div>

						<div ><form id="coverOptions"></form></div>
						<div class="qp_item-size">
							<span>Ширина</span>
							<input name="width" id="extra-size-width" type="text" value="" OnKeyPress="NumericText()"/>
							<span>Длина</span>
							<input name="length" id="extra-size-height" type="text" value="" OnKeyPress="NumericText()"/>
							<span>мм</span>
							<input name="koffCost" id="koffCost" type="text" value="1" OnKeyPress="NumericText()" style="display:none;"/>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>


<!----------------Скрипты для работы с столешницами, входящих в расчет кухни-------------------->
<script type="text/javascript">
	$("#addCover").click(function(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Selcover',
			dataType: "json",
			data: $("#kitchen-form").serialize(),
			success: function(data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				location.reload();
			}
		});
	});
	$(".del_cover").click(function(){
		var id_cover = $(this).parent().attr("id").substr(6);
		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Delcover',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_cover:id_cover},
			success: function (data) {
				alert(data.data);
				$("#cover_"+id_cover).remove();
			}
		})
	})
	$(".cover_b").click(function(){
		$(".color_item  img").css("border","");
		$("#coverOptions").html("");
		$("#coverColors").html("");
		$(".qp_item-size").css("display","none");
		var id_cover = $(this).parent().attr("id").substr(6);
		$("#id_select_cover").html(id_cover);

		var id_kitchen = $('input[name$="id"]').val();

		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Selcoverbutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_cover:id_cover},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#color_select_cover").html(p.selColor);
				var colors = (eval("(" + JSON.stringify(p.colors) + ")"));
				$.each(colors, function (id, object) {
					$("#coverColors").append('<div id="id_color_' + object["id"] + '" class="color_item">' +
						'<div class="qp_item-color-item-title"><div class="tr"></div>'+ object["title"] +'</div>'+
						'<img src="/images/colors/'+ object["id"] +'.png">'+
						'<a href="/images/colors/'+ object["id"] +'.png" class="fancybox" title="'+  object["title"] +'" style="text-decoration: none;">'+
						'<br><i class="fa fa-search-plus" style="position: absolute; top: 43px; left: 45px;"></i></a>'+
						'</div>');
				});
				$(".color_item[id$=id_color_" + p.selColor + "]  img").css("border","5px solid rgb(255, 201, 13)");
				if(p.count == 0){
					$("#count_select_cover").val(1);
				}
				else{
					$("#count_select_cover").val(p.count);
				}
				if(p.addition == 1){
					$("#addition_select_cover").prop('checked',true);
				}
				else{
					$("#addition_select_cover").prop('checked',false);
				}

				var options = (eval("(" + JSON.stringify(p.options) + ")"));
				$.each(options, function (keyGroup, group) {
					var keyGroup = keyGroup;
					if(keyGroup!="no_standard"){
						$("#coverOptions").append('<div class="data-group" id="' + keyGroup + '" style="display: inline-block; width:100%"></div>');
						$.each(group, function (key, object) {
							if (object["is_enabled"]) {
								if(object["sel_option"] == 'y'){
									$("#" + keyGroup).append('<a class="btn btn-success data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" checked="checked" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
								}
								else{
									$("#" + keyGroup).append('<a class="btn btn-default data-option-btn" style="white-space: normal; height: 170px;"><div style="width: 90px; height: 90px; margin: 0 auto;"><img src="/images/options/'+ object["id"] + '.png" width= "90px" height="90px"></div><input type="text" hidden="hidden" class="data-price" value="' + object["price"] + '"><input type="text" hidden="hidden" class="data-prepay" value="' + object["pre_pay"] + '"><input hidden="hidden" name=options[] type="checkbox" value="' + object["id"] + '"><span class="ch-o">' + object["title"] + '</span></a>')
								}
							}
						});
					}
				})
				if(p.extraSize == 1){
					$(".qp_item-size").css("display","block");
				}
				$(".qp_item-size input[name$='koffCost']").val(p.koffCost);
				$(".qp_item-size input[name$='width']").val(p.stdW);
				$(".qp_item-size input[name$='length']").val(p.stdH);
			}
		})
	})
	function edit_cover(){
		var id_cover= $("#id_select_cover").html();
		var id_kitchen = $('input[name$="id"]').val();
		var color_select_cover = $("#color_select_cover").html();
		var count_select_cover = $("#count_select_cover").val();
		var koffCost  		   = $("#koffCost").val();
		var extra_size_width   = $("#extra-size-width").val();
		var extra_size_height  = $("#extra-size-height").val();
		addition_select_cover = 0;
		if ($("#addition_select_cover").prop("checked")){
			addition_select_cover = 1;
		}
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Editcover',
			dataType: "json",
			data: $("#coverOptions").serialize() + "&id_kitchen="+id_kitchen+"&id_cover="+id_cover+
			"&color_select_cover="+color_select_cover+"&count_select_cover="+count_select_cover+
			"&koffCost="+koffCost+"&extra_size_width="+extra_size_width+"&extra_size_height="+extra_size_height+
			"&addition_select_cover="+addition_select_cover,
			success: function (data) {
				if (data.data >= 0){
					alert("Сохранено!");
				}
				else{
					alert("Не верно заданы параметры!");
				}
			}
		})
	}
	$('body').on('click','.color_item', function () {
		$('.color_item img').css("border","none");
		id = $(this).attr("id").substr(9);
		$(this).find('img').css("border","5px solid rgb(255, 201, 13)");
		$("#color_select_cover").html(id);
	})
	$('body').on('change','#extra-size-width', function () {
		updateKoffCost();
	})
	$('body').on('change','#extra-size-height', function () {
		updateKoffCost();
	})
	function updateKoffCost(){
		var id_cover = $("#id_select_cover").html();
		var sizeW = $("#extra-size-width").val();
		var sizeH = $("#extra-size-height").val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Coverextrasize',
			dataType: "json",
			data: {id_cover:id_cover,sizeW:sizeW,sizeH:sizeH},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				$("#koffCost").val(p.koff);
			}
		})
	}
</script>


<div class="modal" id="kitchen-access" tabindex="-1" role="dialog" aria-labelledby="Опции столешницы" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel">Опции фасада</p>
			</div>
			<div class="modal-body">
				<div id="id_select_access" style="display:none"></div>
				<div class="row">
					Количество: <input type="text" name="count" id="count_select_access" value="0" placeholder="Количество" OnKeyPress="NumericText()">
					Дополнительный элемент: <input type="checkbox" id="addition_select_access" name="addition_c">
					<form action="" method="POST" onclick="edit_access()">
						<input type="submit" value="Выбрать">
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<!----------------Скрипты для работы с аксессуарами, входящих в расчет кухни-------------------->
<script type="text/javascript">
	$("#addAccess").click(function(){
		$.ajax({
			type:"POST",
			url: '/admin/kitchens/Selaccess',
			dataType: "json",
			data: $("#kitchen-form").serialize(),
			success: function(data) {
				p = jQuery.parseJSON(data.data);
				alert(p.mess);
				location.reload();
			}
		});
	});
	$(".del_access").click(function(){
		var id_access = $(this).parent().attr("id").substr(7);
		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Delaccess',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_access:id_access},
			success: function (data) {
				alert(data.data);
				$("#access_"+id_access).remove();
			}
		})
	})
	$(".access_b").click(function(){
		var id_access = $(this).parent().attr("id").substr(7);
		var id_kitchen = $('input[name$="id"]').val();
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Selaccessbutton',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_access:id_access},
			success: function (data) {
				p = jQuery.parseJSON(data.data);
				$("#id_select_access").html(id_access);
				if(p.count == 0){
					$("#count_select_access").val(1);
				}
				else{
					$("#count_select_access").val(p.count);
				}
				if(p.addition == 1){
					$("#addition_select_access").prop('checked',true);
				}
				else{
					$("#addition_select_access").prop('checked',false);
				}
			}
		})
	})
	function edit_access() {
		var id_access = $("#id_select_access").html();
		var id_kitchen = $('input[name$="id"]').val();
		count_select_access = $("#count_select_access").val();
		addition_select_access = 0;
		if ($("#addition_select_access").prop("checked")){
			addition_select_access = 1;
		}
		$.ajax({
			type: "POST",
			url: '/admin/kitchens/Editaccess',
			dataType: "json",
			data: {id_kitchen:id_kitchen,id_access:id_access,count_select_access:count_select_access,addition_select_access:addition_select_access},
			success: function (data) {
				alert("Сохранено!");
			}
		})
	}

</script>