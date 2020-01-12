<div id="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-7 title">Кухни на заказ</div>
			<div class="col-md-5 bc">
				<ol>
					<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
					<li class="active">Кухни на заказ</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div id="content">
	<div id="header-form">
		<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice2">
			<div class="container">
				<div class="row">
					<p class="h2" style="color:#fff; margin-top: 25px;">Есть проект или фотография кухни? Присылайте для расчёта стоимости.</p>
				</div>
				<div class="row" style="margin-top: 25px">
					<div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
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
		<div class="row">
			<div class="col-lg-12" style="text-align:center">
				<h1 style="margin: 35px auto;"><?= $page->title?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align:center">
				<p class="textPage" style="margin: 20px auto;">
					Кухни на заказ – лучший выбор для тех, кто ценит оригинальные решения и стремится приобрести кухонный гарнитур, полностью соответствующий их собственным представлениям об эстетике и целесообразности. А лучшая компания в СПб, предлагающая изготовить недорогие кухни – это «QP-kuhni».
				</p>
			</div>
		</div>
		<div class="row expKitchen">
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
							<!--
							<div class="kitchens__btn">
								<noindex>
								<span class="kitchens-more" rel="nofollow">Подробнее <i class="fa fa-info" aria-hidden="true"></i></span>
							  <!-- <a href="" class="kitchen-order">Заказть</a> --
								</noindex>
							</div>-->
						</div>
					</a>
				</div>
			<?php endforeach;
			endif;
			?>
			<a href="/gotovye-kuhni" style="color: #323232;text-decoration: none"><button><span style="display:table-cell;vertical-align:middle;width: 190px;">Посмотреть еще кухни</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
	</div>
	<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/banner.php" );  ?>
	<div id="advantage-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="h2 top-120px">Почему заказывают кухни под ключ у нас?</div>
					<p class="text_block">Заказ кухни под ключ дает возможность получить уникальный, современный и функциональный комплект мебели и аксессуаров для одной из самых важных частей жилища. Мы выполняем продукцию на заказ недорого, не в ущерб качеству и внешнему виду, за счет налаженных оптовых поставок лучших материалов.</p>
				</div>
			</div>
			<div class="row advantage-div">
				<div class="col-lg-2 col-lg-offset-1 col-without-padding" >
					<img src="/images/main/delivery.svg"/>
					<p>Доставка<br>10-15 дней</p>
				</div>
				<div class="col-lg-2 col-without-padding">
					<img src="/images/main/price.svg"/>
					<p>Цена<br>производителя</p>
				</div>
				<div class="col-lg-2 col-without-padding">
					<img src="/images/main/ecology.svg"/>
					<p>Экологичные<br>материалы</p>
				</div>
				<div class="col-lg-2 col-without-padding">
					<img src="/images/main/quality.svg"/>
					<p>Гарантия<br>качества</p>
				</div>
				<div class="col-lg-2 col-without-padding">
					<img src="/images/main/percent.svg"/>
					<p>Предоплата<br>всего 35%</p>
				</div>
			</div>
		</div>
	</div>
	<div id="typeKitchen" class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="h2 top-120px">Каталог, цены и фото кухонь на заказ</div>
				<p class="text_block">Поможет клиенту понять, что же ему, в самом деле, требуется, большой каталог кухонь. Конечно, индивидуально выполняемые комплекты уникальны, но и они могут быть подвергнуты своего рода классификации.</p>
			</div>
		</div>

		<div class="row" style="margin-top:15px">
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
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="h2 top-120px">Делаем кухни по индивидуальным размерам</div>
				<p class="text_block">Воплощенная в реальность мечта изготовления кухни по индивидуальным размерам особенно полезна собственникам небольших помещений. 
				И на нескольких квадратных метрах вполне возможно организовать красивое и функциональное пространство.
				Производственное подразделение нашей компании способно качественно изготавливать маленькие кухни на заказ.</p>
			</div>
		</div>
		<div class="row expKitchen">
			<?php if ( $NashiRaboty ) : foreach ( $NashiRaboty as $kitchen ): ?>
				<div class="col-xs-12 col-sm-6 col-md-4 kitchen-block">
					<!--<a class="kitchens__link" href="/kitchen/">-->
						<div class="edit-panel foto-modal" id="<?= $kitchen->id?>">
							<!--<h4 class="kitchen__title"></h4>-->
							<!--<div class="filtr">-->
								<div  class="fotorama" data-height="300">
							    <img src="/images/nashiraboty/<?= $kitchen->id ?>.jpg" width="100" />
								</div>
							    <!--<div style="bottom:15%" class="arrow-link"><img src="/images/main/more_arrow.svg"></div>-->
							<!--</div>-->
						</div>
						<div id="f_<?= $kitchen->id?>"  class="fotorama fotorama--hidden" data-allowfullscreen="native" data-arrows="always"  data-loop="true"  data-nav="thumbs">
							<img src="/images/NashiRaboty/<?= $kitchen->id?>.jpg">
							<?$g = NashiRaboty::model()->findAll("parent_id = $kitchen->id");
							foreach($g as $item):?>
								<img src="/images/nashiraboty/<?= $item['id'];?>.jpg" style="width: 50px;"><?
							endforeach;?>
						</div>
					<!--</a>-->
				</div>
			<?php endforeach;
			endif;
			?>
			<a href="/nashi-raboty" style="color: #323232;text-decoration: none"><button><span style="display:table-cell;vertical-align:middle;width: 190px;">Посмотреть еще кухни</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
	</div>
	<!--
	<div id="calculate">
        <div class="container">
        	<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice">
    	        <p class="h2" style="margin-top:90px">Выберите конфигурацию кухни:</p>
				<div class="row">
					<div class="row row-config v2">
						<div class="col-lg-4 nopadding configuration-type"><input id="v1" name="calculate_price_popup_configuration_type" type="radio" value="Прямая"><label for="v1"><img src="/images/main/configure_1.svg"/>Прямая</label></div>
						<div class="col-lg-4 nopadding configuration-type"><input id="v2" name="calculate_price_popup_configuration_type" type="radio" value="Угловая"><label for="v2"><img src="/images/main/configure_2.svg"/>Угловая</label></div>
						<div class="col-lg-4 nopadding configuration-type"><input id="v3" name="calculate_price_popup_configuration_type" type="radio" value="П-образная"><label for="v3"><img src="/images/main/configure_3.svg"/>П-образная</label></div>
					</div>
    	        </div> 
    	        <div class="row div-form">
					<div class="col-lg-6">
					    <img src="/images/main/measure.png" style="margin-bottom:17px"/><br>
						<p class="div-form-title">Вызвать замерщика</p><span class="div-form-arrow"></span><span class="div-form-block">100% точность проекта</span>
						<p class="div-form-text">Услуга – <b>Бесплатная</b>.<br>
						Замерщик приедет к вам<br> в удобное для вас время и сделает замеры с учетом<br>
						всех нюансов и вашей планировки.</p>
					</div>
					<div class="col-lg-6">
						<div class="col-lg-12"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-12"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-12"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон" onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
						<div class="col-lg-12">
    		                <div class="policy">Нажимая «Получить рассчет стоимости», вы даёте согласие на обработку своих 
    		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
    		                и принимаете <a href="#">условия</a></div>
    		                <button onclick="yaCounter31370493.reachGoal('free-payment');">Получить расчет стоимости<img src="/images/main/btn_cost.svg" style="margin-left:15px"/></button>
    	            	</div>
					</div>
    	        </div>
        	</form>
        </div>
    </div>
    -->
	<div id="vk" class="container">
		<div class="row">
		    <div class="col-lg-1"></div>
			<div class="col-lg-4 col-sm-12 col-lg-push-7">
			    <img src="images/main/vk.svg">
				<p class="h2">Оставляйте<br>отзывы</p>
				<p class="vk-desc">Мы внимательно изучаем<br>ваши отзывы, чтобы<br>становиться лучше и<br>радовать вас.</p>
				<p class="vk-h">@qpkuhni</p>
			</div>
			<div class="col-lg-1"></div>
			<div class="col-lg-6 col-sm-12 col-lg-pull-5">
				<div id="feedback_vk"></div>
			</div>
		</div>
	</div>
	<div class="nahi-raboti">
		<div class="container">
		    <div class="row">
    		<?foreach($reviews as $review): $reviewIMG = unserialize($review->img);?>
    			<div class="col-lg-4 nahi-raboti_block">
    				<?if (!file_exists("/images/review/".array_shift($reviewIMG))):?>
						<div class="fotorama" data-loop="true" data-width="100%" style="margin-top:15px">
							<?foreach($reviewIMG as $item):?>
							 <img class="rnahi-raboti_img" src="/images/review/prev/<?= $item;?>"/>
							<?endforeach?>
					    </div>

    				<?else:?>
    					<img class="review_img" src="/images/without.jpg"/>
    				<?endif?>
    				<div class="descrINDEX" style="height: 210px;">
    					<? preg_match('~^(?>(?><[^>]*>\s*)*[^<]){0,290}(?=\s)~s', strip_tags($review->text), $m);?> 
    					<p style="text-transform:uppercase"><?= $review->fio?></p><p class="nahi-raboti_text"><?echo $m[0]." ...";?></p>
    				</div>
    				<a href="/review" style="cursor:pointer;"><div class="arrow-link"><img src="/images/main/maximize.svg"></div></a>
    			</div>
    		<?endforeach?>	
			<a href="/review" style="color: #323232;text-decoration: none; display: inline-block;"><button><span style="display:table-cell;vertical-align:middle;width: 190px;">Посмотреть еще отзывы</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
    		</div>
		</div>
	</div>
	<div class="container project_rel" style="margin-top:120px;">
		<div class="row">
			<div class="col-lg-12 h2">
				Проект - Реализация
			</div>
			<div class="col-lg-12" style="text-align:center">
				<p><span style="font-size: 22px;font-family: ProximaNovaRegular;line-height: 1.45;color: #898989;">
				    Наши работы в дизайн проектеи после его воплощения.</span></p><br>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="fotorama" data-loop="true" data-nav="thumbs"><img src="images/fotorama/prev/1-1.jpg" /> <img src="images/fotorama/prev/1-2.jpg" /> <img src="images/fotorama/prev/1-3.jpg" /><img src="images/fotorama/prev/1-4.jpg" /></div>
			</div>
			<div class="col-lg-4">
				<div class="fotorama" data-loop="true" data-nav="thumbs"><img src="images/fotorama/prev/2-1.jpg" /> <img src="images/fotorama/prev/2-2.jpg" /><img src="images/fotorama/prev/2-3.jpg" /></div>
			</div>
			<div class="col-lg-4">
				<div class="fotorama" data-loop="true" data-nav="thumbs"><img src="images/fotorama/prev/3-1.jpg" /> <img src="images/fotorama/prev/3-2.png" /><img src="images/fotorama/prev/3-3.png" /><img src="images/fotorama/prev/3-4.png" /><img src="/images/review/20170110180034400.png" /></div>
			</div>
		</div>
	</div>
	<div id="calculate">
        <div class="container">
        	<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice">
    	        <input type="hidden" name="question" value="y">
    	        <div class="row div-form" style="background-color: #f5f5f5; padding: 50px 68px; margin: 105px 0px">
    	            <p class="h2">Рассчитайте стоимость кухни бесплатно</p>
    	            <div class="row">
    	                 <div class="col-lg-7">
    	                 	<p>Выберите конфигурацию кухни:</p>
    	                    <div class="row row-config">
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v1" name="calculate_price_popup_configuration_type" type="radio" value="Прямая"><label for="v1"><img src="/images/main/configure_1.svg"/>Прямая</label></div>
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v2" name="calculate_price_popup_configuration_type" type="radio" value="Угловая"><label for="v2"><img src="/images/main/configure_2.svg"/>Угловая</label></div>
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v3" name="calculate_price_popup_configuration_type" type="radio" value="П-образная"><label for="v3"><img src="/images/main/configure_3.svg"/>П-образная</label></div>
    	                    </div>
    	                    <p>Выберите материал фасада и тип фурнитуры:</p>
    	                    <div class="row justify-content-between row-type">
    	                        <div class="col-lg-6">
    	                        	<select name="front_bottom_color">
    							    <option selected disabled>Материал фасадов</option>
    							    <option value="Пластик">Пластик</option>
    							    <option value="МДФ">МДФ</option>
    							    <option value="Шпон">Шпон</option>
    							    <option value="Акрил">Акрил</option>
    							    <option value="Другой">Другой</option>
    							   </select>
    							</div>
    	                        <div class="col-lg-6">
    	                        	<select name="calculate_price_popup_size_h">
    							    <option selected disabled>Тип фурнитуры</option>
    							    <option value="Обычная">Обычная</option>
    							    <option value="С доводчиком">С доводчиком</option>
    							    </select>
    							</div>
    	                    </div>
    	                 </div>
    	                 <div class="col-lg-5">
    	                      <div class="row row-size">
    	                          <p>Укажите размер мебели в метрах:</p>
    	                          <div class="col-lg-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-a" name="calculate_price_popup_size_a" placeholder="Размер a">
    	                          </div>
    	                          <div class="col-lg-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-b" name="calculate_price_popup_size_b" placeholder="Размер b">
    	                          </div>
    	                          <div class="col-lg-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-c" nname="calculate_price_popup_size_c" placeholder="Размер c">
    	                          </div>
    	                      </div>
    	                      <div class="row row-image">
    	                      		<p>Добавьте изображение, если есть:</p>
    	                          	<div class="file-upload">
    									<label>
    										<input type="file" name="img[]" id="uploaded-file" multiple>
    										<span>Загрузить изображение (макс. 10 МБ)</span>
    									</label>
    								</div>
    								<div id="file-name"></div>
    								<script type="text/javascript">
										$("#uploaded-file").change(function() {
                                            var names = [];
                                            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                                                names.push($(this).get(0).files[i].name + " ");
                                            }
                                            $("#file-name").html(names);
                                        });
    	                          	</script>
    	                      </div>
    	                 </div>
    	            </div>
    	            <hr>
    	            <div class="row">
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон" onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	            </div>
    	            <div class="row">
    	            	<div class="col-lg-12">
    		                <textarea name="text" placeholder="Комментарий"></textarea>
    		                <div class="policy">Нажимая «Получить рассчет стоимости», вы даёте согласие на обработку своих 
    		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
    		                и принимаете <a href="#">условия</a></div>
    		                <button onclick="yaCounter31370493.reachGoal('free-payment');">Получить расчет стоимости<img src="/images/main/btn_cost.svg" style="margin-left:15px"/></button>
    	            	</div>
    	            </div>
    	        </div>
        	</form>
        </div>
    </div>
	<div id="catalog" class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="h2"><br>Наши декоры</div>
			</div>
		</div>
		<div class="row" style="margin-top:55px;">
			<div class="col-lg-3 col-without-padding">
			<a href="nashi-dekory-id/ldsp" class="catalog-item">
				<img src="images/main/ourDecors/1.png">
				<p><span></span><br>ЛДСП</p>
			</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/ecoshpon" class="catalog-item">
					<img src="images/main/ourDecors/2.png">
					<p><span></span><br>ЭКО шпон</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/EcoshponS" class="catalog-item">
					<img src="images/main/ourDecors/3.png">
					<p><span></span><br>ЭКО шпон сборный</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/plastic" class="catalog-item">
					<img src="images/main/ourDecors/4.png">
					<p><span></span><br>Пластик</p>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/plastic3D" class="catalog-item">
					<img src="images/main/ourDecors/5.png">
					<p><span></span><br>Пластик 3Д</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/plasticArpa" class="catalog-item">
					<img src="images/main/ourDecors/6.png">
					<p><span></span><br>Пластик Арпа</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/mdfPlenca" class="catalog-item">
					<img src="images/main/ourDecors/7.png">
					<p><span></span><br>МДФ-пленка</p>
				</a>
			</div>			
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/mdfEmal" class="catalog-item">
					<img src="images/main/ourDecors/8.png">
					<p><span></span><br>МДФ-эмаль</p>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/frez" class="catalog-item">
					<img src="images/main/ourDecors/9.png">
					<p><span></span><br>Фрезеровки</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/shponNat" class="catalog-item">
					<img src="images/main/ourDecors/10.png">
					<p><span></span><br>Шпон натуральный</p>
				</a>
			</div>
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/acryl" class="catalog-item">
					<img src="images/main/ourDecors/11.png">
					<p><span></span><br>Акрил</p>
				</a>
			</div>			
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/acrylS" class="catalog-item">
					<img src="images/main/ourDecors/12.png">
					<p><span></span><br>Акрил Сидак</p>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-without-padding">
				<a href="nashi-dekory-id/alum" class="catalog-item">
					<img src="images/main/ourDecors/13.png">
					<p><span></span><br>Алюминий</p>
				</a>
			</div>
			<div class="col-lg-9 col-without-padding">
				<a href="#calculate" class="catalog-item-last a-calc">
				<span style="position:absolute; top:10%;left: 5%; width: 193px;font-size: 18px;line-height: 1.56;">Заказать бесплатный 3D-проект</span>
				<img src='/images/main/3d_project.svg' style="position:absolute; bottom:10%;left: 5%"/>
				<div class="arrow-link" style="right: 5%;"><img src="/images/main/more_arrow.svg"></div>
				</a>
			</div>
		</div>
	</div>
	<div id="question" style="margin-top:120px;">
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
</div>
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
	.pagination > li > a, .pagination > li > span{
		color: black;
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
</script>
<script type="text/javascript">
	$(function () {
		$("#nav-zakaz").addClass('active');
	})
	$(".configuration-type").click(function () {
		var thisBlock = $(this);
		$(".configuration-type-selected").removeClass("configuration-type-selected")
		thisBlock.addClass("configuration-type-selected");
		thisBlock.find("input").prop("checked", true);
	});
	
	$(document).ready(function(){
		$(".a-calc").on("click", function (event) {	
			event.preventDefault();
			var id  = $(this).attr('href'),
				top = $(id).offset().top;
			$('body,html').animate({scrollTop: top}, 1500);
		});
	});
</script>
