<script type="text/javascript">
	var redirect = '/kak-kupit-kuhnyu-nedorogo';
	history.pushState('', '', redirect);
</script>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active"><?= $cheaper_item['title']?></li>
	</ol>
</div>

<div class="container for-h1">
	<h1><?= $cheaper_item['title']?></h1>
		<div style="display:inline-block; padding-top: 15px; width:100%; position: relative;">
			<?= $cheaper_item['description'];?>
			<?	$imgs = unserialize($cheaper_item['img']);
			$i=0;
			foreach($imgs as $img){
				$ih = new CImageHandler();
				$file = 'images/cheaper/'.$img;
				if(file_exists($file)){					
				?>
					<div class="qp_item-image" style="float: left; width: 210px;">
						<a href="../images/cheaper/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
						<img class="image-link" src="../images/cheaper/<?= $img?>" alt="<?= $cheaper_item['img_alt']?>"
							 data-mfp-src="../images/cheaper/<?= $img?>" style="width: 200px;"/></a>
					</div>

				<?
				}
				
			}
			?>
		</div>
</div>