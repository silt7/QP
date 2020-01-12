<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active"><a href="../news" class="link">Новости</a></li>
		<li class="active"><?= $new_item['title']?></li>
	</ol>
</div>

<div class="container for-h1">
	<h1><?= $new_item['title']?></h1>
		<div style="display:inline-block; padding-top: 15px; width:100%; position: relative;">
			<?= $new_item['description'];?>
			<?	$imgs = unserialize($new_item['img']);
			$i=0;
			foreach($imgs as $img){
				$ih = new CImageHandler();
				$file = 'images/news/'.$img;
				if(file_exists($file)){					
				?>
					<div class="qp_item-image" style="float: left; width: 210px;">
						<a href="../images/news/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
						<img class="image-link" src="../images/news/<?= $img?>" alt="<?= $new_item['img_alt']?>"
							 data-mfp-src="../images/news/<?= $img?>" style="width: 200px;"/></a>
					</div>

				<?
				}
				
			}
			?>
		</div>
</div>