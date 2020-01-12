<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/nashi-dekory" class="link">Декоры</a></li>
		<li class="active"><?= $page->title?></li>
	</ol>
</div>
<!-- fotorama.css & fotorama.js. -->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
<div class="container">
	<h1><?= $page->title?></h1>
	<?= $page->content?>
	<div class="row">
		<?foreach($categColor as $item):?>
			<div style="display:inline-block; padding-top: 15px; width:100%; position: relative; font-family: arial,helvetica,sans-serif;">
				<span style="font-size: 20px; font-weight:bold; color: black;"><?= $item['label']?></span><br>
				<?$colors = Color::model()->findAll( 'material="'.$item['name'].'"' );?>
					<?foreach($colors as $color):
						$file = 'images/colors/'.$color['image'].'.png';
						if(file_exists($file)){					
						?>
							<div class="qp_item-image" style="float: left; width: 85px;">
								<a href="/images/colors/<?= $color['image']?>.png" rel="gr" class="fancybox img-review" title="<?= $color['title']?>">
								<img class="image-link" src="/images/colors/<?= $color['image']?>.png"
									 data-mfp-src="/images/colors/<?= $color['image']?>.png" style="width: 75px; height: 75px;"/></a>
							</div>

						<?}?>
					<?endforeach;?>
            </div>
            <hr>
		<?endforeach?>
		<img style="display:none" src="/images/job_page.jpg">
	</div><br>
	<?= $page->content2?>
</div>
<script type="text/javascript">
	$(function () {
		$("#nav-decory").addClass('active');
	})
</script>