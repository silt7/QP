<?php

Yii::import( "application.models.User" );
Yii::import( "application.models.UserIdentity" );
Yii::import( "application.models.SessionUser" );
Yii::import( "application.models.ColorHint" );
Yii::import( "application.models.Utils" );
Yii::import( "application.models.Mail" );

Yii::import( "application.models.Color" );
Yii::import( "application.models.Folder" );
Yii::import( "application.models.ItemModule" );
Yii::import( "application.models.ItemFront" );
Yii::import( "application.models.ItemCover" );
Yii::import( "application.models.Accessory" );
Yii::import( "application.models.Equipment" );
Yii::import( "application.models.ShoppingCart" );
Yii::import( "application.models.Order" );
Yii::import( "application.models.Page" );
Yii::import( "application.models.OrderLine" );
Yii::import( "application.models.Seo" );


/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
//class MyDateTime extends DateTime { public function setTimestamp( $timestamp ) { $date = getdate( ( int ) $timestamp ); $this->setDate( $date['year'] , $date['mon'] , $date['mday'] ); $this->setTime( $date['hours'] , $date['minutes'] , $date['seconds'] ); } public function getTimestamp() { return $this->format( 'U' ); } } $date = new MyDateTime(); $date->setTimestamp( $someTimestamp ); echo $date->format( 'd/m/YH:i:s' );
class Controller extends CController {

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	public $sessionUser = null;
	public $colorHint = null;
	public $shoppingCart = null;
	public $callback = null;

	public $pageTitle = '';
	public $layout = 'auth';
	public $seo = '';


	/**
	 * JSON сообщение
	 * @var array
	 */
	public $json_message = array();

	/**
	 * JSON ок
	 *
	 * @param $data
	 *
	 * @return string
	 */
	public function messageJsonOk( $data ) {

		$this->json_message         = array();
		$this->json_message["code"] = "ok";
		$this->json_message["data"] = $data;

		return json_encode( $this->json_message );

	}

	/**
	 * JSON ошибка
	 *
	 * @param $data
	 *
	 * @return string
	 */
	public function messageJsonError( $data ) {

		$this->json_message         = array();
		$this->json_message["code"] = "error";
		$this->json_message["data"] = $data;

		return json_encode( $this->json_message );

	}

	/**
	 * Метод вызываемый при обращении к каждому экшену
	 *
	 */
	public function init() {
		parent::init();

		$this->setLayout();

		$this->initShoppingCart();
		$this->initSessionUser();
		
		$this->callback = Page::model()->findByPk( 13 );
		
		$criteria=new CDbCriteria;
        $criteria->condition='url=:url';
        
        $url = parse_url($_SERVER['REQUEST_URI']);
        $url = $url['path'];
        $criteria->params=array(':url'=>$url);
		
		$this->seo = Seo::model()->find($criteria);

	}

	/**
	 * Установка лэйаута в зависимости от авторизации
	 */
	protected function setLayout() {

		$this->layout = 'auth';

	}

	/**
	 * Обновление данных о корзине
	 */
	protected function initShoppingCart() {
	}

	/**
	 * Обновление данных о пользователе
	 */
	protected function initSessionUser() {
		$this->updateSessionData();
	}

	/**
	 * Обновление данных в сессии
	 */
	protected function updateSessionData() {

		// работа с пользователем и заказом

		// работа с сессией
		$session = new CHttpSession;

		$session->open();
		$this->sessionUser = new SessionUser( $session );
		$this->colorHint   = new ColorHint( $session );

		//setcookie( "order_id", "" );
//		$cookieParams = "";
//		if ( isset( $_COOKIE['order_id'] ) ) {
//			$cookieParams = $_COOKIE['order_id'];
//		}


//		print_r( "order id - cookie - " . $cookieParams );
//		print_r( "<br>" );
		//$sessionUser->put( 'order_id', null, true );

		// данные из сессии
		//$userId      = $this->sessionUser->get( "user_id" );
		$guestUserId = $this->sessionUser->get( "guest_user_id" );
		$orderId     = $this->sessionUser->get( "shopping_cart_id" );


//		print_r( "order id - session - " . $orderId );
//		print_r( "<br>" );
//		if ( is_null( $orderId ) ) {
//			if ( isset( $_COOKIE['order_id'] ) ) {
//				$orderId = $_COOKIE['order_id'];
//			}
//		}
		//print_r( "order id - cookie - " . $orderId );
		//print_r( "<br>" );
		// проверка что гость
		$isGuest = Controller::isGuestSession();

		if ( $isGuest ) {
//			print_r( "guest" );
//			print_r( "<br>" );

			$this->sessionUser->put( 'is_guest', true, true );
			$userId = null;
			$this->sessionUser->put( 'user_id', $userId, true );
			if ( ! $guestUserId ) {
//				// генерация нового id
//				print_r( "new id" );
//				print_r( "<br>" );


				$date        = new DateTime();
				$guestUserId = $date->getTimestamp();
				$this->sessionUser->put( 'guest_user_id', $guestUserId, true );
			}

			if ( is_null( $orderId ) ) {
//				print_r( "new orderId - " . $orderId );
//				print_r( "<br>" );
				$order                = new ShoppingCart();
				$order->is_guest_user = 1;
				$order->guest_user_id = $guestUserId;
				$order->save();
				$this->sessionUser->put( 'shopping_cart_id', $order->id, true );

//				setcookie( "order_id", $order->id );
			}

		} else {

			$user      = $this->getUser();
			$userOrder = $user->getCurrentOrderModel();


			if ( $userOrder && $userOrder->getTotalCount() ) {
				$orderId = $userOrder->id;
			}

//			print_r( $orderId );
//			print_r( $this->sessionUser->get( 'order_id' ) );

//			print_r( "auth" );
//			print_r( "<br>" );
			$this->sessionUser->put( 'is_guest', false, true );


			$userId = Yii::app()->user->getId();
			$this->sessionUser->put( 'user_id', $userId, true );


			if ( is_null( $orderId ) ) {
//				print_r( "new order id" );
//				print_r( "<br>" );

				$order                = new ShoppingCart();
				$order->is_guest_user = 0;
				$order->user_id       = $userId;
				$order->save();
				$this->sessionUser->put( 'shopping_cart_id', $order->id, true );

				$user->current_order_id = $order->id;
				$user->update();

//				setcookie( "order_id", $order->id );
			} else {
				$order = ShoppingCart::model()->findByPk( $orderId );
				if ( ! $order ) {
//					print_r( "new order id" );
//					print_r( "<br>" );
					$order                = new ShoppingCart();
					$order->is_guest_user = 0;
					$order->user_id       = $userId;
					$order->save();


				} else {
//					print_r( "update order id" );
//					print_r( "<br>" );
					$order->is_guest_user = 0;
					$order->user_id       = $userId;
					$order->update();


				}
				$this->sessionUser->put( 'shopping_cart_id', $order->id, true );
				$user->current_order_id = $order->id;
				$user->update();

			}
//			setcookie( "order_id", "" );

		}


	}

	public static function isGuestSession() {
		if ( Yii::app()->user->isGuest ) {
			return true;
		} else {
			return ! User::isSignIn( Yii::app()->user->email );

		}
	}

	public function getUser() {
		if ( ! $this->isGuestSession() ) {
			return User::model()->findByPk( Yii::app()->user->getId() );

		}

		return false;
	}

	public function getBackUrl() {
		if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
			$prevPage = $_SERVER['HTTP_REFERER'];

			return $prevPage;
		}
	}

	public function clearShoppingCart() {
		$isGuest = Controller::isGuestSession();
		if(!$isGuest){
			$user = $this->getUser();
			$user->current_order_id = 0;
			$user->update();

			$session = new CHttpSession;

			$session->open();
			$this->sessionUser = new SessionUser( $session );
			$this->sessionUser->put( 'shopping_cart_id', 0, true );
		}
		else{
			$guestUserId = $this->sessionUser->get( "guest_user_id" );
			$userId = ShoppingCart::model() -> find('guest_user_id=:ID', array(':ID'=>$guestUserId));
			$orders = OrderLine::model() -> findAll('order_id=:ID', array(':ID'=>$userId["id"]));
			foreach($orders as $order){
				$order_del = OrderLine::model() -> findByPk($order["id"]);
				$order_del -> delete();
			}
		}
	}

	/**
	 * Проверка роли пользователя
	 *
	 * @param $role
	 *
	 * @return bool
	 */
	protected function checkRole( $role ) {
		if ( Yii::app()->user->isGuest ) {
			return false;
		} else {
			if ( User::isSignIn( Yii::app()->user->email ) ) {
				return User::checkRole( $role, Yii::app()->user->role );

			} else {
				return false;
			}
		}
	}

	protected function getShoppingCartModel() {

		$orderId = $this->getShoppingCartId();
		if ( $orderId ) {
			return ShoppingCart::model()->findByPk( $orderId );
		} else {
			return null;
		}

	}

	public function getShoppingCartId() {
		return $this->sessionUser->get( "shopping_cart_id" );
	}
}