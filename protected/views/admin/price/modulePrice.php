<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
		<li><a href="/admin/price" class="link">Загрузка цен</a></li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Загрузка цен модулей</h1>

	<form action="/admin/price/SaveModulePrice" method="post" enctype="multipart/form-data">
		
		<div class="row">


			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group">
							<span class="text-danger">*</span>
							<label>Имя файла должно соответствовать: ModulePrice.xlsx</label><a id="loadSh"> (Выгрузить шаблон)</a>
							<input type="file" name="Excel" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Excel" data-buttonBefore="true">
						</div>
						<p style="color:red;"><?if(isset($msg)) echo $msg;?></p>
					</div>
				</div>	
			</div>
		</div>
		<div class="panel-footer">
			<a href="/admin/price" class="btn btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
					class="fa fa-check"></i> Записать
			</button>
		</div>
	</form>

</div>
<script>
	$("#loadSh").click(function(){
		window.open("../excel/temp/ModulePrice.xlsx", '_self');
	})
</script>