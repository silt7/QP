<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Slider' );


class SliderController extends AdminController {


	/**
	 * Слайды
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$sliderCriteria            = new CDbCriteria;
		$sliderCriteria->order = 'orderIMG ASC';
		$slider = Slider::model()->findAll($sliderCriteria);
		
		$this->pageTitle = "Редактирование слайдов";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'slider' => $slider ) );
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


		$slide        = Slider::model()->findByPk( $id );
		$slide->title = str_replace( "\"", "&#34;", $slide->title );
		$slide->text  = str_replace( "\"", "&#34;", $slide->text );

		$this->pageTitle = "Редактирование слайда";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 'slide' => $slide ) );
	}

	/**
	 * Создание слайда
	 */
	public function actionCreate() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$slide          = new Slider();
		$slide->title   = "Новый слайд";
		$slide->text    = " ";
		$slide->link    = "";
		$slide->img_alt   = "";
		$slide->is_show = 0;
		$slide->orderIMG = 0;
		$slide->save();

		$url = $this->createAbsoluteUrl( 'admin/slider/edit' ) . '/?id=' . $slide->id;
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
		$link   = $_POST['link'];
		$order   = $_POST['order'];
		$img_alt = $_POST['img_alt'];
		$isShow = isset( $_POST['is_show'] ) ? $_POST['is_show'] : 0;
		$image  = $_FILES["image"]["name"];

		$title = str_replace( "\"", "&#34;", $title );
		$text  = str_replace( "\"", "&#34;", $text );

		$slide          = Slider::model()->findByPk( $id );
		$slide->title   = $title;
		$slide->text    = $text;
		$slide->link    = $link;
		$slide->orderIMG = $order;
		$slide->img_alt = $img_alt;
		$slide->is_show = $isShow;
		if ( $slide->update() and $image != null ) {
			$image = $slide->id . '.jpg';//md5( $slide->title + $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/slider/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$slide->image = $image;
			$slide->update();
		}

		$url = $this->createAbsoluteUrl( 'admin/slider/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление слайда
	 */
	public function actionDelete() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$action = Slider::model()->findByPk( $id );
		if ( $action ) {
			$action->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/slider/view' );
		$this->redirect( $url, true );

	}

}