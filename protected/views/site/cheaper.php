

<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Как заказать кухню дешевле?</li>
	</ol>
</div>

<div class="container for-h1">
	<?= $page->content?>
	<h1>Как заказать кухню дешевле?</h1>
	<?$i=0; foreach($cheaper as $cheaper_item):?>
			<div style="display:inline-block; padding-top: 15px; width:100%; position: relative; font-family: arial,helvetica,sans-serif;">
				<a href="/cheaperItem/<?= $cheaper_item['id']?>"><span style="font-size: 24px; font-weight:bold; color: black;"><?= $cheaper_item['title']?></span></a><br>
				<?	$imgs = unserialize($cheaper_item['img']);
				    $img = array_shift($imgs);
				    if (!empty($img)){
    					$ih = new CImageHandler();
    					$file = 'images/cheaper/'.$img;
    					if(file_exists($file)){					
    					?>
    						<div class="qp_item-image" style="float: left; width: 210px;">
    							<a href="images/cheaper/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
    							<img class="image-link" src="images/cheaper/<?= $img?>" alt="<?= $cheaper_item['img_alt']?>"
    								 data-mfp-src="images/cheaper/<?= $img?>" style="width: 200px;"/></a>
    						</div>
    
    					<?
    					}
				    }
				?>
				<div style="float: left; width: 70%; padding: 10px 0 0 20px;">
				<?
					preg_match('~^(?>(?><[^>]*>\s*)*[^<]){0,350}(?=\s)~s', $cheaper_item['description'], $m); 
					echo $m[0]." ...";
				?>
				<a href="/cheaperItem/<?= $cheaper_item['id']?>" style="font-size: 18px; font-weight: bold;">Читать полностью</a>
				</div> 

			</div>
		<hr>
	<?endforeach?>
	<?= $page->content2?>
</div>