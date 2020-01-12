<? $order = $this->processOutput( $order );
$items    = $order->getLinesToView();?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>
		<li><a href="/profile" class="link">Профиль</a></li>
		<li><a href="/profile/orders" class="link">Мои заказы</a></li>
		<li class="active"><?= $order->getTitle(); ?></li>
	</ol>
</div>


<div class="container qp_profile-orders">
	<h1 class="head"><?= $order->getTitle(); ?> | <?= Order::$statusArray[ $order->status ]["label"] ?></h1>


	<div class="qp_order-info">
		<div class="row">
			<div class="inner col-xs-12 col-sm-6">
				<div> Оформил : <?= $order->getUserLogin() ?> </div>

				<div> Заказчик : <?= $order->name ?> </div>

				<div> Email : <?= $order->email ?> </div>

				<div> Телефон : <?= $order->phone ?> </div>

				<div> Адрес : <?= $order->address ?> </div>

				<div> Комментарий : <?= $order->comment ?> </div>

				<div> Товаров : <?= $order->getTotalCount() ?> </div>

				<div> Общая сумма : <?= $order->getTotalPrice() ?> руб.</div>

				<div> Общая предоплата : <?= $order->getTotalPrePay() ?> руб.</div>
				<div> Статус : <?= Order::$statusArray[ $order->status ]["label"] ?> </div>
			</div>
		</div>
	</div>

	<h3><a id="Table_link" style="border: 1px solid blue; padding: 5px; display:none;">Таблица для печати</a></h3>
	<div id="PrintTable" >
		<table class="printTable">
			<thead>
				<td>Товары</td>
				<td>Кол-во</td>
				<td>Цена</td>
				<td>Предоплата</td>
				<td>Стоимость</td>
			</thead>

			<? foreach ( $items as $itemCollection ): ?>
				<? $sectionTotalPrice = 0; ?>
				<? foreach ( $itemCollection["items"] as $orderLine ): ?>
				<tr>
					
						<td>
								<b><?= $orderLine->item_title ?></b><br>
								
								<? if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["module_color_id"]); echo "Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title']; ?>
									<?$options = unserialize($orderLine["options"]);?>
									<? if ($options["mod_front_color_id"] > -1 ){ ?>
										<? 	$title_color_f = Color::model()->findByPk($options["mod_front_color_id"]);
											echo "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title']; ?>
									<? } else{
										echo "<br>Фасад: Без фасада.";
									} ?>
								<? endif;
								if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["front_color_id"]); echo $title_color['title']." (".$title_color->getMaterialLabel().")"; ?>
								<? endif;
								if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ): ?>
									<!--<img src="/images/colors/<?//= $itemCollection["cover_color_id"]; ?>.png" style="width:15px; height:15px;">-->
									<? $title_color = Color::model()->findByPk($itemCollection["cover_color_id"]); echo $title_color['title']; ?>
								<? endif; ?>
							
								<? foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ): ?>
									<div><?= $option["title"] ?></div>
								<? endforeach; ?>
								<?= isset( $itemCollection["cover_width"] ) ? "<div>Ширина : " . $itemCollection["cover_width"] . " мм</div>" : "" ?>
								<?= isset( $itemCollection["cover_length"] ) ? "<div>Длина : " . $itemCollection["cover_length"] . " мм</div>" : "" ?>
											
						</td>
						<td>
							<?= $orderLine->quantity ?> шт.
						</td>
						<td>
							<?= Utils::priceFormat( $orderLine->price ) ?> руб.
						</td>
						<td>
							<?= Utils::priceFormat( $orderLine->quantity * $orderLine->pre_pay ) ?> руб.
						</td>
						<td>
							<?$sectionTotalPrice += $orderLine->quantity * $orderLine->price;?>
							<?= Utils::priceFormat( $orderLine->quantity * $orderLine->price ) ?> руб.
						</td>
					
				</tr>
				<?endforeach?>
			<?endforeach?>
			<tr>
				<td >Итого</td>
				<td colspan="2"><?= $order->getTotalCount() ?> шт.</td>
				<td><?= Utils::priceFormat( $order->getTotalPrePay() ) ?> руб.</td>
				<td><?= Utils::priceFormat( $order->getTotalPrice() ) ?> руб.</td>
				
			</tr>
		</table>
	</div>
	<div class="container shopping-cart" style="display:none;">


		<div class="row title-row">
			<div class="col-md-1">
				Цвета
			</div>
			<div class="col-md-11">
				<div class="row">
					<div class="col-md-4">
						Товары
					</div>
					<div class="col-md-3">
						<div class="col-md-6">
							кол-во
						</div>
						<div class="col-md-6">
							цена
						</div>
					</div>
					<div class="col-md-2">
						предоплата
					</div>
					<div class="col-md-2">
						стоимость
					</div>

				</div>
			</div>
		</div>

		<div class="row total-price">
			<div class="col-md-1">
				Итого
			</div>
			<div class="col-md-11">
				<div class="row">
					<div class="col-md-4">

					</div>
					<div class="col-md-3">
						<div class="col-md-6">
							<center><?= $order->getTotalCount() ?> шт</center>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					<div class="col-md-2">
						<?= Utils::priceFormat( $order->getTotalPrePay() ) ?> руб.

					</div>
					<div class="col-md-3">
						<?= Utils::priceFormat( $order->getTotalPrice() ) ?> руб.
					</div>

				</div>
			</div>


		</div>

		<? foreach ( $items as $itemCollection ): ?>

			<? $sectionTotalPrice = 0; ?>


			<div class="row">
				<div class="col-md-1 colors-col">
					<? if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ): ?>
						<img src="/images/colors/<?= $itemCollection["module_color_id"] ?>.png">
					<? endif;
					if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ): ?>
						<img src="/images/colors/<?= $itemCollection["front_color_id"] ?>.png">
					<? endif;
					if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ): ?>
						<img src="/images/colors/<?= $itemCollection["cover_color_id"] ?>.png">
					<? endif; ?>
				</div>
				<div class="col-md-11">

					<? foreach ( $itemCollection["items"] as $orderLine ): ?>

						<div class="row item">
							<div class="col-md-4">
								<b><?= $orderLine->item_title ?></b><br>
								
								<? if ( isset( $itemCollection["module_color_id"] ) && ! is_null( $itemCollection["module_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["module_color_id"]); echo "Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title']; ?>
									<?$options = unserialize($orderLine["options"]);?>
									<? if ($options["mod_front_color_id"] > -1 ){ ?>
										<? 	$title_color_f = Color::model()->findByPk($options["mod_front_color_id"]);
											echo "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title']; ?>
									<? } else{
										echo "<br>Фасад: Без фасада.";
									} ?>
								<? endif;
								if ( isset( $itemCollection["front_color_id"] ) && ! is_null( $itemCollection["front_color_id"] ) ): ?>
									<? $title_color = Color::model()->findByPk($itemCollection["front_color_id"]); echo $title_color['title']." (".$title_color->getMaterialLabel().")"; ?>
								<? endif;
								if ( isset( $itemCollection["cover_color_id"] ) && ! is_null( $itemCollection["cover_color_id"] ) ): ?>
									<!--<img src="/images/colors/<?//= $itemCollection["cover_color_id"]; ?>.png" style="width:15px; height:15px;">-->
									<? $title_color = Color::model()->findByPk($itemCollection["cover_color_id"]); echo $title_color['title']; ?>
								<? endif; ?>
							
								<? foreach ( $itemCollection[ $orderLine->id ]["options_checked"] as $option ): ?>
									<div><?= $option["title"] ?></div>
								<? endforeach; ?>
								<?= isset( $itemCollection["cover_width"] ) ? "<div>Ширина : " . $itemCollection["cover_width"] . " мм</div>" : "" ?>
								<?= isset( $itemCollection["cover_length"] ) ? "<div>Длина : " . $itemCollection["cover_length"] . " мм</div>" : "" ?>
							
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<input type="text" disabled name="quantity_<?= $orderLine->id ?>" class="form-control" value="<?= $orderLine->quantity ?>"
											       placeholder="0"
											       aria-describedby="count-1">
											<span class="input-group-addon" id="count-1">шт</span>
										</div>
									</div>
									<div class="col-md-6 price">

										<?= Utils::priceFormat( $orderLine->price ) ?> руб.
									</div>

								</div>
							</div>
							<div class="col-md-2 total-price">
								<?= Utils::priceFormat( $orderLine->quantity * $orderLine->pre_pay ) ?> руб.
							</div>
							<div class="col-md-3 total-price">
								<?
								$sectionTotalPrice += $orderLine->quantity * $orderLine->price;

								?>

								<?= Utils::priceFormat( $orderLine->quantity * $orderLine->price ) ?> руб.
							</div>
						</div>


					<? endforeach; ?>


				</div>
			</div>


		<? endforeach; ?>
		<? if(Order::$statusArray[ $order->status ]["label"] != "Оплачен" && Order::$statusArray[ $order->status ]["label"] != 'Ожидает завершения оплаты' && ($order->getTotalPrePay()>=10)): ?><div class="row"><div class="qp_item-buy-btn oplatit"><a href="#buy">Оплатить</a></div></div> <? endif; ?>
	</div>
    
</div>

<?
$successUrl = 'orders.php';
/*
// —крипт генерации формы дл¤ перехода на страницу оплаты товара или услуги через платужную систему IntellectMoney
//

/////////////////////////////////////////////////////////
// –егистрационные данные (не мен¤ютс¤ от платежа к платежу)
$eshopId = "454412";	


////////////////////////////////////////////////////////
// –еквизиты платежа

// номер платежа (до 150 символов)
$orderId = $order->id; //от заказа к заказу значени¤ orderId должны различатьс¤

// назначение платежа (не более 255 символов)
$serviceName = "Оплата услуг по счету QP-" . $orderId; // указывайте действительное описание назначени¤ платежа

// сумма платежа (разделение суммы возможно как точкой '.' так и зап¤ной ',')
$recipientAmount = $order->getTotalPrePay();
// валюта платежа (RUR или TST)
$recipientCurrency = "RUR";
//$recipientCurrency = "TST";

/////////////////////////////////////////////////////////
// Ќ≈ ќЅя«ј“Ћ№Ќџ≈ параметры

// —сылка на страницу на вашем сайте, куда перейдет пользователь после успешной оплаты (¬ј∆Ќќ: не факт что проплата прошла)
$successUrl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


// —сылка на страницу на вашем сайте, куда перейдет пользователь если откажетс¤ от платежа
$failUrl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

// ≈сли вам известно им¤ плательщика, можно его передать
$userName =  preg_replace('/[^A-Za-zА-ЯЁа-яё ]+/iu', '', $order->name);

// ≈сли вам извесен E-mail пользовател¤ его можно передать
$userEmail = substr($order->email,0,strlen($order->email)-2);

// ƒополнительные переменные, которые нужно вернуть после возврата на сайт магазина
$userField_1 = $order->getUserLogin();
$userField_2 = $order->user_id; 
$userField_3 = 'userField3';

// форма дл¤ перехода на страницу оплаты товара
print "<form id='intellectmoney' class='hidden' method='post' action='https://merchant.intellectmoney.ru/ru/' >".
	"<input id='orderId' type='hidden' value='$orderId' name='orderId'/>".
	"<input id='eshopId' type='hidden' value='$eshopId' name='eshopId'/>".
	"<input id='serviceName' type='hidden' value='$serviceName' name='serviceName'/>".
	"<input id='recipientAmount' type='hidden' value='$recipientAmount' name='recipientAmount'/>".
	"<input type='hidden' value='$recipientCurrency' name='recipientCurrency'/>".
	"<input type='hidden' value='$successUrl' name='successUrl'/>".
	"<input type='hidden' value='$failUrl' name='failUrl'/>".
	"<input id='userName' type='hidden' value='$userName' name='userName'/>".
	
	"<input id='userField_1' type='hidden' value='$userField_1' name='userField_1'/>".
	"<input id='userField_2' type='hidden' value='$userField_2' name='userField_2'/>".
	//"<input id='userField_3' type='hidden' value='$userField_3' name='userField_3'/>".
	"<input id='user_email' type='hidden' value='$userEmail' name='user_email'/>".
	"<input type=submit value='ќплатить' /><br/>".
	"</form>";
*/
?>
<script type="text/javascript">
$(document).ready(function(){
    $('a[href=#buy]').click(function(){
        $("#intellectmoney").submit();
		alert("Оплата временно недоступна!");
        return false;
    })
	$('#Table_link').click(function(){
		if((typeof i == 'undefined')||(i == "hide")){
			$("#PrintTable").show();
			i = "show";
			stopPropagation();
		}
		if(i=="show"){
			$("#PrintTable").hide();
			i = "hide";
			stopPropagation();
		}
    })
	
});

</script>