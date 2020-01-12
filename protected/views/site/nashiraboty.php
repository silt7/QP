<div id="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-7 title">Наши работы</div>
			<div class="col-md-5 bc">
				<ol>
					<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
					<li class="active">Наши работы</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div class="container">
		<h1 style="margin: 35px auto; text-align:center;"> <?= $page->title ?> </h1>
		<div class="row" style="margin-left:15px;font-family: ProximaNovaRegular;"><?= $page->content ?></div>
	</div>
	<div class="container">
		<div class="row expKitchen">
			<!--<h2 style="text-align:center;">Заголовок</h2>-->
			<div class="col-md-8">
				<div style="text-align:right; padding-right: 20px;">
				<?php
					$this->widget('CLinkPager', array(
						'pages' => $paginator,
						'header' => '',
						'prevPageLabel' => '<',
						'nextPageLabel' => '>',
						'htmlOptions'=> array('class'=>'pagination'),
					))
				?>
				</div>
				<?foreach($nashiraboty as $item):?>
					<div  class="col-md-4" >
						<div class="foto-modal" id="<?= $item->id;?>" style="margin: 2px;">
							<div  class="fotorama" data-height="200">
								<img src="/images/nashiraboty/<?= $item->id?>.jpg">
							</div>
							<!--<span class="kitchen-more" style="left:25px; right: 0; width: 50%;" rel="nofollow">Подробнее <i class="fa fa-info" aria-hidden="true"></i></span>-->
						</div>
					</div>
					<div id="f_<?= $item->id;?>"  class="fotorama fotorama--hidden" data-allowfullscreen="native" data-arrows="always"  data-loop="true"  data-nav="thumbs">
						<img src="/images/nashiraboty/<?= $item->id?>.jpg">
						<?$childCriteria= new CDbCriteria;$childCriteria->condition = 'parent_id='.$item->id.' and is_show = 1';$childs = NashiRaboty::model()->findAll($childCriteria);?>
						<?foreach($childs as $child):?>
							<img src="/images/nashiraboty/<?= $child->id;?>.jpg" style="width: 50px;">
						<?endforeach?>						
					</div>
				<?endforeach?>
				<div style="display: inline-block;width: 100%;text-align:right; padding-right: 20px;">
				<?php
					$this->widget('CLinkPager', array(
						'pages' => $paginator,
						'header' => '',
						'prevPageLabel' => '<',
						'nextPageLabel' => '>',
						'htmlOptions'=> array('class'=>'pagination'),
					))
				?>
				</div>
			</div>
			<div class="col-md-4">
				<div style="margin-top: 20px;" class="main-right">
					<div class="main-right-title">
						<div class="main-right-title-up"></div>
						<div class="main-right-title-down">Довольные клиенты</div>
					</div>
					<!--<p class="h3" style="margin-top:25px; text-align:center; font-size: 24px;"><a href="/review" style="color: #2a6496;">ОТЗЫВЫ</a></p>-->
					<?foreach($reviews as $review): $reviewIMG = unserialize($review->img);?>
						<noindex>
						<div class="main-right-item" rel="nofollow">
							<div class="row">
							<?if (!file_exists("/images/review/".array_shift($reviewIMG))):?>
								<a href="/review">	
									<div class="review_img" style="background-image: url('/images/review/<?= array_shift($reviewIMG);?>');"></div>
									<!--<img class="review_img" src="/images/review/<?= array_shift($reviewIMG);?>"/>-->
								</a>						
							<?else:?>
								<img class="review_img" src="/images/without.jpg"/>
							<?endif?>
							<p class="name" style="margin-top: 20px;padding-left: 15px;float: left;"><?= $review->fio?></p>
							</div>
							<div class="row">
        							<div class="descrINDEX"><p class="text"><?= $review->text?></p></div>
        							<a href="/review">Прочитать полностью</a>
        					</div>
						</div>
						</noindex>
					<?endforeach?>					
				</div>				
			</div>
		</div>
	</div>
	<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/banner.php" );  ?>
	<script>
		$('.a-calc').removeAttr('href');
		$('#free-payment').click(function(){
			$('#hide-button').trigger('click');
		})	
	</script>
	<a id="hide-button" data-toggle="modal" data-target="#calculate-price-modal" style="display:none">скрытый вызов</a>
	<div id="question" style="margin-top:55px;">
        <div class="container" style="text-align:center;">
            <div class="row div-form" style="padding: 15px;">
                <p class="h2">Остались вопросы?</p>
                <p class="text">Заполните заявку и наш менеджер ответит<br>
                на все ваши вопросы</p>
                <form role="form" action="/files/mail/mail.php" method="POST" id="call-form">
                    <input type="hidden" name="question" value="y">
    	            <div class="row">
    	                <div class="col-lg-2" ></div>
    	                <div class="col-lg-4" ><input type="text" name="name" placeholder="Ваше имя" required 
						onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input type="text" id="phoneF2" name="phone" placeholder="Ваш номер телефона" required></div>
    	                <div class="col-lg-2" ></div>
    	            </div>
    	            <div class="row">
    	                <div class="col-lg-2"></div>
    	            	<div class="col-lg-8">
    		                <textarea name="comment" placeholder="Комментарий"></textarea>
    		                <div class="policy">Нажимая «Получить обратный звонок», вы даёте согласие на обработку своих 
    		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
    		                и принимаете <b><a href="#">условия</a></b></div>
    		                <button onclick="yaCounter31370493.reachGoal('question');">Получить обратный звонок<img src="/images/main/btn_callback.svg" style="margin-left:15px"/></button>
    		            </div>      
    	            	<div class="col-lg-2"></div>
    	            </div>
                </form>
            </div>
        </div>
    </div>
	<div class="container"> 
		<div class="row" style="margin: 35px 0 35px 15px;font-family: ProximaNovaRegular;"><?= $page->content2 ?></div>
	</div>
</div>
<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>
<style>
	.foto-modal{
		cursor:pointer;
		border: 1px solid gray;
	}
	.foto-modal:hover{
		border:1px solid #FECE24;;
	}
	li.first, li.last {
		display: none;
	}
	li.next a{
	    margin-left: 20px;
	}
	li.previous a{
	    margin-right: 20px;
	}
	.pagination > li > a{
		border-radius: 20px;
		min-width: 40px;
		text-align: center;
	}
	.pagination > li > a, .pagination > li > span{
		color: black;
		margin: 2px;
	}
	li.selected > a{
		color: white;
		background: black;
	}
	.fotorama--fullscreen .fotorama__fullscreen-icon {
        width:40px;
        height:40px;
        background: url(/images/close.png) no-repeat;
        background-size: 100%;
        margin: 10px;
    }
</style>
<script type="text/javascript">
 	$(".foto-modal").click(function(){
		var id = $(this).attr('id');
		var fotorama = $('#f_'+id)
		  .fotorama({allowfullscreen: true})
		  .data('fotorama');
		fotorama.requestFullScreen();
	}); 
	$(function () {
		$("#nav-review").addClass('active');
	})
</script>
