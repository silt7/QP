<!--<div class="modal" id="calculate-price-modal(old)" tabindex="-1" role="dialog" aria-labelledby="Заявка на рассчет стоимости" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Закрыть</span></button>
                <p class="modal-title h4" id="myModalLabel2">Заявка на БЕСПЛАТНЫЙ рассчет стоимости</p>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <form role="form" action="/site/sendCalculatePrice" method="post" id="calculatePrice-old" enctype="multipart/form-data">
                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="calculate-price-popup-name"><span class="text-danger">*</span> Имя</label>
                                        <input type="text" name="calculate_price_popup_name" class="form-control"
                                               id="calculate-price-popup-name"
                                               placeholder="Ваше имя"
											   onkeyup="this.value=this.value.replace(/\s+/gi,'')">
                                    </div>
                                    <div class="form-group">
                                        <label for="calculate-price-popup-phone"><span class="text-danger">*</span> Телефон:</label>
                                        <input type="text" class="form-control" id="calculate-price-popup-phone"
                                               name="calculate_price_popup_phone" placeholder="Ваш контактный телефон">
                                    </div>

                                    <div class="form-group">
                                        <label for="calculate-price-popup-email"><span class="text-danger">*</span> Email:</label>
                                        <input type="email" class="form-control" id="calculate-price-popup-email"
                                               name="calculate_price_popup_email" placeholder="Ваш контактный email">
                                    </div>
                                </div>
                            </div>

                            <div class="panel" style="margin-bottom: 1px;">
                                <div class="panel-body">

                                    <label style="font-size:18px;">Основные параметры кухни:</label>

                                    <div class="form-group">
                                        <label for="calculate-price-popup-configuration">
                                            <span class="text-danger"></span> Конфигурация кухни</label>

                                        <div class="row" style="margin-right: 0px;margin-left: 0px;">
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="Прямая">
                            					<span><!--<div class="c-check"><i class="fa fa-check"></i></div>----
                            					Прямая</span>
                                            </div>
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="Угловая">
                                                <span>Угловая</span>
                                            </div>
                                            <div class="col-md-4 col-xs-6 configuration-type">
                                                <input type="radio" name="calculate_price_popup_configuration_type" value="П-образная">
                                                <span>П-образная</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <table class="table-group-calc">
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-a"><span class="text-danger"></span> Размер a:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-a"
                                                           name="calculate_price_popup_size_a" placeholder="Размер a">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-b"><span class="text-danger"></span> Размер b:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-b"
                                                           name="calculate_price_popup_size_b" placeholder="Размер b">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-c"><span class="text-danger"></span> Размер c:</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="calculate-price-popup-size-c"
                                                           name="calculate_price_popup_size_c" placeholder="Размер c">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span>Материал фасадов:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders" ></i>Материал фасадов<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Пластик" id="front_bottom_color_1" name="front_bottom_color">
                                                                <label for="front_bottom_color_1">Пластик</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="МДФ" id="front_bottom_color_2"  name="front_bottom_color">
                                                                <label for="front_bottom_color_2">МДФ</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Шпон" id="front_bottom_color_3"  name="front_bottom_color">
                                                                <label for="front_bottom_color_3">Шпон</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Акрил" id="front_bottom_color_4"  name="front_bottom_color">
                                                                <label for="front_bottom_color_4">Акрил</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" hidden="hidden" value="Другой" id="front_bottom_color_5"  name="front_bottom_color">
                                                                <label for="front_bottom_color_5">Другой</label>
                                                            </li>                                                           
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
											<tr>
                                                <td>
                                                    <label for="calculate-price-popup-size-h"><span class="text-danger"></span> Фурнитура:</label>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                                            <i class="fa fa-sliders" ></i> Фурнитура<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <input type="radio" id="ex2_2_1" name="calculate_price_popup_size_h" value="Обычная">
                                                                <label for="ex2_2_1">Обычная</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" id="ex2_2_2" name="calculate_price_popup_size_h" value="С доводчиком">
                                                                <label for="ex2_2_2">С доводчиком</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
									<div class="form-group">
                                        <input type="file" name="img1" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"><br>
                                        <input type="file" name="img2" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"><br>
                                        <input type="file" name="img3" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="calculate-popup-comment">Комментарий:</label>
                                        <textarea class="form-control" id="calculate-popup-comment"   name="calculate_popup_comment" placeholder="Ваш комментарий к заказу"></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn promo-button">Заказать рассчет стоимости</button>
                            <p style="font-size:10px;">Нажимая «Заказать рассчет стоимости», вы даёте согласие на обработку своих персональных данных в соответствии
                            с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
                    заполнения</p>
            </div>
        </div>
    </div>
</div>
-->

<div class="modal" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="заказать звонок" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="myModalLabel">ОСТАВИТЬ ОТЗЫВ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="width:90%; margin: 0 auto;">
                        <form role="form" action="add/review" method="POST" id="call-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><span class="text-danger">*</span> Имя</label>
                                <input type="text" class="form-control" name="name" placeholder="Ваше имя" 
								onkeyup="this.value=this.value.replace(/\s+/gi,'')">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Отзыв:</label>
                                <textarea class="form-control" name="review" placeholder="Отзыв"></textarea>
                            </div>
                            <label for="exampleInputPassword1">Картинки:</label>
                            <p id = "p1" ><input id = "img1" type="file" name="image1" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg"></p>
                            <p id = "p2" style="display:none;"><input id = "img2" type="file" name="image2" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p3" style="display:none;"><input id = "img3"  type="file" name="image3" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p4" style="display:none;"><input id = "img4" type="file" name="image4" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <p id = "p5" style="display:none;"><input  id = "img5" type="file" name="image5" class="filestyle" data-buttonText="&nbsp Добавить изображение" accept="image/png,image/jpeg" ></p>
                            <div style="width: 100%; height: 30px;"><span id="label_sch" style="display: none;">1</span><span id="label_img"></span><a style="float: right; cursor:pointer;" id="linkImg">Добавить ещё изображения</a></div>
                            <button class="btn promo-button"  id="btn_rev">ОСТАВИТЬ ОТЗЫВ</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
                    заполнения</p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="designer-modal" tabindex="-1" role="dialog" aria-labelledby="Вызов дизайнера" aria-hidden="true">
	<div id="content">
	<div id="calculate" style="background: transparent;">
		<div class="container">
			<div class="row div-form" style="padding: 15px; background-color:#fff;">
				<div data-dismiss="modal" class="closeModal" style="float: right; margin-right:20px; font-size: 26px; cursor: pointer;"><span aria-hidden="true">&times;</span><span
					class="sr-only">Закрыть</span></div>
				<!--<p class="h2">Остались вопросы?</p>-->
				<p class="text" style="font-size:27px; margin-top: 1%;text-align:center;">Заявка на вызов дизайнера</p>

				<form action="/site/SendDesigner" method="post" enctype="multipart/form-data" id="call-designer">
					<div class="row div-form" style="border:none;padding:0 50px;background-color:#fff;">
						<div class="col-lg-6">
							<img src="/images/main/measure.png" style="margin-bottom:17px"/><br>
							<p class="div-form-title">Вызвать дизайнера-замерщика</p><span class="div-form-arrow"></span><span class="div-form-block">100% точность проекта</span>
							<p class="div-form-text">Менеджер свяжется с Вами&nbsp;с 10:00 до 20:00</p>
							<p class="div-form-text">Услуга Бесплатная (в пределах КАД) при заказе кухни.<br>
							Выезд за пределы КАД оплачивается отдельно:<br>
							каждые 50 км - 500 руб.
							</p>
						</div>
						<div class="col-lg-6">
							<input type="hidden" name="pageURL" value="https://qp-kuhni.ru<?= Yii::app()->request->requestUri;?>">
							<div class="col-lg-12"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
							<div class="col-lg-12"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон"></div>
							<div class="col-lg-12"><input type="text" name="calculate_price_popup_address" placeholder="Адрес"></div>
							<div class="col-lg-12"><input type="text" name="calculate_price_popup_time" placeholder="Удобное время"></div>
							<div class="col-lg-12">
								<div class="policy">Нажимая «Получить рассчет стоимости», вы даёте согласие на обработку своих 
								персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
								и принимаете <a href="#">условия</a></div>
								<button style="margin-top:20px" onclick="yaCounter31370493.reachGoal('free-design');">Заказать вызов дизайнера<img src="/images/main/btn_cost.svg" style="margin-left:15px"/></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>

<style>
	#calculate-price-modal .h2{margin-bottom: 25px !important;font-size:27px;}
	#calculate-price-modal label,#calculate-price-modal input,#calculate-price-modal select{font-size:14px; height:30px}
	#calculate-price-popup-size-a,#calculate-price-popup-size-b,#calculate-price-popup-size-c{padding:0}
	#calculate-price-modal select{padding:0 25px}
	#calculate-price-modal hr{margin-top: 25px;margin-bottom: 25px;}
	#calculate-price-modal .file-upload{height:30px; margin-top: 18px;}
	#calculate-price-modal .file-upload span{font-size:14px; line-height:30px}
	#calculate-container {width:900px;}
	@media only screen and (max-width: 900px){
		#calculate-container {width:100%}
		#calculate-price-modal label, #calculate-price-modal input, #calculate-price-modal select {width:95%}
	}
</style>
<div class="modal" id="calculate-price-modal" tabindex="-1" role="dialog" aria-labelledby="Заявка на рассчет стоимости" aria-hidden="true">
	<div id="content">
	<div id="calculate" style="background: transparent;">
        <div class="container" id="calculate-container">
        	<form action="/site/sendCalculatePrice" method="post" enctype="multipart/form-data" id="calculatePrice">
    	        <input type="hidden" name="question" value="y">
				<input type="hidden" name="pageURL" value="https://qp-kuhni.ru<?= Yii::app()->request->requestUri;?>">
    	        <div class="row div-form" style="position: relative; background-color: #fff; padding: 15px 68px; margin: 105px 0px">
					<div data-dismiss="modal" class="closeModal" style="position:absolute; right: 35px; font-size: 26px; cursor: pointer;"><span aria-hidden="true">&times;</span><span
					class="sr-only">Закрыть</span></div>
    	            <p class="h2">Рассчитайте стоимость кухни бесплатно</p>
    	            <div class="row">
    	                 <div class="col-md-7">
    	                 	<p>Выберите конфигурацию кухни:</p>
    	                    <div class="row row-config">
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v1" name="calculate_price_popup_configuration_type" type="radio" value="Прямая"><label for="v1"><img src="/images/main/configure_1.svg" />Прямая</label></div>
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v2" name="calculate_price_popup_configuration_type" type="radio" value="Угловая"><label for="v2"><img src="/images/main/configure_2.svg" width="30%"/>Угловая</label></div>
    	                        <div class="col-lg-4 nopadding configuration-type"><input id="v3" name="calculate_price_popup_configuration_type" type="radio" value="П-образная"><label for="v3"><img src="/images/main/configure_3.svg" width="30%" style="margin-right: 10px;"/>П-образная</label></div>
    	                    </div>
    	                    <p>Выберите материал фасада и тип фурнитуры:</p>
    	                    <div class="row justify-content-between row-type">
    	                        <div class="col-md-6">
    	                        	<select name="front_bottom_color">
    							    <option selected disabled>Материал фасадов</option>
    							    <option value="Пластик">Пластик</option>
    							    <option value="МДФ">МДФ</option>
    							    <option value="Шпон">Шпон</option>
    							    <option value="Акрил">Акрил</option>
    							    <option value="Другой">Другой</option>
    							   </select>
    							</div>
    	                        <div class="col-md-6">
    	                        	<select name="calculate_price_popup_size_h">
    							    <option selected disabled>Тип фурнитуры</option>
    							    <option value="Обычная">Обычная</option>
    							    <option value="С доводчиком">С доводчиком</option>
    							    </select>
    							</div>
    	                    </div>
    	                 </div>
    	                 <div class="col-md-5">
    	                      <div class="row row-size">
    	                          <p>Укажите размер мебели в метрах:</p>
    	                          <div class="col-md-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-a" name="calculate_price_popup_size_a" placeholder="Размер a">
    	                          </div>
    	                          <div class="col-md-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-b" name="calculate_price_popup_size_b" placeholder="Размер b">
    	                          </div>
    	                          <div class="col-md-4 nopadding">
    	                              <input type="text" class="form-control" id="calculate-price-popup-size-c" name="calculate_price_popup_size_c" placeholder="Размер c">
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
    	            <div class="row" >
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_name" placeholder="Ваше имя"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input type="text" name="calculate_price_popup_email" placeholder="Ваш E-mail"onkeyup="this.value=this.value.replace(/\s+/gi,'')"></div>
    	                <div class="col-lg-4"><input id="phoneF" type="tel" name="calculate_price_popup_phone" placeholder="Ваш телефон"></div>
    	            </div>
    	            <div class="row">
    	            	<div class="col-lg-12">
    		                <textarea name="text" placeholder="Комментарий" style="font-size:14px"></textarea>
    		                <div class="policy" style="font-size:14px">Нажимая «Получить рассчет стоимости», вы даёте согласие на обработку своих 
    		                персональных данных в соответствии с Федеральным законом №152-ФЗ «О персональных данных» 
    		                и принимаете <a href="#">условия</a></div>
    		                <button style="margin-top:15px" onclick="yaCounter31370493.reachGoal('free-payment');">Получить расчет стоимости<img src="/images/main/btn_cost.svg" style="margin-left:15px"/></button>
    	            	</div>
    	            </div>
    	        </div>
        	</form>
        </div>
    </div>
	</div>
</div>
<!--
<div class="modal" id="designer-modal" tabindex="-1" role="dialog" aria-labelledby="Вызов дизайнера" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Закрыть</span></button>
				<p class="modal-title h4" id="myModalLabel1">Бесплатный вызов дизайнера</p>
			</div>
			<div class="modal-body">
				<div class="row">
                    <div class="col-sm-6">
						<blockquote>
						<p><u><strong><span style="font-size:18px">Информация</span></strong></u></p>

						<p><span style="font-size:14px">Менеджер свяжется с Вами&nbsp;с 10:00 до 21:00</span></p>

						<p><span style="font-size:14px">В услуги дизайнера входит:</span></p>

						<ul>
							<li><span style="font-size:14px">замер помещения;</span></li>
							<li><span style="font-size:14px">компьютерное проектирование&nbsp;3D-дизайн макета;</span></li>
							<li><span style="font-size:14px">профессиональная консультация;</span></li>
							<li><span style="font-size:14px">предоставление образцов материалов и подбор цветовых решений;</span></li>
							<li><span style="font-size:14px">расчет стоимости;</span></li>
							<li><span style="font-size:14px">оформеление договора.</span></li>
						</ul>

						<p><span style="font-size:14px">Выезд дизайнера <strong>БЕСПЛАТНЫЙ</strong> (в пределах КАД)&nbsp;при заказе кухни. Цена останется такой же, как и при самостоятельном оформлении в интернет-магазине.</span></p>

						<p><span style="font-size:14px">Без оформления заказа&nbsp;выезд дизайнера (в пределах КАД) стоит 500 руб.<br>
						Выезд за пределы КАДа оплачивается отдельно: каждые 50&nbsp;км - 500 руб.</span></p>
						</blockquote>
					</div>
					<div class="col-sm-6">
						<form role="form" action="/site/sendDesigner" method="post" id="designer">
							<div class="form-group">
								<label for="designer-popup-name"><span class="text-danger">*</span> Имя</label>
								<input type="text" name="designer_popup_name" class="form-control" id="designer-popup-name"
								       placeholder="Ваше имя"
									   onkeyup="this.value=this.value.replace(/\s+/gi,'')">
							</div>

							<div class="form-group">
								<label for="designer-popup-phone"><span class="text-danger">*</span> Телефон:</label>
								<input type="text" class="form-control" id="designer-popup-phone"
								       name="designer_popup_phone" placeholder="Ваш контактный телефон">
							</div>
							<div class="form-group">
								<label for="designer-popup-address">Ваш адрес:</label>
								<input type="text" class="form-control" id="designer-popup-address"
								       name="designer_popup_address" placeholder="Ваш адрес">
							</div>
							<div class="form-group">
								<label for="designer-popup-time"> Удобное время:</label>
								<input type="text" class="form-control" id="designer-popup-time"
								       name="designer_popup_time" placeholder="Удобное время">
							</div>
							<div class="form-group">
								<label for="designer-popup-comment">Комментарий:</label>
								<textarea class="form-control" id="designer-popup-comment"
								          name="designer_popup_comment" placeholder="Ваш комментарий к звонку"></textarea>
							</div>
							<button type="submit" class="btn promo-button">Заказать вызов дизайнера</button>
						</form>
						<p style="font-size:10px;">Нажимая «Заказать вызов дизайнера», вы даёте согласие на обработку своих персональных данных в соответствии
                        с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<p class="pull-left">Поля отмеченные знаком <span class="text-danger">*</span> обязательны для
					заполнения</p>
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
-->
<script type="text/javascript">
	$(".configuration-type").click(function () {
		var thisBlock = $(this);
		$(".configuration-type-selected").removeClass("configuration-type-selected")
		thisBlock.addClass("configuration-type-selected");
		thisBlock.find("input").prop("checked", true);
	});
</script>