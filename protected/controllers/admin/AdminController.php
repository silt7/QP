<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.models.User' );


class AdminController extends Controller {

	public function init() {
		parent::init();
		if ( ! $this->checkRole( "admin" ) ) {
			$this->redirect( "/", true );
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
			return User::checkRole( $role, Yii::app()->user->role );
		}
	}

	/**
	 *  Панель управления сайтом
	 */
	public function actionDashboard() {

		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}

		$this->pageTitle = "Панель управления сайтом";
		$this->render( 'dashboard' );
	}


}