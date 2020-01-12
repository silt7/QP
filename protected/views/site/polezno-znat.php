<div class="container">
    <ol class="breadcrumb">
        <li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
        <li class="active">Полезно знать</li>
    </ol>
</div>
<? if (Yii::app()->request->requestUri == '/polezno-znat'):?>
    <div class="container for-h1">
        <h1>Полезно знать</h1>
        <?$i=0; foreach($poleznoZnat as $new_item):?>
            <div style="display:inline-block; padding-top: 15px; width:100%; position: relative; font-family: arial,helvetica,sans-serif;">
                <a href="/polezno-znat/<?= $new_item['url']?>" style="font-weight: 500;line-height: 1.1;
	                font-size: 30px; color: #333; margin-bottom: 10px;"><?= $new_item['title']?></a>
                <?	$imgs = unserialize($new_item['img']);
                $img = array_shift($imgs);
                $ih = new CImageHandler();
                if(!isset($img)){$img = 1;}
                $file = 'images/polezno-znat/'.$img;
                if(file_exists($file)){
                    ?>
                    <div class="qp_item-image" style="float: left; width: 210px; display: inline-block; margin-right: 25px;">
                        <a href="/images/polezno-znat/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
                            <img class="image-link" src="/images/polezno-znat/<?= $img?>" alt="<?= $new_item['img_alt']?>"
                                 data-mfp-src="/images/polezno-znat/<?= $img?>" style="width: 200px;"/></a>
                    </div>
    
                    <?
                }
                ?>
				<div style="float: left; width: 70%; padding: 10px 0 0 20px;">
				
				<?
				    if(strlen($new_item['description'])>350){
    					preg_match('~^(?>(?><[^>]*>\s*)*[^<]){0,350}(?=\s)~s', $new_item['description'], $m); 
    					echo $m[0]." ...";
				    }
				    else{
				        echo $new_item['description'];
				    }
				?>
				
				<a href="/polezno-znat/<?= $new_item['url']?>" style="font-size: 18px; font-weight: bold;">Читать полностью</a>
				</div> 
            </div>
            <hr>
        <?endforeach?>
    </div>
<?else:?>
    <div class="container for-h1">
        <?$i=0; foreach($poleznoZnat as $new_item):?>
            <div style="display:inline-block; padding-top: 15px; width:100%; position: relative; font-family: arial,helvetica,sans-serif;">
                <h1><?= $new_item['title']?></h1>
                <?	$imgs = unserialize($new_item['img']);
                $img = array_shift($imgs);
                $ih = new CImageHandler();
                if(!isset($img)){$img = 1;}
                $file = 'images/polezno-znat/'.$img;
                if(file_exists($file)){
                    ?>
                    <div class="qp_item-image" style="float: left; width: 210px; display: inline-block; margin-right: 25px;">
                        <a href="/images/polezno-znat/<?= $img?>" rel="gr_<?= $i?>" class="fancybox img-review">
                            <img class="image-link" src="/images/polezno-znat/<?= $img?>" alt="<?= $new_item['img_alt']?>"
                                 data-mfp-src="/images/polezno-znat/<?= $img?>" style="width: 200px;"/></a>
                    </div>
    
                    <?
                }
                ?>
                <p style="float: left; display: inline-block;"><?= $new_item['description'];?></p>
            </div>
            <hr>
        <?endforeach?>
    </div>
<?endif?>
<script type="text/javascript">
	$(function () {
		$("#nav-info").addClass('active');
	})
</script>