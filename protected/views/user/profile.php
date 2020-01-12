<? $user = $this->processOutput( $user ); ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li class="active">Профиль</li>
	</ol>
</div>
<div class="container">
	<h1 class="head">Обновление данных</h1>

	<form id="registration-form" onsubmit="sendRegistrationData();return false;">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group" id="first_name">

					<label>Имя:</label>
					<input name="first_name" class="form-control" placeholder="Ваше имя" value="<?= $user->first_name ?>">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="last_name">

					<label>Фамилия:</label>
					<input name="last_name" class="form-control" placeholder="Ваша фамилия" value="<?= $user->last_name ?>">
					<span class="help-block"></span>
				</div>

				<div class="form-group" id="email">

					<label>Адрес email:</label>
					<input name="email" class="form-control" placeholder="Введите адрес электронной почты" value="<?= $user->email ?>">
					<span class="help-block"></span>
				</div>
				<div class="form-group" id="password">

					<label>Пароль:</label>
					<input name="password" type="password" class="form-control" placeholder="(Без изменений)">
					<span class="help-block"></span>
				</div>


				<button type="submit" id="save-btn" class="btn promo-button" data-loading-text=""><i
						class="fa fa-floppy-o"></i> Сохранить
				</button>

				<div class="btn promo-button" style="display: none" id="save-success">
					<i class="fa fa-check"></i> Данные обновлены
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">


	function sendRegistrationData() {

		$("span.help-block").html("");
		$(".has-error").removeClass("has-error");

		var data = $("#registration-form").serialize();

		var url = "<?php echo Yii::app()->createAbsoluteUrl("user/update"); ?>"

		$.ajax({
			type: 'POST',
			url: url,
			data: data,

			success: function (responseData) {

				var json = (eval("(" + responseData + ")"));

				if (json.code == 'ok') {
					console.log("success")
					console.log(json.data);

					$("#save-btn").css({"display": "none"});
					$("#save-success").css({"display": "block"});


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
