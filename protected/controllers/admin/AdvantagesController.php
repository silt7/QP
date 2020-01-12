<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Advantages' );


class AdvantagesController extends AdminController {


	/**
	 * Слайды
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$advantages = Advantages::model()->findAll();

		$this->pageTitle = "Преимущества на главной";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'advantages' => $advantages ) );
	}


	/**
	 * Редактирование слайда
	 */
	public function actionEdit() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );

		$id = Yii::app()->getRequest()->getQuery( 'id' );


		$advantages        = Advantages::model()->findByPk( $id );
		$advantages->title = str_replace( "\"", "&#34;", $advantages->title );
		$advantages->text  = str_replace( "\"", "&#34;", $advantages->text );

		$this->pageTitle = "Редактирование записи";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 'advantages' => $advantages ) );
	}

	/**
	 * Создание слайда
	 */
	public function actionCreate() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$advantages          = new Advantages();
		$advantages->title   = "Новая запись";
		$advantages->text    = " ";
		$advantages->is_show = 0;
		$advantages->save();

		$url = $this->createAbsoluteUrl( 'admin/advantages/edit' ) . '/?id=' . $advantages->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение слайда
	 */
	public function actionSave() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );

		$id     = $_POST['id'];
		$title  = $_POST['title'];
		$text   = $_POST['text'];
		$isShow = isset( $_POST['is_show'] ) ? $_POST['is_show'] : 0;
		$image  = $_FILES["image"]["name"];

		$title = str_replace( "\"", "&#34;", $title );
		$text  = str_replace( "\"", "&#34;", $text );

		$advantages          = Advantages::model()->findByPk( $id );
		$advantages->title   = $title;
		$advantages->text    = $text;
		$advantages->is_show = $isShow;
		if ( $advantages->update() and $image != null ) {
		    $type = substr($image,strripos($image,'.')-strlen($image));
			$image = md5( $advantages->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/advantages/' . $image . $type;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$advantages->image = $image . $type;
			$advantages->update();
		}

		$url = $this->createAbsoluteUrl( 'admin/advantages/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление слайда
	 */
	public function actionDelete() {
		if ( ! $this->checkRole( "admin" ) ) {
			$this->redirect( "/", true );
		}
		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$action = Advantages::model()->findByPk( $id );
		if ( $action ) {
			$action->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/advantages/view' );
		$this->redirect( $url, true );

	}

}