<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Новости</li>
	</ol>
</div>

<div class="container for-h1">
	<?= $page->content?>
	<h1>Новости</h1>
	<?$i=0; foreach($news as $new_item):?>
			<div style="display:inline-block; padding-top: 15px; width:100%; position: relative; font-family: arial,helvetica,sans-serif;">
				<!--<a href="/newsItem/<?= $new_item['id']?>">--><span style="font-size: 20px; font-weight:bold; color: black;"><?= $new_item['title']?></span><br>
				<?	$imgs = unserialize($new_item['img']);
				    $img = array_shift($imgs);
					$ih = new CImageHandler();
					$file = 'images/news/'.$img;
					if(file_exists($file)){					
					?>
						<div class="qp_item-image" style="float: left; width: 210px;">
							<a href="images/news/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
							<img class="image-link" src="images/news/<?= $img?>" alt="<?= $new_item['img_alt']?>"
								 data-mfp-src="images/news/<?= $img?>" style="width: 200px;"/></a>
						</div>

					<?
					}
				?>
				<div style="float: left; width: 70%; padding: 10px 0 0 20px;">
				
				<?
					preg_match('~^(?>(?><[^>]*>\s*)*[^<]){0,350}(?=\s)~s', $new_item['description'], $m); 
					echo $m[0]." ...";
				?>
				
				<a href="/newsItem/<?= $new_item['id']?>" style="font-size: 18px; font-weight: bold;">Читать полностью</a>
				</div> 
			</div>
		<hr>
	<?endforeach?>
	<?= $page->content2?>
</div>
<script>
	$(function () {
		$("#nav-info").addClass('active');
	})
</script>