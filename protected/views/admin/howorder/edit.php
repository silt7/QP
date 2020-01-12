<? $HowOrder = $this->processOutput( $HowOrder ); 
 ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/HowOrder" class="link">Как правильно заказать кухню?</a></li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Заголовок <?= $HowOrder->title ?></h1>

	<form action="/admin/howorder/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $HowOrder->id ?>">

		<div class="row">


			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Заголовок</label>
							<input type="text" name="title" class="form-control" placeholder="Название"
							       value="<?= $HowOrder->title ?>">
						</div>
						
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $HowOrder->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $HowOrder->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $HowOrder->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Картинка <?= $HowOrder->image?></label>
							<input type="file" name="image" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Image" accept="image/png,image/jpeg" data-buttonBefore="true">
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>
						<div class="form-group">
							<textarea id="ckeditor" name="description"><?= $HowOrder->description ?></textarea>
						</div>
					</div>

				</div>

			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/howorder" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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


</script>