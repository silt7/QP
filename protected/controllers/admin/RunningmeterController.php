<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.RunningMeter' );


class RunningmeterController extends AdminController {


	/**
	 * Слайды
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$runningMeters = RunningMeter::model()->findAll();

		$this->pageTitle = "Погонные метры на главной";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'runningMeters' => $runningMeters ) );
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


		$runningMeter        = RunningMeter::model()->findByPk( $id );
		$runningMeter->title = str_replace( "\"", "&#34;", $runningMeter->title );
		$runningMeter->text  = str_replace( "\"", "&#34;", $runningMeter->text );

		$this->pageTitle = "Редактирование слайда";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 'runningMeter' => $runningMeter ) );
	}

	/**
	 * Создание слайда
	 */
	public function actionCreate() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$slide          = new RunningMeter();
		$slide->title   = "Новый погонный метр";
		$slide->text    = " ";
		$slide->is_show = 0;
		$slide->save();

		$url = $this->createAbsoluteUrl( 'admin/runningMeter/edit' ) . '/?id=' . $slide->id;
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

		$slide          = RunningMeter::model()->findByPk( $id );
		$slide->title   = $title;
		$slide->text    = $text;
		$slide->is_show = $isShow;
		if ( $slide->update() and $image != null ) {
		    $type = substr($image,strripos($image,'.')-strlen($image));
			$image = md5( $slide->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/running-meter/' . $image . $type;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$slide->image = $image . $type;
			$slide->update();
		}

		$url = $this->createAbsoluteUrl( 'admin/runningMeter/view' );
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

		$action = RunningMeter::model()->findByPk( $id );
		if ( $action ) {
			$action->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/runningMeter/view' );
		$this->redirect( $url, true );

	}

}