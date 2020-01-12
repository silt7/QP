<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.CatalogMenuItem' );
Yii::import( 'application.models.Folder' );


class CatalogmenuController extends AdminController {


	/**
	 * Список элементов маню
	 */
	public function actionView() {

		$pageCriteria = new CDbCriteria;
		//$pageCriteria->condition = 'url=:url';
		//$pageCriteria->params    = array( ':url' => "main" );
		$pageCriteria->order = 'ordr ASC';

		$catalogMenuItems = CatalogMenuItem::model()->findAll( $pageCriteria );


		$this->pageTitle = "Редактирование меню каталога";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'catalogMenuItems' => $catalogMenuItems ) );
	}


	/**
	 * Редактирование элемента маню
	 */
	public function actionEdit( $id ) {

		$catalogMenuItem        = CatalogMenuItem::model()->findByPk( $id );
		$catalogMenuItem->title = str_replace( "\"", "&#34;", $catalogMenuItem->title );

		$this->pageTitle = "Редактирование цвета";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'catalogMenuItem' => $catalogMenuItem ) );
	}

	/**
	 * Создание элемента маню
	 */
	public function actionCreate() {

		$catalogMenuItem          = new CatalogMenuItem();
		$catalogMenuItem->title   = "Новый элемент";
		$catalogMenuItem->is_show = 0;
		$catalogMenuItem->link    = "";

		$catalogMenuItem->save();

		$url = $this->createAbsoluteUrl( 'admin/catalogmenu/edit' ) . '/' . $catalogMenuItem->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение элемента маню
	 */
	public function actionSave() {

		$folder = null;

		$id     = Yii::app()->request->getPost( "id" );
		$title  = Yii::app()->request->getPost( "title" );
		$link   = Yii::app()->request->getPost( "link" );
		$isShow = Yii::app()->request->getPost( "is_show" );
		$folder = Yii::app()->request->getPost( "folder" );

		if ( ! $folder ) {
			$folder = 0;
		}

		$title = str_replace( "\"", "&#34;", $title );

		$catalogMenuItem            = CatalogMenuItem::model()->findByPk( $id );
		$catalogMenuItem->title     = $title;
		$catalogMenuItem->link      = $link;
		$catalogMenuItem->folder_id = $folder;
		$catalogMenuItem->is_show   = $isShow;
		$catalogMenuItem->update();

		$url = $this->createAbsoluteUrl( 'admin/catalogmenu/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление элемента маню
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$catalogMenuItem = CatalogMenuItem::model()->findByPk( $id );
		if ( $catalogMenuItem ) {
			$catalogMenuItem->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/catalogmenu/view' );
		$this->redirect( $url, true );

	}

}