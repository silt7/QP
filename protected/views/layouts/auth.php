<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name='wmail-verification' content='bdcbe26c2590b824e01810702a22a7a0' />
	<meta name="yandex-verification" content="770db0f0756f91b9" />
	<title><? if($this->seo) echo $this->seo->title; else echo $this->pageTitle; ?></title>
	<meta name="description" content="<?if($this->seo) echo $this->seo->desription; else if( isset($this->description)) echo $this->description; ?>" />
	<meta name="keywords" content="<? if($this->seo) echo $this->seo->keywords; ?>" />
	
	
	<?if(isset($this->canonical)){
	    if($this->canonical != "") 
	        Yii::app()->clientScript->registerLinkTag('canonical',null, $this->canonical);
    }
    else   
	    Yii::app()->clientScript->registerLinkTag('canonical',null, Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo());?>    
	<link rel="icon" type="image/jpg" href="<? Yii::app()->homeUrl ?>/favicon.png" />


	<link rel="stylesheet" href="/css/app.css" type="text/css">
	<link rel="stylesheet" href="/css/app-m.css" type="text/css">


	<link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fonts/stylesheet.css" type="text/css">
	<link rel="stylesheet" href="/css/common.css" type="text/css"> 
	<link rel="stylesheet" href="/css/main.css" type="text/css"> 
	

	<script src="/js/jquery.2.1.js" type="text/javascript"></script>
	<script src="/js/jquery.validation.min.js" type="text/javascript"></script>
	<script src="/plugins/slick/slick.min.js" type="text/javascript"></script>
	<script src="/plugins/mdetect/mdetect.js" type="text/javascript"></script>
	<script src="/js/utils.js" type="text/javascript"></script>
	<script src="/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="/plugins/magnific-popup/dist/jquery.magnific-popup.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		 
		$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
		$('.scrollup').fadeIn();
		} else {
		$('.scrollup').fadeOut();
		}
		});
		 
		$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
		});
		 
		});
	</script>
    <script>
        $(document).ready(function(){
            var menu = $(".navigate");
            $(window).scroll(function(){
                if ( $(this).scrollTop() > 80 && menu.hasClass("navigateDef") ){
                    menu.removeClass("navigateDef");
                    menu.addClass("navigateFix");
                } else if($(this).scrollTop() <= 80 && menu.hasClass("navigateFix") ) {
                    menu.removeClass("navigateFix");
                    menu.addClass("navigateDef");
                }
            });//scroll
        });
    </script>
	<!-- fotorama.css & fotorama.js. -->
	<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
	<!-- Marquiz script start --> <script src="//script.marquiz.ru/v1.js" type="application/javascript"></script> <script> document.addEventListener("DOMContentLoaded", function() { Marquiz.init({ id: '5d7618f05253090044c54014', autoOpen: false, autoOpenFreq: 'once', openOnExit: true }); }); </script> <!-- Marquiz script end -->
</head>
<body>
	<a href="#" id="successSend_a" data-toggle="modal" data-target="#successSend" style="display:none"></a>
    <div id="header">
        <div id="sub-header" class="container">
			<div class="row top-text">
				<div class="col-lg-8 col-xs-12">
					<div title=“QP-kuhni” class="QP-kuhni"><span class="text-style-1">QP</span><span>-kuhni</span>
					<br><span class="text-style-2">Кухни без хлопот!</br>
					</div>
					<a href="#" id="callback-navigate" class="Rectangle-3 callback_mob" data-toggle="modal" data-target="#callback-modal" onclick="typeModal('call'); yaCounter31370493.reachGoal('callback-navigate');"><span>ОБРАТНЫЙ ЗВОНОК</span><img class="img-no-fix" src="/images/main/btn_callback.svg"><img class="img-fix" src="/images/main/btn_callback_white.svg" style="display:none"></a>
					<a href="/" class="Rectangle-3" style="float:left;"><span style="margin-left:35px">НА ГЛАВНУЮ</span>
					<img src="/images/main/btn_project_yellow.svg"></a>
				</div>
				<div class="col-lg-2 col-xs-12 infoqp-kuhniru">
					<img src="/images/main/email.svg"><a href="mailto:e-mail: info@QP-kuhni.ru">info@qp-kuhni.ru</a>
				</div>
				<div class="col-lg-2 col-xs-12 infoqp-kuhniru">
					<img src="/images/main/phone.svg"><a href="tel:+78129529783">8 812 952-97-83</a>
				</div>
			</div>
		</div>
		<!--<div class="line"></div>-->
            <!--<div class="QP-kuhni"><span class="text-style-1">QP</span><span>-kuhni</span></div>-->
        <?php require_once( "navigate.php" ); ?>
    </div>
<!--<div id="qp-test" class="container" style="position: relative;"><a href="http://www.qp.qp-kuhni.ru" target="_blank"><img src="/images/qp-test.png"/></a>
    <span onClick="$('#qp-test').hide()" style="font-size: 40px; line-height: 0.6; position: absolute; right:15px;top:0px; color:#fff; cursor: pointer;">×</span></div>-->
<!--<div class="black-over"></div>
<div class="header">
<div class="header-main">
	<div class="container">

		<div class="row" style="position: relative;">
			<div class="col-lg-3 col-md-2 col-xs-12 logo-b-h" style="margin-top: 0px;">
				<!--<img src="/images/new/logo.png" title="Салон кухонной мебели - QP-kuhni (Купи кухни)">--/>
				<a href="/" title="Купить кухню без хлопот!" id = "Logo_a" style="text-decoration: none;">
				<div id="logo_text">
					<p style="line-height: 0.9;"><span style="color:#FFC90D;">QP</span>-kuhni</p><p id="slog">Кухни без хлопот!</p>
				</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12 col-sm-4">
				<div class="callback" style="text-align:center;">
					<a href="tel:+78129529783" class="phone_a"><p class="h2">+7 (812) <span>952-97-83</span></p></a><br>
					<span class="work-graphic">(Ежедневно с 10:00 до 20:00)</span>
					
					<a href="#" id="callback_a" data-toggle="modal" data-target="#callback-modal"><img src="/images/new/phone.png">Заказать обратный звонок</a><br>
					<a class="phone_a" href="mailto:e-mail: info@QP-kuhni.ru"><p class="h2"><span style="font-size:14px;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif">e-mail: info@QP-kuhni.ru</span></p></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12  col-sm-4 admin-panel" style="padding-left: 30px;">
			
					<? if ( $this->checkRole( 'admin' ) ): ?>

						<i class="fa fa-home"></i> <a href="/admin">Панель</a>
						управления сайтом
					<?
					else:
						if ( $this->checkRole( 'base_user' ) ): ?>
						<div class="pull-left">
							<i class="fa fa-home"></i> <a href="/profile/orders">Мои заказы</a><br>
							<i class="fa fa-gear"></i> <a href="/profile">Редактирование информации</a><br>
						</div>	

						<? endif;endif; ?>
				
					<? //= $this->checkRole( 'base_user' ); ?>
					<? //print_r( Yii::app()->user ); ?>
					<? //print_r( Yii::app()->user->role ); ?>
					<? //print_r( Yii::app()->user->isGuest ); ?>
					
					
					<? if ( $this->checkRole( 'base_user' ) || $this->checkRole( 'admin' ) ): ?>
						<div class="pull-left">
								<i class="fa fa-sign-out"></i> <a href="/sign-out" style="color: black; border-bottom: 1px dotted black;">ЗАВЕРШЕНИЕ РАБОТЫ</a>
						</div>		
					<? else: ?>
						<!--<div class="pull-right">
							<i class="fa fa-sign-in"></i>
							<a href="/sign-in">Вход в личный кабинет</a><br>
							<a href="/sign-up" style="margin-left:20px;">Регистрация</a>
						</div>---/>
					<? endif; ?>
					
			</div>
			<div class="col-lg-3 col-md-4 col-xs-12  col-sm-4 pull-right">
				<div class="pull-left">
							<?
							$order = $this->getShoppingCartModel();
							?>
					<div class="media">
						<div class="pull-left icon-cart">
							<a href=""></a><strong id="shopping-cart-quantity" > <?= $order->getTotalCount() ?></strong> 
						</div>
						<div class="media-body" style="margin-top: 5px;">
							<p class="media-heading h4">
								<a href="/shopping-cart">Корзина товаров</a>
							</p>
							
						</div>
					</div>
					<p style="margin-top: 5px; margin-left: 30px;">
						товаров на сумму <strong id="shopping-cart-price"><?= Utils::priceFormat( $order->getTotalPrice() ) ?></strong> руб.
					</p>
				</div>
			</div>
			<!--<a href="/advantage" class="cheaper_b"><span>ПОЧЕМУ ИМЕННО У НАС ЗАКАЗЫВАЮТ КУХНЮ?</span></a>
		</div>
	</div>
</div>
</div>
-->

<div class="modal" id="callback-modal" tabindex="-1" role="dialog" aria-labelledby="заказать звонок" aria-hidden="true">
	<div id="question" style="background: transparent; top:15%">
	<!--<div class="modal-dialog modal-lg">
		<div class="modal-content">-->
			<!--<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel"><?= $this->callback->title ?></p>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<?= $this->callback->content ?>
						<p style="font-size:10px;">Нажимая «Заказать звонок», вы даёте согласие на обработку своих персональных данных в соответствии
                        с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
					</div>
					<div class="col-sm-6">
						<form role="form" action="/files/mail/mail.php" method="POST" id="call-form">
							<div class="form-group">
								<label for="exampleInputEmail1"><span class="text-danger">*</span> Имя</label>
								<input type="text" class="form-control" name="name" placeholder="Ваше имя">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1"><span class="text-danger">*</span> Телефон:</label>
								<input  type="text" class="form-control" name="phone" id="exampleInputPassword1"
								       placeholder="Ваш контактный телефон">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Комментарий:</label>
								<textarea class="form-control" name="comment" placeholder="Ваш комментарий к звонку"></textarea>
							</div>
							<button class="btn promo-button"><?= $this->callback->menu ?></button>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>-->
    		<div class="container" style="text-align:center;">
                <div class="row div-form" style="padding: 15px; background: #fff;">
                    <div data-dismiss="modal" id="closeModal" style="float: right; margin-right:20px; font-size: 26px; cursor: pointer;"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></div>
                    <!--<p class="h2">Остались вопросы?</p>-->
                    <p class="text" style="font-size:27px; margin-top: 5%">Заполните форму и наш менеджер<br>свяжется с Вами в ближайшее время</p>
                    <form role="form" action="/files/mail/mail.php" method="POST" id="call-form">
                        <input type="hidden" name="question" value="y">
						<input type="hidden" name="pageURL" value="https://qp-kuhni.ru<?= Yii::app()->request->requestUri;?>">
                        <input type="hidden" id="type-modal" name="type-modal" value="">
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
        		                <div class="policy" style="color:black;">Нажимая «Заказать рассчет стоимости», вы даёте согласие на обработку своих 
        		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
        		                и принимаете <b><a href="#">условия</a></b></div>
        		                <button style="background: #ffc500"><span id="callback-modal-b"></span><img src="/images/main/btn_callback_white.svg" style="margin-left:15px; border: 1px silid black"/></button>
        		            </div>      
        	            	<div class="col-lg-2"></div>
        	            </div>
                    </form>
                </div>
            </div>
		<!--</div>
	</div>-->
	</div>
</div>
<script>
    function typeModal(type){
        $('#type-modal').val(type);
		if(type == 'design'){
			$('#callback-modal-b').html('Заказать вызов дизайнера');
			$('#callback-modal button').attr('onclick',"yaCounter31370493.reachGoal('free-design');");
		}
		else if(type == 'order'){
			$('#callback-modal-b').html('Заказать кухню');
		}
		else{
			$('#callback-modal-b').html('Заказать обратный звонок');
			$('#callback-modal button').attr('onclick',"yaCounter31370493.reachGoal('callback-navigate');");
		}
		
    }
</script>
<div class="modal" id="successSend" tabindex="-1" role="dialog" aria-labelledby="Сообщение отправленно" aria-hidden="true">
	<div class="container" style="text-align:center;">
		<div class="container" style="margin-top:15%; width: 60%; text-align:center;">
			<div class="row div-form" style="background: #fff;">
				<div><img src="/images/main/success1.png" width="75px" height="75px" style="margin: 20px 0;">
					<p style="font-size: 36px; font-weight:bold">Спасибо!<br>Ваша заявка отправлена!</p>
				</div>
				<div data-dismiss="modal" id="closeModal" style="background:rgb(255,197,0,0.5); border-radius:5px; width:60px; margin: 20px auto; font-size: 26px; cursor: pointer;"><span aria-hidden="true">ОК</span><span
					class="sr-only">ОК</span></div>
			</div>
		</div>
	</div>
</div>







<div <? if($_SERVER['REQUEST_URI']!='/') echo 'class="body_main"'; ?> >
<?php echo $content; ?>
</div>
<? require_once( Yii::getPathOfAlias( 'webroot' ) . "/protected/views/include/calcCost.php" );  ?>


<script type="text/javascript">
	/** Загрузка изображений в главной форме и форме расчёт стоимости**/
	function processFiles(e) {
		var parent = $(e).closest(".row");
		var fileName = parent.find('#file-name');
		var files = e.files;
		if(files.length != 0){
			var num = Number($(e).closest("div").attr('number')) + 1;
			parent.find('.file-upload').hide();
			parent.find('div[number="' + num + '"]').show();
			var names = [];
			for (var i = 0; i < files.length; ++i) {
				names.push(files[i].name + " ");
			}
			fileName.append(names);
		}
	};
</script>
<div id="footer">
	<div class="container clearfix">
	   <div class="row">
	       <div class="col-lg-3">
	           <ul>
	               <li><a href="/gotovye-kuhni"><b>Готовые кухни</b></a></li>
	               <li><a href="/gotovye-kuhni/klassicheskie-kuhni">Классические</a></li>
	               <li><a href="/gotovye-kuhni/sovremennye-kuhni">Современные</a></li>
	               <li><a href="/gotovye-kuhni/uglovye-kuhni">Угловые</a></li>
	               <li><a href="/gotovye-kuhni/pryamye-kuhni">Прямые</a></li>
	               <li><a href="/gotovye-kuhni/premium-kuhni">Премиум</a></li>
	               <li><a href="/gotovye-kuhni/nedorogie-kuhni">Недорогие</a></li>
	               <li><a href="/gotovye-kuhni/p-obraznaya-kuhnya">П-образные</a></li>
	               <li><a href="/gotovye-kuhni/kuhnya-s-ostrovkom">С островком</a></li>
	               <li><a href="/gotovye-kuhni/kuhnya-s-barnoy-stoykoy">С барной стойкой</a></li>
	               <li><a href="/gotovye-kuhni/vstraivaemye-kuhni">Встраиваемые</a></li>
	           </ul>
	       </div>
	       <div class="col-lg-3">
	           <ul>
	               <li><a href="/catalog"  title="Модули для кухни"><b>Каталог товаров</b></a></li>
	               <li><a href="/catalog/kitchenmodules"  title="Фасады для кухни">Кухонные модули</a></li>
	               <li><a href="/catalog/fronts"  title="Фасады для кухни">Кухонные фасады</a></li>
	               <li><a href="/catalog/stoleshnicy/8"  title="Столешницы">Столешницы</a></li>
	               <li><a href="/catalog/stenovye-paneli/9"  title="Стеновые панели">Стеновые панели</a></li>
	               <li><a href="/catalog/kuhonnye-aksessuary/11"  title="Аксессуары для кухни">Кухонные аксессуары</a></li>
	               <li><a href="/catalog/kuhonnaya-tehnika/12"  title="Техника для кухни">Кухонная техника</a></li>
	               <li><a href="/catalog/shkafy/62"  title="Шкафы">Шкафы</a></li>
	           </ul>
	       </div>
	       <div class="col-lg-3">
	           <ul>
	               <li><b>Информация</b></li>
	               <li><a href="/contacts" title="Контакты">Контакты</a></li>
	               <li><a href="/how-to" title="Как заказать">Как заказать</a></li>
	               <li><a href="/delivery" title="Доставка и сборка">Доставка и сборка</a></li>
	               <li><a href="/about" title="О производстве">О производстве</a></li>
	               <li><a href="/polezno-znat" title="Все о кухнях">Все о кухнях</a></li>
	               <li><a href="/review" title="Отзывы">Отзывы</a></li>
	               <li><a href="/news" title="Новости">Новости</a></li>
	               <li><a href="/advantage" title="Наши преимущества">Наши преимущества</a></li>
	               <li><a href="/nashi-raboty" title="Наши сделанные кухни">Наши работы</a></li>
	               <li><a href="/nashi-dekory" title="Наши декоры">Наши декоры</a></li>
	   	       </ul>
	       </div>
	       <div class="col-lg-3 data-company">
	           <p class="inn">ООО «КВАЛИТИ ПЕРФОМАНС»<br>
                ОГРН 1147847178379<br>
                ИНН 7802860652<br>
                КПП 780201001
                </p>
                <div><img src="/images/main/email_footer.svg"><b style="font-size: 16px;"><a href="mailto:e-mail: info@QP-kuhni.ru">info@qp-kuhni.ru</a></b></div>
                <div style="margin-top:10px"><img src="/images/main/phone_footer.svg"><b style="font-size: 16px;"><a href="tel:+78129529783">8 812 952-97-83</a></b></div>
				<div style="margin-top:7%;margin-left: -3px;"><a target="_blank" href="https://vk.com/qpkuhni" rel="nofollow"><img src="/images/new/vk.png" style="width:35px; height:35px;"></a>
				<a target="_blank" href="https://www.instagram.com/qpkuhni/" rel="nofollow"><img src="/images/new/inst.png" style="width:35px; height:35px;"></a>
				<a target="_blank" href="https://twitter.com/qpkuhni" rel="nofollow"><img src="/images/new/tw.png" style="width:35px; height:35px;"></a>
				<a target="_blank" href="https://www.facebook.com/qpkuhni" rel="nofollow"><img src="/images/new/f.png" style="width:35px; height:35px;"></a>
				</div>
				<? if ( $this->checkRole( 'admin' ) ): ?>
					<i class="fa fa-home"></i> <a href="/admin">Панель</a>
					управления сайтом
				<?
				else:
					if ( $this->checkRole( 'base_user' ) ): ?>
					<div class="pull-left">
						<i class="fa fa-home"></i> <a href="/profile/orders">Мои заказы</a><br>
						<i class="fa fa-gear"></i> <a href="/profile">Редактирование информации</a><br>
					</div>	

					<? endif;endif; ?>
			
				<? //= $this->checkRole( 'base_user' ); ?>
				<? //print_r( Yii::app()->user ); ?>
				<? //print_r( Yii::app()->user->role ); ?>
				<? //print_r( Yii::app()->user->isGuest ); ?>
				<? if ( $this->checkRole( 'base_user' ) || $this->checkRole( 'admin' ) ): ?>
					<div class="pull-left">
						<i class="fa fa-sign-out"></i> <a href="/sign-out" style="color: black; border-bottom: 1px dotted black;">ЗАВЕРШЕНИЕ РАБОТЫ</a>
					</div>		
				<? else: ?>
				    <div style="margin-top:8%;"><a href="/sign-in">Вход в личный кабинет</a></div>
					<!--<div class="pull-right">
						<i class="fa fa-sign-in"></i>
						<a href="/sign-in">Вход в личный кабинет</a><br>
						<a href="/sign-up" style="margin-left:20px;">Регистрация</a>
					</div>-->
				<? endif; ?>
	       </div>
       </div>
       <hr>
       <div class="row" style="text-align:center">
            <p>Информация на данном интернет-сайте носит исключительно ознакомительный<br>
            характер и ни при каких условиях не является публичной офертой, определяемой<br>
            положениями Статьи 437 Гражданского кодекса РФ. <a href="/politik.html">Политика конфиденциальности</a></p>
            <p>Copyright © 2014-2019</p>
       </div>
	    <!--<div class="left">
	        <p>Copyright © 2014-2018</p>
            <p>ООО «КВАЛИТИ ПЕРФОМАНС»<br>
            
            ОГРН 1147847178379 
            
            ИНН 7802860652
            
            КПП 780201001</p>
            <p>город Санкт-Петербург</p>
            <p>Информация на данном интернет-сайте носит исключительно ознакомительный<br>
            характер и ни при каких условиях не является публичной офертой, определяемой<br>
            положениями Статьи 437 Гражданского кодекса РФ. <a href="/politik.html">Политика конфиденциальности</a></p>
	    </div>
	    <div class="right">
	        <p>тел.: (812) 952-97-83</p>
	        <p>e-mail: <a href="mailto:e-mail: info@QP-kuhni.ru">info@QP-kuhni.ru</a></p>
			<p><a target="_blank" href="https://vk.com/qpkuhni" rel="nofollow"><img src="/images/new/vk.png" style="width:35px; height:35px;"></a>
			<a target="_blank" href="https://www.instagram.com/qpkuhni/" rel="nofollow"><img src="/images/new/inst.png" style="width:35px; height:35px;"></a>
			<a target="_blank" href="https://twitter.com/qpkuhni" rel="nofollow"><img src="/images/new/tw.png" style="width:35px; height:35px;"></a>
			<a target="_blank" href="https://www.facebook.com/qpkuhni" rel="nofollow"><img src="/images/new/f.png" style="width:35px; height:35px;"></a>
			</p>
			
	    </div>
	    <div class="right">
			<i class="fa fa-sign-in"></i>
			<a href="/sign-in">Вход в личный кабинет</a>
	    </div>
	    <div class="clearfix"></div>-->
	</div>
	<div class="clr"></div>
    <!— Yandex.Metrika counter —> 
    <script type="text/javascript"> 
    (function (d, w, c) { 
    (w[c] = w[c] || []).push(function() { 
    try { 
    w.yaCounter31370493 = new Ya.Metrika({ 
    id:31370493, 
    clickmap:true, 
    trackLinks:true, 
    accurateTrackBounce:true, 
    webvisor:true 
    }); 
    } catch(e) { } 
    }); 
    
    var n = d.getElementsByTagName("script")[0], 
    s = d.createElement("script"), 
    f = function () { n.parentNode.insertBefore(s, n); }; 
    s.type = "text/javascript"; 
    s.async = true; 
    s.src = "https://mc.yandex.ru/metrika/watch.js"; 
    
    if (w.opera == "[object Opera]") { 
    d.addEventListener("DOMContentLoaded", f, false); 
    } else { f(); } 
    })(document, window, "yandex_metrika_callbacks"); 
    </script> 
    <noscript><div><img src="https://mc.yandex.ru/watch/31370493" style="position:absolute; left:-9999px;" alt="" /></div></noscript> 
    <!— /Yandex.Metrika counter —>
	
	<!— Rating@Mail.ru counter —> 
	<script type="text/javascript"> 
	var _tmr = window._tmr || (window._tmr = []); 
	_tmr.push({id: "2758807", type: "pageView", start: (new Date()).getTime()}); 
	(function (d, w, id) { 
	if (d.getElementById(id)) return; 
	var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id; 
	ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js"; 
	var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);}; 
	if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } 
	})(document, window, "topmailru-code"); 
	</script><noscript><div style="position:absolute;left:-10000px;"> 
	<img src="//top-fwz1.mail.ru/counter?id=2758807;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" /> 
	</div></noscript> 
	<!— //Rating@Mail.ru counter —>
	<script> 
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), 
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 
    
    ga('create', 'UA-73205041-1', 'auto'); 
    ga('send', 'pageview'); 
    
    </script>
</div>
<a href="#" class="scrollup"></a>
<script src="/js/lib/ckeditor-full/ckeditor.js"></script>
<script src="/js/lib/ckfinder/ckfinder.js"></script>

<script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/plugins/bootstrap_dropdowns_enhancement/dist/js/dropdowns-enhancement.js"></script>
<script type="text/javascript" src="/plugins/bootstrap-filestyle/src/bootstrap-filestyle.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<div class="fancybox-overlay fancybox-overlay-fixed" style="display: none; width: auto; height: auto;" id="action-modal">
	<div id="action-modal-banner" class="fancybox-wrap fancybox-desktop fancybox-type-image fancybox-opened" tabindex="-1" style="opacity: 1; overflow: visible; height: auto; position: absolute; top: 30%; left: 50%; ">
		<div class="fancybox-skin" style="padding: 15px; width: auto; height: auto;"><div class="fancybox-outer"><div class="fancybox-inner">
			<img class="fancybox-image" src="/images/action3.jpg" alt=""></div></div>
			<a title="Close" id="action-modal-close" class="fancybox-item fancybox-close" href="javascript:;"></a>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(function(){
      $("#exampleInputPassword1").mask("8(999) 999-9999");
      $("#phoneF,#phoneF2").mask("8(999) 999-9999");
      $("#designer-popup-phone").mask("8(999) 999-9999");      
    });
</script>
<!-- BEGIN venyoo CODE {literal} -->
<script type="text/javascript" src="//api.venyoo.ru/wnew.js?wc=venyoo/default/science&widget_id=6585583498690560"></script>
<!-- {/literal} END venyoo CODE -->
<!-- BEGIN JIVOSITE CODE {literal} 0eSh9pUdjt Kb5XymUNIG--
<script type='text/javascript'>
(function(){ var widget_id = 'Kb5XymUNIG';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!--{/literal} END JIVOSITE CODE -->
<div itemscope itemtype="https://schema.org/Organization" style="display:none;">
  <span itemprop="name">QP-kuhni</span>
  Контакты:
  <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
    Адрес:
    <span itemprop="streetAddress">ТЦ "Эврика", Шлиссельбургский проспект, дом 3-7, этаж 2, офис 87</span>
    <span itemprop="postalCode">190000</span>
    <span itemprop="addressLocality">Санкт-Петербург</span>,
  </div>
  Телефон:<span itemprop="telephone">8 812 952-97-83</span>,
  Электронная почта: <span itemprop="email">info@qp-kuhni.ru</span>
</div>
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?162",t.onload=function(){VK.Retargeting.Init("VK-RTRG-356838-58aVi"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-356838-58aVi" style="position:fixed; left:-999px;" alt=""/></noscript>
</body>
<?//SetCookie("wasUser2","");?>
<script>
	$(document).ready(function(){
		if (!$.cookie('wasUser2')) {
			$.cookie('wasUser2', true, {
				expires: 0.25,
				path: '/'
			}); 
			//$('#action-modal').show(800); 
		}
	})
	$('#action-modal').click(function(){
		$('#action-modal').hide();
	})
	$('#action-modal-banner').click(function(event){
		event.stopPropagation();
		location.href = '/action';
	})
 	$('#action-modal-close').click(function(event){
		event.stopPropagation();
		$('#action-modal').hide();
	})	
</script>
<!--
<script type="text/javascript">
    !function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?160",t.onload=function(){VK.Retargeting.Init("VK-RTRG-331640-fNIsX"),VK.Retargeting.Hit()},document.head.appendChild(t)}();
</script>
<noscript><img src="https://vk.com/rtrg?p=VK-RTRG-331640-fNIsX" style="position:fixed; left:-999px;" alt=""/></noscript>-->
<script src="https://feedbackcloud.kupiapp.ru/widget/widget.js" type="text/javascript"></script>
<script type="text/javascript">document.addEventListener("DOMContentLoaded", feedback_vk.init({id:'feedback_vk', gid:100017537}));</script>
</html>