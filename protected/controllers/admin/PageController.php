<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Page' );


class PageController extends AdminController {


	/**
	 * Страницы
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$pages = Page::model()->findAll();

		$this->pageTitle = "Редактирование страниц";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'pages' => $pages ) );
	}


	/**
	 * Редактирование страницы
	 */
	public function actionEdit() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );

		$id = Yii::app()->getRequest()->getQuery( 'id' );


		$page = Page::model()->findByPk( $id );


		$this->pageTitle = "Редактирование страниы";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 'page' => $page ) );
	}

	/**
	 * Сохранение страницы
	 */
	public function actionSave() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );

		$id      = $_POST['id'];
		$title   = $_POST['title'];
		$content = $_POST['content'];
		$content2 = $_POST['content2'];
		$url     = $_POST['url'];
		$menu    = $_POST['menu'];
		$in_menu = isset( $_POST['in_menu'] ) ? $_POST['in_menu'] : 0;


		$page           = Page::model()->findByPk( $id );
		$page->title    = $title;
		$page->content  = $content;
		$page->content2 = $content2;
		$page->url      = $url;
		$page->in_menu  = $in_menu;
		$page->menu     = $menu;
		$page->update();

		$url = $this->createAbsoluteUrl( 'admin/page/view' );
		$this->redirect( $url, true );
		//print_r( $id );

		//$this->PAGE_TITLE = "Редактирование страниы";
		//$this->layout     = 'auth';
		//$this->render( 'edit', array( 'page' => $page ) );
	}

}