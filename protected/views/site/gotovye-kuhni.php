<div id="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-6 title">Готовые кухни</div>
			<div class="col-md-6 bc">
				<ol>
					<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
					<li class="active"><?= $kitchenContent->menu != '' ? $kitchenContent->menu : $kitchenContent->title;?></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div id="header-form">
		<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice">
			<div class="container">
				<div class="row">
					<p class="h2" style="color:#fff; margin-top: 25px;">Есть проект или фотография кухни? Присылайте для расчёта стоимости.</p>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')" required></div>
					<div class="col-lg-4"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
					<div class="col-lg-4"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон"></div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<p  style="color:#fff;margin-bottom: 5px;">&nbsp </p>
						<textarea name="text" placeholder="Комментарий" style="width: 100%; height: 58px;padding: 18px;"></textarea>					
					</div>
					<div class="col-lg-4 row-image">
						<p style="color:#fff;margin-bottom: 5px;">Добавьте изображения, если есть:</p>
						<div number="1" class="file-upload">
								<label>
									<input type="file" name="img[]" onchange="processFiles(this)" accept="image/x-png,image/gif,image/jpeg" multiple>
									<span>Загрузить изображения (макс. 10 МБ)</span>
								</label>
							</div>
							<div number="2" class="file-upload" style="display:none;">
								<label>
									<input type="file" name="img2[]" onchange="processFiles(this)" accept="image/x-png,image/gif,image/jpeg" multiple>
									<span>Загрузить изображения (макс. 10 МБ)</span>
								</label>
							</div>
							<div number="3" class="file-upload" style="display:none;">
								<label>
									<input type="file" name="img3[]" onchange="processFiles(this)" accept="image/x-png,image/gif,image/jpeg" multiple>
									<span>Загрузить изображения (макс. 10 МБ)</span>
								</label>
							</div>

						<div id="file-name"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<button onclick="yaCounter31370493.reachGoal('free-payment');" style="margin:25px auto;">Получить расчет стоимости<img src="/images/main/btn_cost.svg" style="margin-left:15px;"/></button>	
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="container">
		<h1 style="margin: 35px auto; text-align:center;"><?= $kitchenContent->title?></h1>
		<div class="row">
			<div style="margin-left:15px;font-family: ProximaNovaRegular;"><?= $kitchenContent->content;?></div>
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
	<div class="container">
		<div class="row expKitchen">
			<div class="h2">Готовые кухни: каталог, фото и цены</div>
			<?php if ( $kitchens ) : foreach ( $kitchens as $kitchen ): ?>
				<div class="col-xs-12 col-sm-6 col-md-4 kitchen-block">
					<a class="kitchens__link" href="/kitchen/<?= $kitchen->urlT!=""?$kitchen->urlT:$kitchen->id ?>">
						<div class="edit-panel">
							<!--<h4 class="kitchen__title"><?= $kitchen->title ?></h4>-->
							<div class="filtr">
							    <img src="/images/kitchens/prev/<?= $kitchen->image ?>" width="100" alt="<?= $kitchen->title ?> от <?= $kitchen->price ?> рублей"/>
							    <div class="arrow-link"><img src="/images/main/more_arrow.svg"></div>
							</div>
							<noindex>
								<div  class="kitchens__price"  rel="nofollow">
								    <span class="kitchens__price_text">Стоимость:</span>
									<?if ($this->ActionPrice_gl!= 1):?>
											<span class="kitchens__price_old" style="color: #F32727 !important;"><span style="color: #323232;"><?= Utils::priceFormat( round($kitchen->price  / $this->ActionPrice_gl,-1) ) ?> руб.</span></span>
									<?endif;?>
									<span class="kitchens__price_actual">  <?= Utils::priceFormat( $kitchen->price  ) ?><!--<i class="fa fa-rub" aria-hidden="true"></i> -->руб.</span>
								</div>
							</noindex>
						</div>
					</a>
				</div>
			<?php endforeach;
			endif;
			?>
		</div>
		<div id="typeKitchen" class="container" style="padding-left: 0; padding-right: 30px;">
			<div class="row" style="margin-top:35px">
				<div class="col-lg-3 typeKitchen_block"><a class="img_classic" href="/gotovye-kuhni/klassicheskie-kuhni"><span>Классические кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_modern" href="/gotovye-kuhni/sovremennye-kuhni"><span>Современны кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_corner" href="/gotovye-kuhni/uglovye-kuhni"><span>Угловые кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_line" href="/gotovye-kuhni/pryamye-kuhni"><span>Прямые кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
			</div>
			<div class="row" style="margin-top:30px">
				<div class="col-lg-3 typeKitchen_block"><a class="img_premium" href="/gotovye-kuhni/premium-kuhni"><span>Премиум кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_free" href="/gotovye-kuhni/nedorogie-kuhni"><span>Недорогие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_small" href="/gotovye-kuhni/malenkie-kuhni"><span>Маленькие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-lg-3 typeKitchen_block"><a class="img_big" href="/gotovye-kuhni/bolshie-kuhni"><span>Большие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
			</div>
			<a href="/gotovye-kuhni" style="color: #323232;text-decoration: none;"><button style="margin-top: 35px;"><span style="display:table-cell;vertical-align:middle;width: 190px;">Все виды кухонь</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
		<div class="row" style="text-align:center;">
			<p style="display: inline-block; font-size: 21px; margin-right: 5%;">Так же Вы можете ознакомиться с готовыми кухнями в разделе</p><a href="/nashi-raboty" style="color: #323232;text-decoration: none;"><button style="margin-top: 10px; width:auto; display: inline-block;"><span style="display:table-cell;vertical-align:middle;width: 190px;">Наши работы</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
	</div>
	<!--
	<div class="container" style="margin-top:35px;">
		<p><span style="font-size:20px"><strong>Почему купить готовую кухню лучше у нас?</strong></span></p>

		<div class="row" style="font-size:16px">
			<div class="col-md-3">
				<div class="block-infor-kuhni"><img alt="" src="/ckfinder/userfiles/images/kitchen(1).png" style="height:24px; width:24px" /><span >Все виды кухонь<br />любого дизайна и размера</span></div>
			</div>
			<div class="col-md-3">
				<div class="block-infor-kuhni"><img alt="" src="/ckfinder/userfiles/images/professor-consultation.png" style="height:24px; width:24px" /><span >Бесплатная консультация дизайнера и выезд замерщика</span></div>
			</div>
			<div class="col-md-3">
				<div class="block-infor-kuhni"><img alt="" src="/ckfinder/userfiles/images/diamond.png" style="height:24px; width:24px" /><span >Подборка кухни<br />под Ваш бюджет</span></div>
			</div>
			<div class="col-md-3">
				<div class="block-infor-kuhni"><img alt="" src="/ckfinder/userfiles/images/like.png" style="height:24px; width:24px" /><span >Профессиональные сборщики<br />и гарантия 24 месяца</span></div>
			</div>
		</div>
	</div>
	-->
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
	<div class="container" >
		<div style="margin:55px 0 0 15px; display:inline-block;font-family: ProximaNovaRegular;"><?= $kitchenContent->content2;?></div>
	</div>
</div>
<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>
<script type="text/javascript">
	$(function () {
		$("#nav-kitchens").addClass('active');
	});
</script>