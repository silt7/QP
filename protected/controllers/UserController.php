<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.models.User' );
Yii::import( 'application.models.UserIdentity' );


class UserController extends Controller {

	/**
	 * Регистрация
	 */
	public function actionSignUp() {
		$this->setLayout();

		$this->pageTitle = "Регистрация";
		$this->render( 'registration' );
	}

	/**
	 * Регистрация - ajax действие
	 */
	public function actionSignUpAjax() {

		$firstName       = isset( $_POST["first_name"] ) ? $_POST["first_name"] : null;
		$lastName        = isset( $_POST["last_name"] ) ? $_POST["last_name"] : null;
		$email           = isset( $_POST["email"] ) ? $_POST["email"] : null;
		$password        = isset( $_POST["password"] ) ? $_POST["password"] : null;
		$passwordConfirm = isset( $_POST["password_confirm"] ) ? $_POST["password_confirm"] : null;

		$messageData = array();
		$isErrors    = false;

		if ( $firstName == null ) {
			array_push( $messageData, array( "field_name" => "first_name", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $lastName == null ) {
			array_push( $messageData, array( "field_name" => "last_name", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $email == null ) {
			array_push( $messageData, array( "field_name" => "email", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		} else {

			$criteria            = new CDbCriteria;
			$criteria->select    = 'email'; // only select the 'title' column
			$criteria->condition = 'email=:email';
			$criteria->params    = array( ':email' => $email );


			$userModel = User::model()->find( $criteria );
			if ( $userModel != null ) {
				array_push( $messageData, array(
					"field_name" => "email",
					"error"      => "Пользователь с таким email существует"
				) );
				$isErrors = true;
			}
		}

		if ( $password == null ) {
			array_push( $messageData, array( "field_name" => "password", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		} elseif ( strlen( $password ) < 6 ) {
			array_push( $messageData, array(
				"field_name" => "password",
				"error"      => "Пароль должен быть длиннее 6 символов"
			) );
			$isErrors = true;
		}

		if ( $passwordConfirm == null ) {
			array_push( $messageData, array(
				"field_name" => "password_confirm",
				"error"      => "Поле должно быть заполнено"
			) );
			$isErrors = true;
		}

		if ( ! $isErrors and $password != $passwordConfirm ) {
			array_push( $messageData, array(
				"field_name" => "password_confirm",
				"error"      => "Пароль и подтверждение должны совпадать"
			) );
			$isErrors = true;
		}

		if ( ! $isErrors ) {

			$user             = new User();
			$user->email      = $email;
			$user->first_name = $firstName;
			$user->last_name  = $lastName;
			$user->role       = "base_user";
			$user->setPassword( $password );
			$user->save();
			echo $this->messageJsonOk( "Успешная регистрация" );

		} else {
			echo $this->messageJsonError( $messageData );
		}


	}

	/**
	 * Вход
	 */
	public function actionSignIn() {
		$this->pageTitle = "Вход";
		$this->render( 'sign-in' );
	}

	/**
	 * Вход ajax
	 */
	public function actionSignInAjax() {

		$session = new CHttpSession;

		$session->open();
		$this->sessionUser = new SessionUser( $session );
		$shoppingCartId           = $this->sessionUser->get( "shopping_cart_id" );


		$email    = isset( $_POST["email"] ) ? $_POST["email"] : null;
		$password = isset( $_POST["password"] ) ? $_POST["password"] : null;

		$isErrors    = false;
		$messageData = array();

		if ( $email == null ) {
			array_push( $messageData, array( "field_name" => "email", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $password == null ) {
			array_push( $messageData, array( "field_name" => "password", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( ! $isErrors ) {
			$identity = new UserIdentity( $email, $password );
			if ( $identity->authenticate() ) {
				Yii::app()->user->login( $identity, 3600 * 24 * 7 );

				$criteria = new CDbCriteria;
				//$criteria->select    = 'email'; // only select the 'title' column
				$criteria->condition = 'email=:email';
				$criteria->params    = array( ':email' => $email );

				$userModel = User::model()->find( $criteria );
				$userModel->setSignIn();

				$this->sessionUser = new SessionUser( $session );
				$this->sessionUser->put( "shopping_cart_id", $shoppingCartId, true );
				echo $this->messageJsonOk( "success" );
			} else {
				array_push( $messageData, array(
					"field_name" => "password",
					"error"      => "Сочетание email и пароля не существует"
				) );
				$isErrors = true;
				echo $this->messageJsonError( $messageData );
			}
		} else {
			echo $this->messageJsonError( $messageData );

		}

	}


	public function actionProfile() {
		$this->setLayout();


		$user = $this->getUser();

		//print_r( $user );

		$this->pageTitle = "Редактирование информации";
		$this->render( 'profile', array( "user" => $user ) );

	}

	public function actionUpdate() {


		$user = $this->getUser();


		$firstName = isset( $_POST["first_name"] ) ? $_POST["first_name"] : null;
		$lastName  = isset( $_POST["last_name"] ) ? $_POST["last_name"] : null;
		$email     = isset( $_POST["email"] ) ? $_POST["email"] : null;
		$password  = isset( $_POST["password"] ) ? $_POST["password"] : null;

		$messageData = array();
		$isErrors    = false;

		if ( $firstName == null ) {
			array_push( $messageData, array( "field_name" => "first_name", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $lastName == null ) {
			array_push( $messageData, array( "field_name" => "last_name", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $email == null ) {
			array_push( $messageData, array( "field_name" => "email", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		} else {

			$criteria            = new CDbCriteria;
			$criteria->select    = 'email'; // only select the 'title' column
			$criteria->condition = 'email=:email';
			$criteria->params    = array( ':email' => $email );


			$userModel = User::model()->find( $criteria );
			if ( $userModel != null && $user->email != $email ) {
				array_push( $messageData, array(
					"field_name" => "email",
					"error"      => "Пользователь с таким email существует"
				) );
				$isErrors = true;
			}
		}

		if ( $password == null ) {
			//array_push( $messageData, array( "field_name" => "password", "error" => "Поле должно быть заполнено" ) );
			//$isErrors = true;
		} elseif ( strlen( $password ) < 6 ) {
			array_push( $messageData, array(
				"field_name" => "password",
				"error"      => "Пароль должен быть длиннее 6 символов"
			) );
			$isErrors = true;
		}


		if ( ! $isErrors ) {


			$user->email      = $email;
			$user->first_name = $firstName;
			$user->last_name  = $lastName;
			//$user->role       = "base_user";
			$user->setPassword( $password );
			$user->update();
			echo $this->messageJsonOk( "Данные обновлены" );

		} else {
			echo $this->messageJsonError( $messageData );
		}


	}

	public function actionOrders() {

		$this->setLayout();


		$user = $this->getUser();

		$orders = $user->getOrders();

		//print_r( $user );

		$this->pageTitle = "Мои заказы";
		$this->render( 'orders', array( "orders" => $orders ) );

	}

	public function actionOrder( $id ) {

		$this->setLayout();

		$user = $this->getUser();

		$order = Order::model()->findByPk( $id );
		if ( ! $order->user_id == $user->id ) {
			$url = '/profile/orders';
			$this->redirect( $url, true );
		}

		//print_r( $user );

		$this->pageTitle = "Мои заказы";
		$this->render( 'order', array( "order" => $order ) );

	}

    public function actionOplata(){
        // Скрипт получения запросов о результате состояния операции оплаты платежной системы IntellectMoney
        // Данный скринт содержит основные этапы получения и проверки статуса платежа для определения 
        // совершения платежа клиетом. Только через этот механизм можно однозначно определить прошел ли
        // платеж клиента в пользу счета вашего магазина или нет.
        
        // Секретныйключ
        $secretKey = "mypass";
        
        // чтение полученных параметров
        isset( $_POST["first_name"] ) ? $_POST["first_name"] : null;
        $in_eshopId = isset($_REQUEST["eshopId"]) ? $_REQUEST["eshopId"] : null;
        $in_orderId = isset($_REQUEST["orderId"]) ? $_REQUEST["orderId"] : null;
        $in_serviceName = isset($_REQUEST["serviceName"]) ? $_REQUEST["serviceName"] : null;
        $in_eshopAccount = isset($_REQUEST["eshopAccount"]) ? $_REQUEST["eshopAccount"] : null;
        $in_recipientAmount = isset($_REQUEST["recipientAmount"]) ? $_REQUEST["recipientAmount"] : null;
        $in_recipientCurrency = isset($_REQUEST["recipientCurrency"]) ? $_REQUEST["recipientCurrency"] : null;
        $in_paymentStatus = isset($_REQUEST["paymentStatus"]) ? $_REQUEST["paymentStatus"] : null;
        $in_userName = isset($_REQUEST["userName"]) ? $_REQUEST["userName"] : null;
        $in_userEmail = isset($_REQUEST["userEmail"]) ? $_REQUEST["userEmail"] : null;
        $in_paymentData = isset($_REQUEST["paymentData"]) ? $_REQUEST["paymentData"] : null;
        $in_userField_1 = isset($_REQUEST["userField_1"]) ? $_REQUEST["userField_1"] : null; // Логин
        $in_userField_2 = isset($_REQUEST["userField_2"]) ? $_REQUEST["userField_2"] : null; // Id пользователя*/
        $in_userField_3 = isset($_REQUEST["userField_3"]) ? $_REQUEST["userField_3"] : null; // набор дополнительных полей магазина
        $in_secretKey = isset($_REQUEST["secretKey"]) ? $_REQUEST["secretKey"] : null;		// нужен для проверки по HTTPS хотя в любом случае проверка по
        											//контрольной подписи предпочтительна, по этому просто игнорируем его.
        $in_hash = strtoupper(isset($_REQUEST["hash"]) ? $_REQUEST["hash"] : null);	// контрольная подпись со стороны IntellectMoney - основной способ
        											// удостовериться что данные пришли именно от IntellectMoney
        
        
        // Формируем строчку для последующего получения контрольной подписи из данных полученных в запросе
        // ВАЖНО: для правильности подписи нужно использовать все данные полученные в запросе кроме секретного ключа
        // имеено его нужно вписывать вручную (он задается выше в переменной $secretKey) и благодаря ему мы 
        // подтверждаем факт что запрос пришел от IntellectMoney, а не злоумышлиника пытающегося компрометировать запрос
        $for_hash = $in_eshopId."::".
        			$in_orderId."::".
        			$in_serviceName."::".
        			$in_eshopAccount."::".
        			$in_recipientAmount."::".
        			$in_recipientCurrency."::".
        			$in_paymentStatus."::".
        			$in_userName."::".
        			$in_userEmail."::".
        			$in_paymentData."::".
        			$secretKey; // Очень ВАЖНО проверять подпись используя свой секретный ключ, а не тот что пришел в запросе
        // Получаем наш вариант контрольной подписи
        $my_hash = strtoupper(md5($for_hash));
        
        
        // проверка корректности подписи нашей подписи и подписи пришедшей в запросе. Если они различаются, значит прошла подменна данных в ходе
        // передачи данных от сервера IntellectMoney до вашего сервера.
        if ($my_hash == $in_hash)
        {
        	$checksum = true;
        }
        else
        {
        	$checksum = false;
        }
        
        // ! ВАЖНО проверить сумму платежа и валюту по данным, хранимым в вашей базе данных по номеру заказа
        // и если сумма или валюта отличаются от тех что сгенерировали вы задайте переменной checksum значение false
        // здесь ваш код для сравнения значения в ваше базе и информации принятой от IntellectMoney
        
        
        // Если контрольные подписи не совпадают то пишем ошибку и выходим
        /*if (!$checksum)
        {
          echo "bad sign\n";
          exit();
        }*/
        
        // Символический вывод подтверждающий успешность получения информации и совпадения подписей
        echo "OK\n";
        
        // Внутренние операции по обработке платежа
        if ($in_paymentStatus == 3)
        {
        	// Платеж принят на обработку
        	// ВНИМАНИЕ это не означает что денги от клиента получены
        	// но это означает что процес создания счета прошел успешно
        	// здесь ваш код по обработке этого статуса. Рекомендуется просто 
        	// принимать к сведенью, но НИ В КОЕМ РОДЕ не считать данный
        	// статус как результат совершения платежа
        	Order::model()->updateByPk($in_orderId, array('status'=>'ordering_wait'));
        }
        
        if ($in_paymentStatus == 5)
        {
        	// Платеж прошел, можно отгружать товар / оказывать услугу
        	// здесь ваш код по обработке этого статуса
        	Order::model()->updateByPk($in_orderId, array('status'=>'paid'));
        }
    }
	/**
	 * Выход
	 */
	public function actionSignOut() {

		if ( ! Yii::app()->user->isGuest ) {

			//$this->updateSessionData();
			$criteria = new CDbCriteria;
			//$criteria->select    = 'email'; // only select the 'title' column
			$criteria->condition = 'email=:email';
			$criteria->params    = array( ':email' => Yii::app()->user->email );

			$userModel = User::model()->find( $criteria );
			$userModel->setSignOut();

			//print_r( $userModel );

			Yii::app()->user->logout();


			//$this->sessionUser->destroy();
//			setcookie( "order_id", "" );

			//$session = new CHttpSession;
			//$session->open();
			//var_dump( $session['session_user'] );

		}

		//session_unset();
		$url = '/';
		$this->redirect( $url, true );

	}


}