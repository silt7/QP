<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Отзывы</li>
	</ol>
</div>

<div class="container for-h1 hahi-raboti">
	<h1>Отзывы</h1>
	<?= $page->content;?>
	<div class="row">
		<div class="col-sm-12">
			<div id="feedback_vk"></div>
		</div>
	</div>
	<!--
	<div class="row">
		<div  style="width: 200px;float:right;">
			<a href="#" data-toggle="modal" data-target="#review-modal" class="write_report">Оставить отзыв</a>
		</div>
	</div>
	-->
	<?$i=0; foreach($reviews as $review):?>
		<div style="display:inline-block; width:100%;">		
			<span style='font-size: 20px; font-weight:bold;'><?= $review['fio'];?></span>
			<div style="display:inline-block; padding-top: 15px; width:100%; position: relative;">
				<span style="font-family: 'Trebuchet MS', Helvetica, sans-serif;"><?= $review['text'];?></span>
				
				<?	$imgs = unserialize($review['img']);
				foreach($imgs as $img){
					$ih = new CImageHandler();
					$file = 'images/review/'.$img;
					if(file_exists($file)){					
					?>
						<div class="qp_item-image" style="float: left; width: 210px;">
							<a href="images/review/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
							<img class="image-link" src="images/review/<?= $img?>" alt="<?= $review['img_alt']?>"
								 data-mfp-src="images/review/<?= $img?>" style="width: 200px;"/></a>
						</div>

					<?
					}
					
				}
				?>
				<div style="position: absolute; bottom: 15px; right: 0;"><?= $review['Agreement'];?></div>
			</div>
		</div>
		<hr style="color:#FFC90D;">
	<?$i++; endforeach?>
</div>

<div class="modal" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="заказать звонок" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<h4 class="modal-title" id="myModalLabel">ОСТАВИТЬ ОТЗЫВ</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div style="width:90%; margin: 0 auto;">
						<form role="form" action="add/review" method="POST" id="call-form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1"><span class="text-danger">*</span> Имя</label>
								<input type="text" class="form-control" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Отзыв:</label>
								<textarea class="form-control" name="review" placeholder="Отзыв"></textarea>
							</div>
							<label for="exampleInputPassword1">Картинки:</label>
							<p id = "p1" ><input id = "img1" type="file" name="image1" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"></p>
							<p id = "p2" style="display:none;"><input id = "img2" type="file" name="image2" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
							<p id = "p3" style="display:none;"><input id = "img3"  type="file" name="image3" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
							<p id = "p4" style="display:none;"><input id = "img4" type="file" name="image4" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
							<p id = "p5" style="display:none;"><input  id = "img5" type="file" name="image5" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
							<div style="width: 100%; height: 30px;"><span id="label_sch" style="display: none;">1</span><span id="label_img"></span><a style="float: right; cursor: pointer;" id="linkImg">Добавить ещё изображения</a></div>
							<button class="btn promo-button"  id="btn_rev">ОСТАВИТЬ ОТЗЫВ</button>							
						</form>
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
		$("#nav-info").addClass('active');
		//$('.image-link').magnificPopup({type: 'image'});

	})
	$("#btn_rev").click(function(){
		alert("Ваш отзыв успешно добавлен. Он появится после модерации.");
	})
	$("#linkImg").click(function(){
		var i = $("#label_sch").html();
		if(i <= 5){
			if($("#img" + i)[0].files.length == true){
				label = $("#label_img").html();
				if((i > 1)&&(i <= 5)){
					label = label + ", ";
				}
				name = $("#img" + i)[0].files[0].name;
				$("#label_img").html(label + name);
				$("#p" + i).hide();
				$("#p" + (parseInt(i) + 1)).show();
				$("#label_sch").html(parseInt(i)+1);
			}
			else{
				alert("Файл не выбран");
			}
		}else{
			alert("Не более 5 изображений!");
		}
	})
</script>