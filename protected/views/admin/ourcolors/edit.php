<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/our-colors" class="link">Наши цвета</a></li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Заголовок <?= $OurColors->name_categ; ?></h1>

	<form action="/admin/our-colors/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" id="id_categ" name="id" value="<?= $OurColors->id ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $OurColors->name_categ; ?>">
						</div>
						
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $OurColors->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $OurColors->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $OurColors->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="form-group">
							<input type="number" id="id_color" class="form-control" value="0" style="width: 70%; float: left;">
							<a id="add_color" style="cursor:pointer; padding-left: 10px;">ДОБАВИТЬ ЦВЕТ</a>
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<label>Цвета</label>
							<? $arr = unserialize($OurColors -> colors); $i = 0;?>
							<div class="select_colors">
							<? foreach($arr as $item):?>
								<div class='color_item'>
								<img src='/images/ourcolors/<?= $item['pathImg'];?>'>
								<div style="width:125px;">
								<input type="text" name="nameColor_<?= $i;?>" class="form-control" placeholder="Название"
							       value="<?= $item['name']; ?>">	
								<input type="file" name="imageColor_<?= $i;?>" class="filestyle" data-buttonName="btn-primary" data-buttonText="image"
							       data-buttonBefore="true">   
								</div>
								   Пометить на удаление <input type="checkbox" name="delColor_<?= $i;?>">
								</div>								
							<?$i++; endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
				<label>Контент вверх</label><br>
				<textarea id="ckeditor" name="content"><?= $OurColors->content ?></textarea>
			</div>
				<br/>
				<br/>
			<div class="form-group">
				<label>Контент низ</label><br>
				<textarea id="ckeditor2" name="content2"><?= $OurColors->content2 ?></textarea>
			</div>
				<br/>
				<br/>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/our-colors" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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
	$('#add_color').click(function(){
		var idColor = $('#id_color').val();
		var idCateg = $('#id_categ').val();
 		$.ajax({
			type: "POST",
			dataType: "html",
			url: '../addcolor',
			data: 'idColor='+idColor+'&idCateg='+idCateg,
			success: function(html){
				$(".select_colors").html(html);
			},
 			error: function(){
				alert('Не верно введен id!');
			}
		});
	})

</script>