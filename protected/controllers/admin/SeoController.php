<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Seo' );


class SeoController extends AdminController {


	/**
	 * Слайды
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		
		$seo = Seo::model()->findAll();
		

		$this->pageTitle = "SEO";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'seo' => $seo ) );
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
		$seo        = Seo::model()->findByPk( $id );
		$this->pageTitle = "Редактирование записи";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 'seo' => $seo ) );
	}

	/**
	 * Создание слайда
	 */
	public function actionCreate() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$seo          = new Seo();
		$seo->url   = "/example";
		$seo->title   = "example";
		$seo->keywords   = "example";
		$seo->save();

		$url = $this->createAbsoluteUrl( 'admin/seo/edit' ) . '/?id=' . $seo->id;
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
		$url   = $_POST['url'];
		$desription = $_POST['desription'];
		$keywords = $_POST['keywords'];

		$seo          = Seo::model()->findByPk( $id );
		$seo->title   = $title;
		$seo->url    = $url;
		$seo->desription = $desription;
		$seo->keywords = $keywords;
		$seo->update();

		$url = $this->createAbsoluteUrl( 'admin/seo/view' );
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

		$action = Seo::model()->findByPk( $id );
		if ( $action ) {
			$action->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/seo/view' );
		$this->redirect( $url, true );

	}

}