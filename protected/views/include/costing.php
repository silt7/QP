<form role="form" action="/files/mail/mail.php" method="POST" id="call-form">
	<div class="form-group">
		<label for="exampleInputEmail1"><span class="text-danger">*</span> Имя</label>
		<input type="text" class="form-control" name="name" placeholder="Ваше имя" required>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1" ><span class="text-danger">*</span> Телефон:</label>
		<input type="text" class="form-control" name="phone" id="exampleInputPassword1"
			   placeholder="Ваш контактный телефон" required pattern="|^\d+$|" minlength="4" maxlength="12">
	</div>
	<div style="display:table;">
		<label for="calculate-price-popup-size-h"><span class="text-danger"></span>Вид кухни:</label>                             
		<div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" >
				<i class="fa fa-sliders" ></i>&nbsp Вид кухни<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li>
					<input type="radio" hidden="hidden" value="Классические" id="type_kichen_1" name="type_kichen">
					<label for="type_kichen_1">Классические</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Современные" id="type_kichen_2"  name="type_kichen">
					<label for="type_kichen_2">Современные</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Угловые" id="type_kichen_3"  name="type_kichen">
					<label for="type_kichen_3">Угловые</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Прямые" id="type_kichen_4"  name="type_kichen">
					<label for="type_kichen_4">Прямые</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Премиум" id="type_kichen_5"  name="type_kichen">
					<label for="type_kichen_5">Премиум</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Недорогие" id="type_kichen_6"  name="type_kichen">
					<label for="type_kichen_6">Недорогие</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Маленькие" id="type_kichen_7"  name="type_kichen">
					<label for="type_kichen_7">Маленькие</label>
				</li>
				<li>
					<input type="radio" hidden="hidden" value="Большие" id="type_kichen_8"  name="type_kichen">
					<label for="type_kichen_8">Большие</label>
				</li>			
			</ul>
		</div>
	</div><br>
	<div class="form-group">
		<label for="exampleInputPassword1">Комментарий:</label>
		<textarea class="form-control" name="comment" placeholder="Ваш комментарий к звонку"></textarea>
	</div>
	<button class="btn promo-button">Отправить</button>
</form>
<p style="font-size:10px; text-align: left;">Нажимая «Отправить», вы даёте согласие на обработку своих персональных данных в соответствии
			с Федеральным законом №152-ФЗ «О персональных данных» и принимаете <a href="/soglasie.html">условия</a></p>