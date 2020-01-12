<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.models.OrderLine' );
Yii::import( 'application.models.ItemModule' );
Yii::import( 'application.models.ItemFront' );
Yii::import( 'application.models.Tabletop' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Page' );
Yii::import( 'application.models.PriceModuleColor' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.PriceFrontFrez' );
Yii::import( 'application.models.ColorCategory' );


class ShopController extends Controller {


	public function actionShoppingCartUpdate() {

		$modules = array();

		$order      = $this->getShoppingCartModel();
		$orderLines = $order->getLines();


		foreach ( $orderLines as $orderLine ) {

			$lineId = $orderLine->id;

			$quantity            = Yii::app()->getRequest()->getPost( 'quantity_' . $lineId );
			$orderLine->quantity = $quantity;
			$orderLine->update();

		}
		$url = "/shopping-cart";
		$this->redirect( $url, true );

	}

	public function actionShoppingCartSave() {

		$title = Yii::app()->request->getPost( "title" );


		$shoppingCart = $this->getShoppingCartModel();
		$orderLines   = $shoppingCart->getLines();

		$newShoppingCart           = new ShoppingCart();
		$newShoppingCart->user_id  = $this->getUser()->id;
		$newShoppingCart->title    = $title;
		$newShoppingCart->is_saved = 1;
		if ( $newShoppingCart->save() ) {

			if ( $orderLines ) {
				foreach ( $orderLines as $orderLine ) {
					$newOrderLine             = new OrderLine();
					$newOrderLine->item_id    = $orderLine->item_id;
					$newOrderLine->item_type  = $orderLine->item_type;
					$newOrderLine->item_title = $orderLine->item_title;
					$newOrderLine->order_id   = $newShoppingCart->id;
					$newOrderLine->price      = $orderLine->price;
					$newOrderLine->pre_pay    = $orderLine->pre_pay;
					$newOrderLine->quantity   = $orderLine->quantity;
					$newOrderLine->pre_pay    = $orderLine->pre_pay;
					$newOrderLine->setOptions( $orderLine->getOptions() );
					$newOrderLine->save();
				}
			}

//			print_r( $orderLines );

			echo $this->messageJsonOk( "Корзина сохранена" );

		}


	}

	public
	function actionShoppingCartClear() {

 		$this->clearShoppingCart();
		$url = "/shopping-cart";
		$this->redirect( $url, true ); 

	}

	public function actionShoppingCarts() {

		$criteria            = new CDbCriteria();
		$criteria->condition = "is_saved = 1 and user_id = " . $this->getUser()->id;

		$shoppingCarts = ShoppingCart::model()->findAll( $criteria );
		//print_r( $modules );

		$this->pageTitle = "Корзина";
		$this->render( 'shopping-carts', array( "shoppingCarts" => $shoppingCarts ) );

	}


	public function actionShoppingCartRemove( $id ) {

		$shoppingCart = ShoppingCart::model()->findByPk( $id );
		if ( $shoppingCart && $shoppingCart->user_id == $this->getUser()->id ) {

			$orderLines = $shoppingCart->getLines();
			if ( $orderLines ) {
				foreach ( $orderLines as $orderLine ) {
					$orderLine->delete();
				}
			}

			$shoppingCart->delete();

		}
		$url = "/shopping-cart/list";
		$this->redirect( $url, true );
	}

	public function actionShoppingCartLoad( $id ) {

		$shoppingCart = ShoppingCart::model()->findByPk( $id );
		if ( $shoppingCart && $shoppingCart->user_id == $this->getUser()->id ) {

			$orderLines = $shoppingCart->getLines();

			$newShoppingCart          = new ShoppingCart();
			$newShoppingCart->user_id = $this->getUser()->id;


			if ( $newShoppingCart->save() ) {

				print_r( $shoppingCart->id );

				if ( $orderLines ) {
					foreach ( $orderLines as $orderLine ) {
						print_r( $orderLine->id );

						$newOrderLine             = new OrderLine();
						$newOrderLine->item_id    = $orderLine->item_id;
						$newOrderLine->item_type  = $orderLine->item_type;
						$newOrderLine->item_title = $orderLine->item_title;
						$newOrderLine->order_id   = $newShoppingCart->id;
						$newOrderLine->price      = $orderLine->price;
						$newOrderLine->pre_pay    = $orderLine->pre_pay;
						$newOrderLine->quantity   = $orderLine->quantity;
						$newOrderLine->pre_pay    = $orderLine->pre_pay;
						$newOrderLine->setOptions( $orderLine->getOptions() );
						//$newOrderLine->setColors( $orderLine->getColors() );
						$newOrderLine->save();
					}
				}

				$user                   = $this->getUser();
				$user->current_order_id = $newShoppingCart->id;
				$user->update();


				//echo $this->messageJsonOk( "Корзина сохранена" );
				$url = "/shopping-cart";
				$this->redirect( $url, true );
			}


		}

	}

	/**
	 * Корзина
	 *  TODO переработать систему вывода товаров в корзине, в контроле и во вьюхе
	 */
	public
	function actionShoppingCart() {


		$shoppingCart = $this->getShoppingCartModel();
		$items        = $shoppingCart->getLinesToView();
		//print_r($items);
		//print_r( $modules );

		$this->pageTitle = "Корзина";
		$this->render( 'shopping-cart', array( "items" => $items ) );
	}

	/**
	 * Корзина
	 */
	public
	function actionOrdering() {
	    $agreement =  Page::model()->findByPk( 11 );
        $page = Page::model()->findByPk( 10 );
		$shoppingCart = $this->getShoppingCartModel();
		$items        = $shoppingCart->getLinesToView();

		$this->pageTitle = "Оформление заказа";
		$this->render( 'ordering', array( "items" => $items,"page" => $page,"agreement" => $agreement ) );
	}

	/**
	 * Сохранение заказа
	 */
	public
	function actionOrderSave() {


		$name     = isset( $_POST["name"] ) ? $_POST["name"] : null;
		$phone    = isset( $_POST["phone"] ) ? $_POST["phone"] : null;
		$emailUser = isset( $_POST["emailUser"] ) ? $_POST["emailUser"] : null;
		$email    = isset( $_POST["email"] ) ? $_POST["email"] : null;
		$password = isset( $_POST["password"] ) ? $_POST["password"] : null;
		$address  = isset( $_POST["address"] ) ? $_POST["address"] : null;
		$comment  = isset( $_POST["comment"] ) ? $_POST["comment"] : null;

		$user        = $this->getUser();
		$userModel   = null;
		$messageData = array();
		$isErrors    = false;

		if ( $name == null ) {
			array_push( $messageData, array( "field_name" => "name", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $phone == null ) {
			array_push( $messageData, array( "field_name" => "phone", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}
		if ( $address == null ) {
			array_push( $messageData, array( "field_name" => "address", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		}

		if ( $email == null ) {
			array_push( $messageData, array( "field_name" => "email", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		} 
		else {

			$criteria            = new CDbCriteria;
			$criteria->select    = 'email'; // only select the 'title' column
			$criteria->condition = 'email=:email';
			$criteria->params    = array( ':email' => $email );


			$userModel = User::model()->find( $criteria );
			if ( ! $userModel && ! $user && ( $password == null || strlen( $password ) < 6 ) ) {
				array_push( $messageData, array(
					"field_name" => "email",
					"error"      => "Пользователь с таким email существует или неверно введен пароль"
				) );
				$isErrors = true;
			} elseif ( $userModel && ! $user ) {
				//$userModel->checkPassword($password);

				$session = new CHttpSession;

				$session->open();
				$this->sessionUser = new SessionUser( $session );
				$shoppingCartId    = $this->sessionUser->get( "shopping_cart_id" );

				$identity = new UserIdentity( $email, $password );
				if ( $identity->authenticate() ) {
					Yii::app()->user->login( $identity, 3600 * 24 * 7 );

					$criteria = new CDbCriteria;
					//$criteria->select    = 'email'; // only select the 'title' column
					$criteria->condition = 'email=:email';
					$criteria->params    = array( ':email' => $email );

					$userModel = User::model()->find( $criteria );
					$userModel->setSignIn();

					$user = $userModel;

					$this->sessionUser = new SessionUser( $session );
					$this->sessionUser->put( "shopping_cart_id", $shoppingCartId, true );
					//echo $this->messageJsonOk( "success" );
				} 
				/*else {
					array_push( $messageData, array(
						"field_name" => "password",
						"error"      => "Сочетание email и пароля не существует"
					) );
					$isErrors = true;
					//echo $this->messageJsonError( $messageData );
				}*/

			}
		}

		if ( ! $user && $password == null ) {
			array_push( $messageData, array( "field_name" => "password", "error" => "Поле должно быть заполнено" ) );
			$isErrors = true;
		} elseif ( ! $user && strlen( $password ) < 6 ) {
			array_push( $messageData, array(
				"field_name" => "password",
				"error"      => "Пароль должен быть длиннее 6 символов"
			) );
			$isErrors = true;
		}


		if ( ! $isErrors ) {


			if ( ! $user ) {
				$user             = new User();
				$user->email      = $email;
				$user->first_name = $name;
				$user->role       = "base_user";
				$user->setPassword( $password );
				$user->save();
				$shoppingCartId = $this->sessionUser->get( "shopping_cart_id" );

				$identity = new UserIdentity( $email, $password );
				if ( $identity->authenticate() ) {
					Yii::app()->user->login( $identity, 3600 * 24 * 7 );

					$criteria = new CDbCriteria;
					//$criteria->select    = 'email'; // only select the 'title' column
					$criteria->condition = 'email=:email';
					$criteria->params    = array( ':email' => $email );

					$userModel = User::model()->find( $criteria );
					$userModel->setSignIn();

					$user = $userModel;

					$session = new CHttpSession;
					$session->open();
					$this->sessionUser = new SessionUser( $session );
					$this->sessionUser->put( "shopping_cart_id", $shoppingCartId, true );
				}

			}

			$shoppingCart = $this->getShoppingCartModel();


			$order                   = new Order();
			$order->shopping_cart_id = $shoppingCart->id;
			$order->name             = $name;
			$order->phone            = $phone;
			$order->email            = $email;
			$order->address          = $address;
			$order->comment          = $comment;
			$order->total_price      = $shoppingCart->getTotalPrice();
			if ( $user ) {
				$order->user_id = $user->id;
			}
			$order->status   = Order::$statusArray["create"]["name"];
			$order->datetime = date( "Y-m-d H:i:s" );
			if ( $order->save() ) {

				// отправка письма

				$data            = array();
				$data["to"] 	 = $email;
				$data["to2"] 	 = $emailUser;
				$data["subject"] = $order->getTitle();
				$data["message"] = $order->getTitle();
				$data["order"]   = $order;
				$data["mockup"]  = "order-create.html";
				$data["noSend"]  = "y";

				$this->sendMail( $data );
			};


			$this->clearShoppingCart();

			echo $this->messageJsonOk( "Заказ оформлен" );

		} else {
			echo $this->messageJsonError( $messageData );
		}


	}

	/**
	 * @param $data
	 * Отправка писем
	 */
	protected
	function sendMail(
		$data
	) {

		$mailText = "";
		$mockup   = file_get_contents( Yii::getPathOfAlias( 'webroot' ) . "/files/mail/" . $data["mockup"] );

		$order = $data["order"];

		$mailText = str_replace( "%order_number%", $order->id, $mockup );
		$mailText = str_replace( "%user_name%", $order->name, $mailText );
		$mailText = str_replace( "%phone%", $order->phone, $mailText );
		$mailText = str_replace( "%address%", $order->address, $mailText );
		$mailText = str_replace( "%total_price%", $order->getTotalPrice(), $mailText );
		$mailText = str_replace( "%order_date%", $order->datetime, $mailText );

		$orderContains = "";
		$orderLines    = $order->getLines();

		foreach ( $orderLines as $orderLine ) {
			if(!empty($orderLine)){
				$orderContains .= $orderLine->item_title . " (" . $orderLine->quantity . "шт)  " . $orderLine->quantity * $orderLine->price . " руб";
				$option = unserialize($orderLine->options);
				if(isset( $option["cover_width"] )){$orderContains .=  "<div>Ширина : " . $option["cover_width"] . " мм</div>";}
				if(isset( $option["cover_length"] )){$orderContains .= "<div>Длина : " . $option["cover_length"] . " мм</div>";}
				if ( isset( $option["cover_color_id"] ) && ! is_null( $option["cover_color_id"] ) ){
					$title_color = Color::model()->findByPk($option["cover_color_id"]); 
					$orderContains .= $title_color['title']." (".$title_color->getMaterialLabel().")";
				}
				if ( isset( $option["module_color_id"] ) && ! is_null( $option["module_color_id"] ) ){
					$title_color = Color::model()->findByPk($option["module_color_id"]);
					$orderContains .=  "<br>Корпус: ".$title_color->getMaterialLabel()." - ".$title_color['title'];
					$options_m = unserialize($orderLine["options"]);
					if ($options_m["mod_front_color_id"] > -1 ){ 
						$title_color_f = Color::model()->findByPk($options_m["mod_front_color_id"]);
							$orderContains .=  "<br>Фасад: ".$title_color_f->getMaterialLabel()." - ".$title_color_f['title'];
					} else{
						$orderContains .=  "<br>Фасад: Без фасада.";
					}
				}
				if ( isset( $option["front_color_id"] ) && ! is_null( $option["front_color_id"] ) ){
					$title_color = Color::model()->findByPk($option["front_color_id"]); 
					$orderContains .=   "<br>".$title_color->getMaterialLabel()." - ".$title_color['title'];
				}
				$orderContains .= "<hr>";
			}
		}

		$mailText = str_replace( "%order_contains%", $orderContains, $mailText );


		$mail = new Mail( "utf-8" );
		$mail->From( "QP;order@qp-kuhni.ru" );
		$mail->To( "info@qp-kuhni.ru" );
		if($data["to2"] != null){
			if($data["to"] == $data["to2"]){
				$mail->To( $data["to"] );
			}
			else{
				$mail->To( $data["to"] );
				$mail->To( $data["to2"] );
			}
		}
		else{
			$mail->To( $data["to"] );
		}

		$mail->Subject( $data["subject"] );
		$mail->Body( $mailText, "html" );
		$mail->Priority( 3 );
		$mail->smtp_on( "ssl://smtp.yandex.ru", "order@qp-kuhni.ru", "ltkfq500kuhni", 465 );
		if($data["noSend"] != 'y'){
		    $mail->Send();
		}
		
/* 		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail('info@qp-kuhni.ru', 'Новый заказ', $mailText, $headers); */
	}

	/**
	 * Добавление корпуса в корзину
	 */
	public function actionAddModuleToShoppingCart() {
		$this->updateSessionData();
		$orderId       = $this->getShoppingCartId();

		$orderLineId   = Yii::app()->getRequest()->getPost( 'order_line_id' );

		//form
 		$itemId      = Yii::app()->getRequest()->getPost( 'item_id' );
		$itemModel     = ItemModule::model()->findByPk( $itemId );
		$itemType    = OrderLine::$itemTypes["module"]["name"];
		$itemTitle   = $itemModel["title"];
		$quantity    = Yii::app()->getRequest()->getPost( 'quantity' );
		$optionsPost = Yii::app()->getRequest()->getPost( 'options' );
		$price       = Yii::app()->getRequest()->getPost( 'moduleModalPrice_inp' );
		$price_f     = Yii::app()->getRequest()->getPost( 'moduleFasadPrice_inp' );
		
		$selColor = Yii::app()->getRequest()->getPost( 'color_select_module' );
		!empty($selColor) ? $options['module_color_id'] = $selColor : $options['module_color_id'] = 29;
		
		
		if(empty($price_f)){
			$options['mod_front_color_id'] = -1;
		}
		else{
			$options['mod_front_color_id'] = Yii::app()->getRequest()->getPost( 'color_select_front' );
		}

		$options['options_checked'] = array();
		if ( $optionsPost ) {
			foreach ($optionsPost as $id) {
				$optionModel = ModuleOption::model()->findByPk($id);
				if (!empty($optionModel)) {
					$option["title"] = $optionModel['title'];
					$option["is_checked"] = 1;
					array_push($options["options_checked"], $option);
				}
			}
		}
		$orderLine = new OrderLine();
		if ( $orderLineId ) {
			$orderLine = OrderLine::model()->findByPk( $orderLineId );
		}
		$orderLine->item_id    = intval( $itemId );
		$orderLine->item_type  = $itemType;
		$orderLine->item_title = $itemTitle;
		$orderLine->order_id   = intval( $orderId );
		$orderLine->price      = intval( $price );
		$orderLine->quantity   = intval( $quantity );
		$orderLine->pre_pay    = intval( $price ) * 35 / 100;
		$orderLine->setOptions( $options );
		if ( $orderLine->save() ) {
			echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
		} else {
			echo $this->messageJsonError( "Произошла ошибка при сохранении" );
		}
	}

	/**
	 * Добавление фасада в корзину
	 */
	public
	function actionAddFrontToShoppingCart() {
//
//		ini_set( 'error_reporting', E_ALL | E_STRICT );
//		ini_set( 'display_errors', 1 );

		$debugString = "| ";

		$this->updateSessionData();
		//session
		$orderId = $this->getShoppingCartId();
		//$moduleColorId = $this->colorHint->getModuleColorId();
		//$frontColorId = $this->colorHint->getFrontColorId();

		$frontColorId = Yii::app()->getRequest()->getPost( 'front_color_id' ) ? Yii::app()->getRequest()->getPost( 'front_color_id' ) : Yii::app()->session['frontColorId'];
		

		//$frontColorId = Yii::app()->session['frontColorId'];
		$orderLineId  = Yii::app()->getRequest()->getPost( 'order_line_id' );
		$front_l  = Yii::app()->getRequest()->getPost( 'LENGTH' ); 
		$front_w  = Yii::app()->getRequest()->getPost( 'WIDTH' ); 

		//form
		$itemId        = Yii::app()->getRequest()->getPost( 'item_id' );
		$itemType      = OrderLine::$itemTypes["front"]["name"];//Yii::app()->getRequest()->getQuery( 'item_type' );
		$quantity      = Yii::app()->getRequest()->getPost( 'quantity' );
		$optionsPost   = Yii::app()->getRequest()->getPost( 'options' );
		$prePay        = 0;
		$optionsPrePay = 0;

		$itemFront = ItemFront::model()->findByPk( $itemId );
		

		if ( $itemFront ) {			
			$itemPrice = 0;
			$price     = 0;
			$ColorModel = Color::model()->findByPk($frontColorId);
			$priceColorMilling = $itemFront->getPriceColorMilling($ColorModel);
			$itemPrice = $priceColorMilling['price'];
			$millingsFront = $priceColorMilling['millingsFront'];
			/*
			if(substr($itemFront->pre_pay,0,1) == "a"){
				$ColorModel = Color::model()->findByPk($frontColorId);
				$prePayFront = unserialize($itemFront->pre_pay);
				if($ColorModel['material'] == "ldsp"){
					$prePay = $prePayFront[0] / 100;
				}
				else if($ColorModel['material'] == "mdf"){
					$prePay = $prePayFront[1] / 100;
				}
				else if($ColorModel['material'] == "plastic"){
					$prePay = $prePayFront[2] / 100;
				}
				else {
					$prePay = $prePayFront[1] / 100;
				}
			}
			*/
			$itemTitle    = $itemFront->title;
			$frontOptions = $itemFront->getOptions();
			if(empty($frontOptions)){
				$frontOptions = array();
			}
			
			$options      = array();
			$options["front_color_id"]  = $frontColorId;
			if(($front_w != 0)and($front_l != 0)){
				$options["cover_width"] = $front_w;
				$options["cover_length"]= $front_l;
			}
			$options["options_checked"] = array();
			$optionsTotalPriceForOneItem = 0;
			
			if ( $optionsPost ) {

				foreach ( $frontOptions as $option ) {

					$optionModel = ModuleOption::model()->findByPk( $option["id"] );
					$option["title"] = $optionModel["title"];

					if ( in_array( $option["id"], $optionsPost ) ) {
										
						$option["is_checked"] = 1;

						$count = $option["price"];
						$optionsTotalPriceForOneItem += $optionModel["price"]*$count;
															
						array_push( $options['options_checked'], $option );
					} else {
						$option["is_checked"] = 0;
					}
				}
				foreach($millingsFront as $item){
					if(in_array($item['id'], $optionsPost)){
						$itemPrice = $item['price'];	
						$arr = ['id' => $item['id'],'group' => 'milling', 'is_enabled' => 0,
								'price' => $item['price'], 'title' => $item['title'], 'is_checked' => 0];
						array_push( $options['options_checked'], $arr );
					} 
				}
				$price += $optionsTotalPriceForOneItem;
				
			}
			
//			$debugString .= "optionsTotalPriceForOneItem - $optionsTotalPriceForOneItem";
			if (($itemPrice > 0)and($itemPrice <= 1)){
				$itemPrice = ceil($itemPrice * $front_w * $front_l);
			}
			$price += $itemPrice;
			$prePay = $price * $prePay;

			// сохранение а бд
			$orderLine = new OrderLine();
			if ( $orderLineId ) {
				$orderLine = OrderLine::model()->findByPk( $orderLineId );
			}

			$orderLine->item_id    = intval( $itemId );
			$orderLine->item_type  = $itemType;
			$orderLine->item_title = $itemTitle;
			$orderLine->order_id   = intval( $orderId );
			$orderLine->price      = intval( $price );
			$orderLine->pre_pay    = intval( $prePay );
			$orderLine->quantity   = intval( $quantity );
			$orderLine->pre_pay    = intval( $prePay );
			$orderLine->setOptions( $options );
			if ( $orderLine->save() ) {
				echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
			} else {
				echo $this->messageJsonError( "Произошла ошибка при сохранении $debugString" );
			}
		} else {
			echo $this->messageJsonError( "Фасад не найден $itemId $debugString" );
		}
	}

	/**
	 * Добавление покрытия в корзину
	 */
	public
	function actionAddCover() {
		$this->updateSessionData();
		//session
		$orderId = $this->getShoppingCartId();
		//$moduleColorId = $this->colorHint->getModuleColorId();
		$tabletopColorId = null;//$this->colorHint->getFrontColorId();


		//form
		$itemId      = Yii::app()->getRequest()->getPost( 'item_id' );
		$orderLineId = Yii::app()->getRequest()->getPost( 'order_line_id' );

		$coverColorId  = Yii::app()->getRequest()->getPost( 'color' );
		$itemType      = OrderLine::$itemTypes["cover"]["name"];//Yii::app()->getRequest()->getQuery( 'item_type' );
		$quantity      = Yii::app()->getRequest()->getPost( 'quantity' );
		$optionsPost   = Yii::app()->getRequest()->getPost( 'options' );
		$factor        = Yii::app()->getRequest()->getPost( 'factor' );
		$factor_2	   = Yii::app()->getRequest()->getPost( 'factor_2' );
		$width         = Yii::app()->getRequest()->getPost( 'width' );
		$length        = Yii::app()->getRequest()->getPost( 'length' );
		$prePay        = 0;
		$optionsPrePay = 0;


		//print_r( $options );

		//print_r( 'quantity - ' . $quantity );
		//print_r( 'id - ' . $itemId );
		//echo $this->messageJsonError( 'quantity - ' . $quantity . 'id - ' . $itemId );
		$itemCover = ItemCover::model()->findByPk( $itemId );


		if ( $itemCover ) {


			$colors    = $itemCover->getColors();
			$itemPrice = 0;
			$price     = 0;
			if ( $colors and $coverColorId ) {
				$itemPrice = $colors[ $coverColorId ]["price"] * ($factor + $factor_2);
			}

			//db
			//$price        = $price;
			$itemTitle    = $itemCover->title;
			$coverOptions = $itemCover->getOptions();
			$options      = array();
			//$options["module_color_id"] = $moduleColorId;
			$options["cover_color_id"]  = $coverColorId;
			$options["factor"]          = $factor;
			$options["factor_2"]        = $factor_2;			
			$options["cover_width"]     = $width;
			$options["cover_length"]    = $length;
			$options["options_checked"] = array();

			$optionsTotalPriceForOneItem = 0;

			$prePay = 0;

			if ( $optionsPost ) {

				foreach ( $coverOptions as $option ) {

					$optionModel = ModuleOption::model()->findByPk( $option["id"] );

					$option["title"] = $optionModel->title;
					if ( in_array( $option["id"], $optionsPost ) ) {
						$option["is_checked"] = 1;
						$optionsTotalPriceForOneItem += $option["price"];
						$optionsPrePay += $option["price"] * $optionModel->pre_pay / 100;

						array_push( $options["options_checked"], $option );

					} else {
						$option["is_checked"] = 0;
					}

				}
				$price += $optionsTotalPriceForOneItem * ($factor + $factor_2);

			}

			$price += $itemPrice;
			$prePay += $itemCover->pre_pay * $price / 100;
			//$prePay += $optionsPrePay;


			// сохранение а бд
			$orderLine = new OrderLine();
			if ( $orderLineId ) {
				$orderLine = OrderLine::model()->findByPk( $orderLineId );
			}
			$orderLine->item_id    = intval( $itemId );
			$orderLine->item_type  = $itemType;
			$orderLine->item_title = $itemTitle;
			$orderLine->order_id   = intval( $orderId );
			$orderLine->price      = intval( $price );
			$orderLine->pre_pay    = intval( $prePay );
			$orderLine->quantity   = intval( $quantity );
			//$orderLine->pre_pay    = intval( $prePay );
			$orderLine->setOptions( $options );
			if ( $orderLine->save() ) {
				echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
			} else {
				echo $this->messageJsonError( "Произошла ошибка при сохранении" );
			}
		} else {
			echo $this->messageJsonError( "Товар не найден $itemId" );
		}
	}

	/**
	 * Добавление аксессуара в корзину
	 */
	public
	function actionAddAccessory() {

		$this->updateSessionData();
		//session
		$orderId = $this->getShoppingCartId();

		$orderLineId = Yii::app()->getRequest()->getPost( 'order_line_id' );

		$itemId      = Yii::app()->getRequest()->getPost( 'item_id' );
		$quantity    = Yii::app()->getRequest()->getPost( 'quantity' );
		$optionsPost = Yii::app()->getRequest()->getPost( 'options' );
		$color       = Yii::app()->getRequest()->getPost( 'color' );


		$price         = 0;
		$itemPrice     = 0;
		$prePay        = 0;
		$optionsPrePay = 0;

		$itemType = OrderLine::$itemTypes["accessory"]["name"];

		$itemModel = Accessory::model()->findByPk( $itemId );
		$itemPrice = $itemModel->price;

		$itemOptions                 = $itemModel->getOptions();
		$optionsTotalPriceForOneItem = 0;
		$options                     = array();
		$options["item_color_id"]    = $color;
		$options["options_checked"]  = array();
		// обработка опций
		if (isset($color)){
			$color = Color::model()->findByPk($color);
			$option["title"] = "Цвет: ".$color->title;
			$option["is_checked"] = 1;
			$option["price"] = 0;
			array_push( $options["options_checked"], $option );
		}
		if ( $optionsPost ) {

			foreach ( $itemOptions as $option ) {

				$optionModel = ModuleOption::model()->findByPk( $option["id"] );


//				$option["price"] = $optionModel->price;
				$option["title"] = $optionModel->title;
				if ( in_array( $option["id"], $optionsPost ) ) {
					$option["is_checked"] = 1;
					$optionsTotalPriceForOneItem += $option["price"];
					$optionsPrePay += $option["price"] * $optionModel->pre_pay / 100;


					array_push( $options["options_checked"], $option );

				} else {
					$option["is_checked"] = 0;
				}

			}
			$price += $optionsTotalPriceForOneItem;

		}

		$price += $itemPrice;
		$prePay += $itemModel->pre_pay * $itemPrice / 100;
		$prePay += $optionsPrePay;


		// сохранение а бд
		$orderLine = new OrderLine();
		if ( $orderLineId ) {
			$orderLine = OrderLine::model()->findByPk( $orderLineId );
		}
		$orderLine->item_id    = intval( $itemId );
		$orderLine->item_type  = $itemType;
		$orderLine->item_title = $itemModel->title;
		$orderLine->order_id   = intval( $orderId );
		$orderLine->price      = intval( $price );
		$orderLine->pre_pay    = intval( $prePay );
		$orderLine->quantity   = intval( $quantity );
		$orderLine->pre_pay    = intval( $prePay );
		$orderLine->setOptions( $options );
		if ( $orderLine->save() ) {
			echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
		} else {
			echo $this->messageJsonError( "Произошла ошибка при сохранении" );
		}
	}

	/**
	 * Добавление техники в корзину
	 */
	public
	function actionAddEquipment() {

		$this->updateSessionData();
		//session
		$orderId = $this->getShoppingCartId();

		$orderLineId = Yii::app()->getRequest()->getPost( 'order_line_id' );

		$itemId      = Yii::app()->getRequest()->getPost( 'item_id' );
		$quantity    = Yii::app()->getRequest()->getPost( 'quantity' );
		$optionsPost = Yii::app()->getRequest()->getPost( 'options' );
//		$color       = Yii::app()->getRequest()->getPost( 'color' );


		$price         = 0;
		$itemPrice     = 0;
		$prePay        = 0;
		$optionsPrePay = 0;

		$itemType = OrderLine::$itemTypes["equipment"]["name"];

		$itemModel = Equipment::model()->findByPk( $itemId );
		$itemPrice = $itemModel->price;

		$itemOptions                 = $itemModel->getOptions();
		$optionsTotalPriceForOneItem = 0;
		$options                     = array();
//		$options["item_color_id"]    = $color;
		$options["options_checked"] = array();
		// обработка опций
		if ( $optionsPost ) {

			foreach ( $itemOptions as $option ) {

				$optionModel = ModuleOption::model()->findByPk( $option["id"] );


//				$option["price"] = $optionModel->price;
				$option["title"] = $optionModel->title;
				if ( in_array( $option["id"], $optionsPost ) ) {
					$option["is_checked"] = 1;
					$optionsTotalPriceForOneItem += $option["price"];
					$optionsPrePay += $option["price"] * $optionModel->pre_pay / 100;


					array_push( $options["options_checked"], $option );

				} else {
					$option["is_checked"] = 0;
				}

			}
			$price += $optionsTotalPriceForOneItem;

		}

		$price += $itemPrice;
		$prePay += $itemModel->pre_pay * $itemPrice / 100;
		$prePay += $optionsPrePay;

		// сохранение а бд
		$orderLine = new OrderLine();
		if ( $orderLineId ) {
			$orderLine = OrderLine::model()->findByPk( $orderLineId );
		}
		$orderLine->item_id    = intval( $itemId );
		$orderLine->item_type  = $itemType;
		$orderLine->item_title = $itemModel->title;
		$orderLine->order_id   = intval( $orderId );
		$orderLine->price      = intval( $price );
		$orderLine->pre_pay    = intval( $prePay );
		$orderLine->quantity   = intval( $quantity );
		$orderLine->pre_pay    = intval( $prePay );
		$orderLine->setOptions( $options );
		if ( $orderLine->save() ) {
			echo $this->messageJsonOk( '{"quantity": "'.$quantity.'", "price":"'.$price.'"}');
		} else {
			echo $this->messageJsonError( "Произошла ошибка при сохранении" );
		}
	}

	/**
	 * Удаление любого элемента из корзины
	 *
	 * @param $id
	 */
	public
	function actionRemoveItem(
		$id
	) {

		$orderId = $this->getShoppingCartId();

		$orderLine = OrderLine::model()->findByPk( $id );

		if ( $orderLine and $orderLine->order_id == $orderId ) {
			$orderLine->delete();
		}

		$url = "/shopping-cart";
		$this->redirect( $url, true );

	}

	/**
	 * Редактирвоание любого элемента в корзине
	 *
	 * @param $id
	 */
	public
	function actionEditItem(
		$id
	) {

		$orderId = $this->getShoppingCartId();

		$orderLine = OrderLine::model()->findByPk( $id );

		if ( $orderLine and $orderLine->order_id == $orderId ) {

			$itemType = $orderLine->getModel();


			$item = $itemType["model"]::model()->findByPk( $orderLine->item_id );

			if ( $itemType["model"] == "ItemModule" ) {
				$itemEditView = Folder::$models["itemModule"];

			} elseif ( $itemType["model"] == "ItemFront" ) {
				$itemEditView = Folder::$models["itemFront"];

			} else {

				$folder = $item->getFolderModel();

				//print_r( $item );

				$itemEditView = $folder->getModel();
			}


			$view = $itemEditView["viewItemEdit"];

			$this->pageTitle = $item->title;
			$this->render( $view, array( "item" => $item, "orderLine" => $orderLine ) );


		} else {
			$url = "/shopping-cart";
			$this->redirect( $url, true );
		}


	}

}