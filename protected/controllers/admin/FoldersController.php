<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Folder' );


class FoldersController extends AdminController {


	/**
	 * Список папок
	 */
	public function actionView() {

		$folderCriteria = new CDbCriteria;
		//$pageCriteria->condition = 'url=:url';
		//$pageCriteria->params    = array( ':url' => "main" );
		$folderCriteria->order = 'parent_id ASC';

		$folders = Folder::model()->findAll( $folderCriteria );


		$this->pageTitle = "Редактирование папок";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'folders' => $folders ) );
	}


	/**
	 * Редактирование папки
	 */
	public function actionEdit( $id ) {

		$folder        = Folder::model()->findByPk( $id );
		$folder->title = str_replace( "\"", "&#34;", $folder->title );

		$this->pageTitle = "Редактирование папки";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'folder' => $folder ) );
	}

	/**
	 * Создание папки
	 */
	public function actionCreate() {

		$folder          = new Folder();
		$folder->title   = "Новая папка";
		$folder->is_show = 0;
		$folder->img_alt = "";
		$folder->save();

		$url = $this->createAbsoluteUrl( 'admin/folders/edit' ) . '/' . $folder->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение папки
	 */
	public function actionSave() {

		$id             = Yii::app()->request->getPost( "id" );
		$model          = Yii::app()->request->getPost( "model" );
		$title          = Yii::app()->request->getPost( "title" );
		$content1          = Yii::app()->request->getPost( "content1" );
		$content2          = Yii::app()->request->getPost( "content2" );
		$isShow         = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$parentFolderId = Yii::app()->request->getPost( "parent_folder" ) ? Yii::app()->request->getPost( "parent_folder" ) : 0;
		$image          = $_FILES["image"]["name"];
		$img_alt          = Yii::app()->request->getPost( "img_alt" );

		$title = str_replace( "\"", "&#34;", $title );

		$folder            = Folder::model()->findByPk( $id );
		$folder->title     = $title;
		$folder->model     = $model;
		$folder->parent_id = $parentFolderId;
		$folder->is_show   = $isShow;
		$folder->img_alt   = $img_alt;
		$folder->content   = $content1;
		$folder->content2  = $content2;
		if ( $folder->update() ) {
			$image = $id . '.png';//md5( $color->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/folders/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$folder->image = $image;
			$folder->update();

		}

		$url = $this->createAbsoluteUrl( 'admin/folders/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление папки
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$folder = Folder::model()->findByPk( $id );
		if ( $folder ) {
			$folder->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/folders/view' );
		$this->redirect( $url, true );

	}

}