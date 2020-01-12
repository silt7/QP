<?php


Yii::import( 'application.models.User' );


/**
 *   Хранение пользоватля в сессии
 */
class SessionUser {

	private $storage;
	private $sessionStorage;

	public function __construct( $sessionStorage ) {
		$this->sessionStorage           = $sessionStorage;
		$this->storage['user_id']       = null;
		$this->storage['order_id']      = null;
		$this->storage['is_guest']      = true;
		$this->storage['guest_user_id'] = null;

		if ( isset( $sessionStorage['session_user'] ) ) {
			$this->storage = $sessionStorage['session_user'];
		}

	}

	/**
	 * Уничтожение данной модели в сессии
	 */
	public function destroy() {
		$this->storage['user_id']       = null;
		$this->storage['guest_user_id'] = null;
		$this->storage['order_id']      = null;
		$this->storage['is_guest']      = true;
		$this->save();
		$this->sessionStorage['session_user'] = null;
		setcookie( "order_id", "" );
		$this->sessionStorage->destroy();
	}

	/**
	 * Сохранение модели в хранилище
	 */
	public function save() {
		$this->sessionStorage['session_user'] = $this->storage;
	}

	public function put( $label, $value, $isSave ) {

		$this->storage[ $label ] = $value;

		if ( $isSave ) {
			$this->save();
		}

	}

	public function getStorage() {
		return $this->storage;
	}

	/**
	 * Установка хранилища
	 *
	 * @param $sessionStorage
	 */
	public function setStorage( $sessionStorage ) {
		$this->sessionStorage = $sessionStorage;
	}

	/**
	 * Обновление хранилища
	 *
	 * @param $storage
	 */
	public function updateStorage( $storage ) {
		$this->storage = $storage;
	}

	public function get( $label ) {
		return isset( $this->storage[ $label ] ) ? $this->storage[ $label ] : null;
	}


} 