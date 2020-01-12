<?php
	require_once "../../protected/models/Mail.php";
/*     $to      ='info@qp-kuhni.ru';
    $subject = 'Заказан звонок';
    $comment = ' || Комментарий: '.$_POST['comment'];
    if($_GET['subject']=='design') $subject = 'Вызов дизайнера';
    $message = 'Имя: '.$_POST['name'].' || Телефон: '.$_POST['phone']. str_replace('\r\n',"\r\n",$comment);
    $headers = 'From: info@qp-kuhni.ru' . "\r\n" .
        'Reply-To: info@qp-kuhni.ru' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers); */
	$subject = 'Обратный звонок';
    $comment = ' || Комментарий: '.$_POST['comment'];
    if($_POST['type-modal']=='design') $subject = 'Вызов дизайнера';
    $message = 'Имя: '.$_POST['name'];
	if(isset($_POST['type_kichen'])){
		$message .= ' || Тип кухни: '.$_POST['type_kichen'];
	}
	$message .= ' || Телефон: '.$_POST['phone']. str_replace('\r\n',"\r\n",$comment);
	$message .= '|| URL: '.$_POST['pageURL'];
	$mail_to = "info@qp-kuhni.ru";//info@qp-kuhni.ru
	$message = $message;


	$mail = new Mail( "utf-8" );
	$mail->From( "QP;info@qp-kuhni.ru" );
	$mail->To( $mail_to );
	$mail->Subject( $subject );
	$mail->Body( $message );
	$mail->Priority( 3 );
	$mail->smtp_on( "ssl://smtp.yandex.ru", "info@qp-kuhni.ru", "ltkfq500kuhni", 465 );
	if($_POST['name'] != ''){
	    $mail->Send();
	}
	/*if(isset($_POST['question'])){
	    echo '<script type="text/javascript">alert("Сообщение отправлено!");</script>';
	}
    echo '<script type="text/javascript">history.go(-1);</script>';*/
?>