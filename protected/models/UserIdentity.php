<?php

/**
 * UserIdentity model
 *
 * Created by PhpStorm.
 * User: Grigorij
 */

Yii::import( 'application.models.User' );

class UserIdentity extends CUserIdentity {
	private $user_id;

	//private $email;

	/**
	 *  Authenticate user
	 */
	public function authenticate() {
		$criteria = new CDbCriteria;
		//$criteria->select    = 'email'; // only select the 'title' column
		$criteria->condition = 'email=:email';
		$criteria->params    = array( ':email' => $this->username );

		$userModel = User::model()->find( $criteria );

		//print_r( $userModel );

		if ( $userModel === null ) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ( $userModel->checkPassword( $this->password ) ) {

			$this->user_id = $userModel->id;
			$this->setState( 'id', $userModel->id );
			$this->setState( 'first_name', $userModel->first_name );
			$this->setState( 'last_name', $userModel->last_name );
			$this->setState( 'email', $userModel->email );
			$this->setState( 'role', $userModel->role );
			$this->setState( 'current_order_id', $userModel->current_order_id );
			$this->errorCode = self::ERROR_NONE;

		} else {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}

		return ! $this->errorCode;
	}

	public function getId() {
		return $this->user_id;
	}


}

?>