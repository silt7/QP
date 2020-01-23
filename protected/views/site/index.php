<? $page = $this->processOutput( $page ); ?>
<? $actions = $this->processOutput( $actions ); ?>
<? $slider = $this->processOutput( $slider ); ?>
<? $runningMeters = $this->processOutput( $runningMeters ); ?>
<? $advantages = $this->processOutput( $advantages ); ?>
<!--<div class="loader"><div class="my_loader"></div></div>-->
<?if (isset($IndentNo)):?>
  <style>
   #header{ 
        position: absolute;
   }
   .QP-kuhni{
		color: #fff;
	}
	#sub-header .top-text a{
		color: #fff;
		border-bottom: none;
	}
	#header{
		background: none;
	}
	#header .line{
		border: none;
	}
	#sub-header a.Rectangle-3{
		display:none;
	}
	.navigate ul > li > a{
		color: #fff;
	}
	.nav li ul a {
		color: #323232;
	}
	a.Rectangle-3{
		border: none;
	}
	.navigate .container {
		border-top: 1px solid rgba(255,255,255,0.1);
    }
	.home-price table td{
		position:relative;
	}
	.home-price table td a{
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0px;
		padding: 10px;
		padding-left: 20px;
		color: #333;
	}
    /*
    body{
        background:url(../images/new/BG.jpg)no-repeat top center;
        background-color:#E9E9E9
    }
    */
  </style>
<?endif?>
<div id="index">
	<!--<div id="carousel-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<? $slideCount = 0; ?>
			<?php if ( $slider ): foreach ( $slider as $slide ): ?>
				<div class="item <?= $slideCount == 0 ? "active" : "" ?>">
					<a href="<?= $slide->link ?>"><img src="/images/slider/<?= $slide->image ?>" alt="<?= $slide->img_alt?>"></a>

					<!--<div class="carousel-caption">
						<p class="h2"><?//= $slide->title ?></p>
						<p><?//= $slide->text ?></p>
					</div>
					<div class="container">
					   <div class="row" style="padding-bottom: 10%;">
						   <p class="h2"><?= $slide->title ?></p>
					   </div>
					</div>-----
				</div>
				<? $slideCount ++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" style="left: 30%;"></span>
		</a>
		<a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" style="right: 30%;"></span>
		</a>
		<div class="container">
		   <div class="row">
			   <a class="a-calc" href="#calculate"><button style="color:#323232">Получить проект мечты<img src="/images/main/btn_project.svg" style="margin-left:15px"/></button></a>
			   <!--<ol class="carousel-indicators">
				  <? //for($i = 0; $i<$slideCount;$i++) echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.(($i==0)?'class="active"':'').'></li>'; ?>
			   </ol>-----
		   </div>
		</div>
	</div>-->
	<div id="header-form">
		<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice2">
			<div class="container">
				<div class="row">
					<p class="h2">Есть проект или фотография кухни? Присылайте для расчёта стоимости.</p>
				</div>
				<div class="row" style="margin-top: 25px;">
					<div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')" required></div>
					<div class="col-lg-4"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
					<div class="col-lg-4"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон"></div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<p  style="color:#fff;margin-bottom: 5px;">&nbsp </p>
						<textarea name="calculate_popup_comment" placeholder="Комментарий" style="width: 100%; height: 58px;padding: 18px;"></textarea>					
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
	<div id="content">
		<div class="container">
			<?= $page->content2 ?>
		</div>
		<div id="typeKitchen" class="container">
			<div class="row" style="margin-top:30px">
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_classic" href="/gotovye-kuhni/klassicheskie-kuhni"><span>Классические кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_modern" href="/gotovye-kuhni/sovremennye-kuhni"><span>Современны кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_corner" href="/gotovye-kuhni/uglovye-kuhni"><span>Угловые кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_line" href="/gotovye-kuhni/pryamye-kuhni"><span>Прямые кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
			</div>
			<div class="row" style="margin-top:30px">
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_premium" href="/gotovye-kuhni/premium-kuhni"><span>Премиум кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_free" href="/gotovye-kuhni/nedorogie-kuhni"><span>Недорогие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_small" href="/gotovye-kuhni/malenkie-kuhni"><span>Маленькие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
				<div class="col-md-3 col-sm-6 typeKitchen_block"><a class="img_big" href="/gotovye-kuhni/bolshie-kuhni"><span>Большие кухни</span><div class="arrow-link"><img src="/images/main/more_arrow.svg"></div></a></div>
			</div>
			<a href="/nashi-raboty" style="color: #323232;text-decoration: none;"><button style="margin-top:30px;"><span style="display:table-cell;vertical-align:middle;width: 190px;">все виды кухонь</span><div class="cyrcle_b"><img src="/images/main/examples_btn.svg"></div></button></a>
		</div>
	</div>
	<!--
	<div id="example">
        <div class="container">
          <div class="row example-row">
            <a href="/gotovye-kuhni/sovremennye-kuhni"><div class="col-lg-7 example-left" style="background: url(/images/main/1.jpg) no-repeat center center;  background-size: cover;"><span>Современные кухни</span><!--<img src="/images/main/maximize.svg" class="maximize"/>--</div></a>
            <div class="col-lg-5">
                <div class="row">
                    <a href="/gotovye-kuhni/premium-kuhni"><div class="col-lg-12 example-right" style="background: url(/images/main/2.jpg) no-repeat center center;  background-size: cover;"><span>Премиум кухни</span></div></a>
                    <a href="/gotovye-kuhni/malenkie-kuhni"><div class="col-lg-12 example-right"  style="background: url(/images/main/3.jpg) no-repeat center center;  background-size: cover;"><span>Маленькие кухни</span></div></a>
                </div>
            </div>
          </div>
        </div>
    </div>-->
	<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/banner.php" );  ?>
    <div id="advantage-2">
    	<div class="container">
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
    		<div class="row">
    			<div class="col-lg-3 col-without-padding">
    				<div  class="main-banner-2">
    				    <a href="/advantage">
    				    <p>Почему именно у нас заказывают кухню?</p>
    					<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>
    					</a>
    				</div>
    			</div>
    			<div class="col-lg-3 col-without-padding">
    				<div  class="main-banner-2">
    				    <a href="/howorder">
    				    <p>Как правильно выбрать кухню!</p>
    					<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>
    					</a>
    				</div>
    			</div>
    			<div class="col-lg-3 col-without-padding">
    				<div  class="main-banner-2">
    				    <a href="/kak-kupit-kuhnyu-nedorogo">
    				    <p>Как заказать кухню дешевле?</p>
    					<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>
    					</a>
    				</div>
    			</div>
    			<div class="col-lg-3">
    				<div  class="main-banner-2">
    				    <a href="/nashi-dekory">
    				    <p>Посмотрите наши декоры</p>
    					<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>
    					</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div id="catalog">
    	<div class="container">		
    		<div class="row" style="margin: 50px 0 50px 0;">
    			<div class="col-lg-3"><p class="h2">Каталог<br>наших<br>товаров</p><p style="padding-top:30px"><span >У нас очень широкий<br>ассортимент товаров.</span></p></div>
    			<div class="col-lg-9">
    				<div >
    				<div class="row">
    					<div class= "col-lg-3 col-without-padding">
    					<a href="catalog/kitchenmodules" class="catalog-item">
    						<img src="images/new/module.jpg"/>
    						<span>Кухонные модули</span>
    					</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding">
    						<a href="catalog/fronts" class="catalog-item">
    							<img src="images/new/fasad.jpg"/>
    							<span>Фасады</span>
    						</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding">
    						<a href="catalog/stoleshnicy/8" class="catalog-item">
    								<img src="images/new/table.jpg"/>
    								<span>Столешницы</span>
    						</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding" >
    						<a href="catalog/stenovye-paneli/9" class="catalog-item">
    								<img src="images/new/wall.jpg"/>
    								<span>Стеновые панели</span>
    						</a>
    					</div>
    				</div>
    				<div class="row">
    					<div class= "col-lg-3 col-without-padding" >
    						<a href="catalog/kuhonnye-aksessuary/11" class="catalog-item">
    								<img src="images/new/acsess.jpg"/>
    								<span>Аксессуары</span>
    						</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding" >
    						<a href="catalog/kuhonnaya-tehnika/12" class="catalog-item">
    								<img src="images/new/equipm.jpg"/>
    								<span>Техника</span>
    						</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding" >
    						<a href="catalog/shkafy/62" class="catalog-item">
    								<img src="images/new/shkaf.jpg"/>
    								<span>Шкафы</span>
    						</a>
    					</div>
    					<div class= "col-lg-3 col-without-padding">
    						<a href="catalog" class="catalog-item-last">
    						<span>Перейти<br>в каталог</span>
    						<div class="arrow-link"><img src="/images/main/more_arrow.svg"/></div>
    						</a>
    					</div>
    				</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div id="popular">
        <div class="container">
            <div class="row popular-row">
                <div class="col-lg-4">
                    <p class="h2">Самые известные товары</p>
                    <p style="padding-top:30px;"><span style="color: #323232;">Это кухни, которые<br>пользуются у нас особой<br>популярностью.</span></p>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-without-padding">
    						<a href="kitchen/30" class="catalog-item">
    							<!--<img src="images/new/module.jpg"/>-->
								<img src="/images/kitchens/prev/30.jpg"/>
    							<span>Кухня классика МДФ<br>Жемчужный ясень/Квадро</span><br>
								<div class="kitchens__price" rel="nofollow">
        						    <span style="color: #F32727 !important; text-decoration: line-through;"><span style="color: #000">97 390  руб.</span></span>
        						    <span class="kitchens__price_actual" style="color: #ffc500 !important;">&nbsp&nbsp64&nbsp280 руб.</span>
								</div>
    							<div class="arrow-link"><img src="/images/main/more_arrow.svg"  style="width:auto"/></div>
    						</a>
    					</div>
                        <div class="col-lg-4 col-without-padding">
    						<a href="kitchen/seryi-morskaya-volna" class="catalog-item">
    							<img src="/images/kitchens/prev/41.jpg"/>
    							<span>Кухня металлик<br>Серый/Морская волна</span><br>
								<div class="kitchens__price" rel="nofollow">
        						    <span style="color: #F32727 !important; text-decoration: line-through;"><span style="color: #000">116 830 руб.</span></span>
        						    <span class="kitchens__price_actual" style="color: #ffc500 !important;">&nbsp&nbsp77&nbsp110 руб. </span>
								</div>
    							<div class="arrow-link"><img src="/images/main/more_arrow.svg" style="width:auto"/></div>
    						</a>
    					</div>
                        <div class="col-lg-4 col-without-padding">
    						<a href="kitchen/42" class="catalog-item">
    							<img src="/images/kitchens/prev/42.jpg"/>
    							<span>Кухня пластик Бордовый глянец</span><br>
    							<div class="kitchens__price" rel="nofollow">   
    							    <span style="color: #F32727 !important; text-decoration: line-through;"><span style="color: #000">77 000 руб.</span></span>
        						    <span class="kitchens__price_actual" style="color: #ffc500 !important;">&nbsp&nbsp50&nbsp820 руб.</span>
								</div>
    							<div class="arrow-link"><img src="/images/main/more_arrow.svg" style="width:auto"/></div>
    						</a>
    					</div>
                    </div>
                </div>
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
    	                      		<p>Добавьте изображения, если есть:</p>
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
    	            </div>
    	            <hr>
    	            <div class="row">
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон"></div>
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
    <div id="instagram-block">
        <div class="container">
            <div class="row" style="position:relative;">
    			<span class="sharp">#</span>
                <div class="col-lg-4">
                    <img class="inst" src="images/main/instagram.svg"/>
                    <p class="h2">Следите<br>за нами</p>
                    <p><span>Мы постоянно<br>показываем наши<br>работы<br>в Instagram.</span></p>
                    <a href="https://www.instagram.com/qpkuhni/"><span style="color:#323232;font-size: 18px;"><b>@qpkuhni</b></span></a>
                </div>
                <div class="col-lg-8 row-inst-mob" style="margin-bottom:100px;">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-without-padding" style="background: url('images/main/inst-1.png');"></div>
                        <div class="col-lg-3 col-sm-6 col-without-padding" style="background: url('images/main/inst-2.png');"></div>
                        <div class="col-lg-3 col-sm-6 col-without-padding" style="background: url('images/main/inst-3.png');"></div>
                        <div class="col-lg-3 col-sm-6 col-without-padding" style="background: url('images/main/inst-4.png');"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-9.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-10.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-11.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-12.png');"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-13.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-14.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-15.png');"></div>
                        <div class="col-lg-3 col-without-padding" style="background: url('images/main/inst-16.png');"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-price">
    	<div class="container">
    		<div class="row">
    			<div class= "col-md-8">
    				<h1>Купить кухню от производителя <br> в Санкт-Петербурге</h1>
    				<!--<iframe width="700" height="400" src="https://www.youtube.com/embed/26Y8svcp7HY" frameborder="0" allowfullscreen></iframe>-->
    			    <?= $page->content ?>
    				
    			</div>
    			<div class="col-md-4">
    			    <a href="http://www.qp.qp-kuhni.ru" target="_blank" ><img src="/images/main/banner.png" style="margin-top:30px; width:100%"/></a>
    			    
    				<div class="main-right">
    				    
    				    <div class="main-right-title" style="margin-bottom:0">
    				        <div class="main-right-title-up"></div>
    				        <div class="main-right-title-down">VK оставляйте отзывы</div>
    				    </div>
						<!--
    					<?foreach($reviews as $review): $reviewIMG = unserialize($review->img);?>
    						<noindex>
    						<div class="main-right-item" rel="nofollow">
    						    <div class="row">
    							<?if (!file_exists("/images/review/".array_shift($reviewIMG))):?>
    								<a href="/review">	
    									<div class="review_img" style="background-image: url('/images/review/<?= array_shift($reviewIMG);?>');"></div>
    									<!--<img class="review_img" src="/images/review/<?= array_shift($reviewIMG);?>"/>
    								</a>						
    							<?else:?>
    								<img class="review_img" src="/images/without.jpg"/>
    							<?endif?>
    							</div>
    							<div class="row">
        							<div class="descrINDEX"><p class="name" ><?= $review->fio?></p><p class="text"><?= $review->text?></p></div>
        							<a href="/review">Прочитать полностью</a>
        						</div>
    							
    						</div>
    						</noindex>
    					<?endforeach?>
						-->
						<div id="feedback_vk" class="main-right-item"></div>
    				</div>
    				<div class="main-right">
    					<div class="main-right-title">
    				        <div class="main-right-title-up"></div>
    				        <div class="main-right-title-down">Полезные статьи</div>
    				    </div>
    					<?foreach($PoleznoZnat as $new): $reviewIMG = unserialize($new->img);?>
    						<div class="main-right-item">
    						    <div class="row">
        							<?if (!empty($reviewIMG)): $img = array_shift($reviewIMG);?>
        								<?if (!file_exists("/images/polezno-znat/".$img)):?>
        									<a href="/polezno-znat/<?= $new->url?>"><div class="review_img" style="background-image: url('/images/polezno-znat/<?= $img;?>');"></div></a>
        									<!--<img class="review_img" src="/images/polezno-znat/<?= $img;?>"/></a>-->
        								<?else:?>
        									<a href="/polezno-znat/<?= $new->url?>"><img class="review_img" src="/images/without.jpg"/></a>
        								<?endif?>
        							<?else:?>
        								<a href="/polezno-znat/<?= $new->url?>"><img class="review_img" src="/images/without.jpg"/></a>
        							<?endif?>
        						</div>
        						<div class="row">
        							<div class="descrINDEX"><p class="name"><?= $new->title?></p><p class="text"><?= mb_strimwidth($new->description, 0, 100, "...");?></p></div>
        							<a href="/polezno-znat/<?= $new->url?>">Показать полностью</a>
    						    </div>
    						</div>
    					<?endforeach?>
    				</div>
    				<div class="main-right">
    				    <div class="main-right-title">
    				        <div class="main-right-title-up"></div>
    				        <div class="main-right-title-down">Новости</div>
    				    </div>
    					<?foreach($news as $new): $reviewIMG = unserialize($new->img);?>
    						<div class="main-right-item">
    						    <div class="row">
        							<?if (!empty($reviewIMG)): $img = array_shift($reviewIMG);?>
        								<?if (!file_exists("/images/news/".$img)):?>
        									<a href="/newsItem/<?= $new->id?>"><img class="review_img" src="/images/news/<?= $img;?>"/></a>						
        								<?else:?>
        									<a href="/newsItem/<?= $new->id?>"><img class="review_img" src="/images/without.jpg"/></a>
        								<?endif?>
        							<?else:?>
        								<a href="/newsItem/<?= $new->id?>"><img class="review_img" src="/images/without.jpg"/></a>
        							<?endif?>
    							</div>
    							<div class="row">
        							<div class="descrINDEX">
        								<p class="name"><?= $new->title?></p><p class="text"><?= $new->description?></p>
        								</p>
        							</div>
        							<a href="/newsItem/<?= $new->id?>">Показать полностью</a>
    					        </div>
    						</div>
    					<?endforeach?>	
    				</div>
    			</div>
    		</div>
    		<iframe style="margin-top: 50px;" frameborder="0" height="400" src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac8b8662b4356fe8ecf318125487407fb2d2fd92b64990116a538da718d6ae4f2&amp;source=constructor" width="100%"></iframe>
    	</div>
    </div>
    <div id="question">
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
	<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/rateArticle.php" );  ?>
</div>
<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>

<script type="text/javascript">
	$(function () {
		$("#nav-main").parent().addClass('active');


	})


	function initPopupSliders() {

		setTimeout(function () {

			var isMobile = {
				Android: function () {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function () {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function () {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function () {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function () {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function () {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};

			if (isMobile.any()) {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 2,
					dots: false,
					prevArrow: '',
					nextArrow: ''
				});


			} else {
				$('#front-top-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});

				$('#front-bottom-colors').slick({
					infinite: true,
					slidesToShow: 8,
					slidesToScroll: 8,
					dots: false,
					prevArrow: '<div class="calculate-price-popup-shop-prev">+</div>',
					nextArrow: '<div class="calculate-price-popup-shop-next">-</div>'
				});


			}
		}, 10);
	}


	$(".calculate-price-modal-front-color-item").click(function () {
		var thisColor = $(this);
		thisColor.parent().find(".calculate-price-modal-front-color-item-selected").removeClass("calculate-price-modal-front-color-item-selected");
		thisColor.addClass("calculate-price-modal-front-color-item-selected");
		thisColor.find("input[type=radio]").prop("checked", true);
	});

		
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
	$(document).ready(function(){
		$(".a-calc").on("click", function (event) {	
			event.preventDefault();
			var id  = $(this).attr('href'),
				top = $(id).offset().top;
			$('body,html').animate({scrollTop: top}, 1500);
		});
	});
</script>