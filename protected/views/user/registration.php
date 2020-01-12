<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Регистрация</li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Регистрация</h1>

	<form id="registration-form" onsubmit="sendRegistrationData();return false;">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group" id="first_name">
					<sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup>
					<label>Имя:</label>
					<input name="first_name" class="form-control" placeholder="Ваше имя">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="last_name">
					<sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup>
					<label>Фамилия:</label>
					<input name="last_name" class="form-control" placeholder="Ваша фамилия">
					<span class="help-block"></span>
				</div>

				<div class="form-group" id="email">
					<sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup>
					<label>Адрес email:</label>
					<input name="email" class="form-control" placeholder="Введите адрес электронной почты">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="password">
					<sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup>
					<label>Пароль:</label>
					<input name="password" type="password" class="form-control" placeholder="Введите пароль">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="password_confirm">
					<sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup>
					<label>Пароль:</label>
					<input name="password_confirm" type="password" class="form-control" placeholder="Повторите пароль">
					<span class="help-block"></span>
				</div>
				<p>Поля отмеченные знаком <sup>
						<small class="text-danger"><i class="fa fa-asterisk"></i></small>
					</sup> обязательны для заполнения
				</p>
				<button type="submit" class="btn promo-button" data-loading-text="Выполняется регистрация ..."><i
						class="icon-signin"></i> Регистрация
				</button>
				<p style="font-size:10px;">Нажимая «Регистрация», вы даёте согласие на обработку своих персональных данных в соответствии
                с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">


	function sendRegistrationData() {

		$("span.help-block").html("");
		$(".has-error").removeClass("has-error");

		var data = $("#registration-form").serialize();

		var url = "<?php echo Yii::app()->createAbsoluteUrl("user/signUpAjax"); ?>"

		$.ajax({
			type: 'POST',
			url: url,
			data: data,

			success: function (responseData) {

				var json = (eval("(" + responseData + ")"));

				if (json.code == 'ok') {
					console.log("success")
					console.log(json.data);
					window.location.replace("/sign-in");
				} else {
					console.log("failed")
					console.log(json.data);
					$.each(json.data, function (id, message) {
						$("#" + message.field_name).addClass("has-error");
						$("#" + message.field_name + " span.help-block").html(message.error);
					});


				}

				//$.each(messages, function (id, message) {});


			},
			error: function (responseData) {
				console.log(responseData);

			},

			dataType: 'html'
		});

	}


</script>