<div class="container">
	<ol class="breadcrumb">
		<li><a href="/admin" class="link">Панель управления сайтом</a></li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Заголовок <?= $this->pageTitle; ?></h1>
	<form class="row" action="/admin/nashiraboty/addImage" method="post" enctype="multipart/form-data">
		<div class="form-group col-md-10">
			<label>Добавить новую кухню</label>
			<input type="file" name="image[]" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Image" multiple="multiple" accept="image/png,image/jpeg" data-buttonBefore="true">
		</div>
		<div class="form-group col-md-2">
			<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..." style="margin-top: 25px;"><i
					class="fa fa-check"></i> Добавить
			</button>
		</div>
	</form>
	<hr>
	<?foreach($nashiraboty as $item):?>
		<div class="item-row">
			<div class="row">
				<div id="<?= $item->id;?>" class="col-md-1" style="font-size: 25px;">
					<?= $item->is_show == 1?'<i class="fa fa-eye" value="1"></i>': 
					'<i class="fa fa-eye-slash" value="0"></i>';?>
					<br>
					<i class="fa fa-minus-circle" style="color:red;" value="del"></i>
				</div>
				<img src="/images/nashiraboty/<?= $item->id;?>.jpg" class="col-md-2" />
				<?$childCriteria= new CDbCriteria;$childCriteria->condition = 'parent_id='.$item->id;$childs = NashiRaboty::model()->findAll($childCriteria);?>
				<div class="col-md-9">					
					<?foreach($childs as $child):?>
						<div class="item-child" style="float: left; display: table">
							<img src="/images/nashiraboty/<?= $child->id;?>.jpg" style="width: 70px; margin-left:15px;">						
							<div id="<?= $child->id;?>" class="col-md-1" style="font-size: 21px;">
								<?= $child->is_show == 1?'<i class="fa fa-eye" value="1"></i>': 
								'<i class="fa fa-eye-slash" value="0"></i>';?>
								<i class="fa fa-minus-circle child" style="color:red;" value="del"></i>
							</div>
						</div>
					<?endforeach?>					
				</div>
			</div>
			<BR>
			<form class="row" action="/admin/nashiraboty/addImage" method="post" enctype="multipart/form-data">
				<div class="col-md-5">
					<input type="hidden" name="id" value="<?= $item->id;?>"/>
					<div class="form-group col-md-10">
						<input type="file" name="image[]" class="filestyle" data-buttonName="btn-primary" data-buttonText="&nbsp Image" multiple="multiple" accept="image/png,image/jpeg" data-buttonBefore="true">
					</div>
					<div class="form-group col-md-2">
						<button type="submit" class="btn btn-primary pull-right" data-loading-text="Сохранение ..."><i
								class="fa fa-check"></i> Добавить
						</button>
					</div>
				</DIV>
			</form>
		</div>
		<hr>
	<?endforeach?>
</div>
<style>
	.fa-eye{color:green}
	.fa-eye-slash{color:red}
</style>
<script>
	$('.fa').click(function(){
		var obj = $(this);
		var id = obj.parent().attr('id');
		var val = obj.attr('value');
		$.ajax({
			type: "POST",
			url: "/admin/nashiraboty/save",
			//dataType:"json",
			data:{id:id,val:val},
			success: function(){
				if (val != 'del') {
					if (val == 0) {obj.removeClass('fa-eye-slash');
											obj.addClass('fa-eye');obj.attr({'value':'1'});}
					else{obj.removeClass('fa-eye');
											obj.addClass('fa-eye-slash');obj.attr({'value':'0'});}
				}
				else{
					if(obj.hasClass('child')){
						obj.parents('.item-child').remove();
					}
					else{
						obj.parents('.item-row').remove();
					}
				}
			}
		})
		
	})
</script>