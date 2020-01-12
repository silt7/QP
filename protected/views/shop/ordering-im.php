<?
//
// —крипт генерации формы дл¤ перехода на страницу оплаты товара или услуги через платужную систему IntellectMoney
//

/////////////////////////////////////////////////////////
// –егистрационные данные (не мен¤ютс¤ от платежа к платежу)
$eshopId = "17354";	


////////////////////////////////////////////////////////
// –еквизиты платежа

// номер платежа (до 150 символов)
$x = pow(10,6);
$orderId = mt_rand(0,$x); //от заказа к заказу значени¤ orderId должны различатьс¤

// назначение платежа (не более 255 символов)
$serviceName = "ќплата услуг по счету #" . $orderId; // указывайте действительное описание назначени¤ платежа

// сумма платежа (разделение суммы возможно как точкой '.' так и зап¤ной ',')
$recipientAmount = "1.99";

// валюта платежа (RUR или TST)
$recipientCurrency = "RUR";

/////////////////////////////////////////////////////////
// Ќ≈ ќЅя«ј“Ћ№Ќџ≈ параметры

// —сылка на страницу на вашем сайте, куда перейдет пользователь после успешной оплаты (¬ј∆Ќќ: не факт что проплата прошла)
$successUrl = 'http://ваш-сайт/success.php';


// —сылка на страницу на вашем сайте, куда перейдет пользователь если откажетс¤ от платежа
$failUrl = 'http://ваш-сайт/fail.php';

// ≈сли вам известно им¤ плательщика, можно его передать
$userName = '';

// ≈сли вам извесен E-mail пользовател¤ его можно передать
$userEmail = 'test@test.ru';//дл¤ примера передадим тестовый E-mail

// ƒополнительные переменные, которые нужно вернуть после возврата на сайт магазина
$userField_1 = 'userField1';
$userField_2 = 'userField2';
$userField_3 = 'userField3';

// форма дл¤ перехода на страницу оплаты товара
print "<form method='post' action='https://merchant.intellectmoney.ru/ru/' >".
	"<input id='orderId' type='hidden' value='$orderId' name='orderId'/>".
	"<input id='eshopId' type='hidden' value='$eshopId' name='eshopId'/>".
	"<input id='serviceName' type='hidden' value='$serviceName' name='serviceName'/>".
	"<input id='recipientAmount' type='hidden' value='$recipientAmount' name='recipientAmount'/>".
	"<input type='hidden' value='$recipientCurrency' name='recipientCurrency'/>".
	"<input type='hidden' value='$successUrl' name='successUrl'/>".
	"<input type='hidden' value='$failUrl' name='failUrl'/>".
	"<input id='userName' type='hidden' value='$userName' name='userName'/>".
	"<input id='userEmail' type='hidden' value='$userEmail' name='user_email'/>".
	"<input id='userField_1' type='hidden' value='$userField_1' name='userField_1'/>".
	"<input id='userField_2' type='hidden' value='$userField_2' name='userField_2'/>".
	"<input id='userField_3' type='hidden' value='$userField_3' name='userField_3'/>".
	"<input type=submit value='ќплатить' /><br/>".
	"</form>";
?>