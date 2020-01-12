<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Вход</li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Вход</h1>

	<div class="row">
		<div class="col-sm-6">
			<legend>Новый пользователь</legend>
			<p>Для продолжения работы Вам необходимо пройти регистрацию в личном кабинете</p>
			<a href="/sign-up" class="link">Зарегистрироваться в личном кабинете</a>
		</div>
		<div class="col-sm-6">
			<form id="sign-in-form" onsubmit="sendSignInData(); return false;">
				<legend>Вход в личный кабинет</legend>
				<div class="form-group" id="email">
					<label>Адрес email:</label>
					<input name="email" class="form-control" placeholder="Введите адрес электронной почты">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="password">
					<label>Пароль:</label>
					<input name="password" type="password" class="form-control" placeholder="Введите пароль">
					<span class="help-block"></span>
				</div>
				<div class="form-group">

					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember" value="1">
							Запомнить меня
						</label>
					</div>

				</div>

				<button type="submit" class="btn promo-button" data-loading-text="Выполняется вход ..."><i
						class="icon-signin"></i> Войти в личный кабинет
				</button>
			</form>
			<br/>
			Забыли пароль? Воспользуйтесь <a href="" class="link">формой восстановления доступа</a>
		</div>
	</div>


</div>

<script type="text/javascript">


	function sendSignInData() {

		$("span.help-block").html("");
		$(".has-error").removeClass("has-error");

		var data = $("#sign-in-form").serialize();

		var url = "<?php echo Yii::app()->createAbsoluteUrl("user/signInAjax"); ?>"

		$.ajax({
			type: 'POST',
			url: url,
			data: data,

			success: function (responseData) {

				var json = (eval("(" + responseData + ")"));

				if (json.code == 'ok') {
					console.log("success")
					console.log(json.data);
					window.location.replace("/");
				} else {
					console.log("failed")
					console.log(json.data);
					$.each(json.data, function (id, message) {
						$("#" + message.field_name).addClass("has-error");
						$("#" + message.field_name + " span.help-block").html(message.error);
					});
				}
			},
			error: function (responseData) {
				console.log(responseData);

			},

			dataType: 'html'
		});

	}


</script>
