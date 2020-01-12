<? $review = $this->processOutput( $review ); 
	if ($review->new_ch == 0){
		$review->new_ch = 1;
		$review->save();
	}
	$images = unserialize($review->img);
 ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/reviews" class="link">Редактирование отзывов</a></li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Редактирование отзыва: <?= $review->fio ?></h1>

	<form action="/admin/review/save" method="post" enctype="multipart/form-data">
		<input hidden="hidden" name="id" value="<?= $review->id ?>">

		<div class="row">


			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Имя</label>
							<input type="text" name="fio" class="form-control" placeholder="Название"
							       value="<?= $review->fio ?>">
						</div>
						
						<div class="form-group">

							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<i class="fa fa-eye"></i> <?= $review->is_show ? 'Отображать' : 'Не отображать' ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<input type="radio" id="ex2_2_1" name="is_show"
										       value="0" <?= ! $review->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_1"><i class="fa fa-close"></i> Не отображать</label>
									</li>
									<li>
										<input type="radio" id="ex2_2_2" name="is_show" value="1" <?= $review->is_show ? 'checked' : '' ?>>
										<label for="ex2_2_2"><i class="fa fa-check"></i> Отображать</label>
									</li>
								</ul>
							</div>
							<br>
							<div class="form-group">
								<label>Номер договора</label><br>
								<input type="text" name="agreement" value="<?= $review->Agreement ?>">
							</div>
						</div>
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Картинка (добавить)</label>
							<input type="file" name="image[]" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Image" multiple="multiple" accept="image/png,image/jpeg" data-buttonBefore="true">
						</div>
						<div class="form-group">
							<label>Текст картинки</label>
							<input type="text" name="img_alt" class="form-control" placeholder="Текст картинки"
							       value="<?= $review->img_alt ?>">
						</div>
						<p>Поля отмеченные знаком <span class="text-danger">*</span> обязательны для заполнения</p>

					</div>
				</div>
				<div >
					<?foreach($images as $image):?>
						<?php if ( $image ): ?>
							<br><img src="/images/review/<?= $image ?>" width="50%">
							&nbsp&nbsp&nbsp
							<input type="checkbox" name="<?= str_replace(".","",$image) ?>" value="1">&nbspПометить на удаление
							<br>
						<?php endif; ?>
					<?endforeach;?>
				</div>

			</div>
			<div class="col-md-6">
			<div class="form-group">
				<textarea id="ckeditor" name="review"><?= $review->text ?></textarea>
			</div>
				<br/>
				<br/>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/reviews" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
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