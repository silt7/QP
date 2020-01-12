<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.ModuleOption' );


class ModuleoptionsController extends AdminController {


	/**
	 * Список опций
	 */
	public function actionView() {

		$moduleOptionCriteria = new CDbCriteria;
		//$pageCriteria->condition = 'is_show=:is_show';
		//$pageCriteria->params    = array( ':is_show' => "1" );
		$moduleOptionCriteria->order = " 'group' ASC";

		$moduleOptions = ModuleOption::model()->findAll( $moduleOptionCriteria );


		$this->pageTitle = "Редактирование опций";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'moduleOptions' => $moduleOptions ) );
	}


	/**
	 * Редактирование опции
	 */
	public function actionEdit() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$moduleOptions        = ModuleOption::model()->findByPk( $id );
		$moduleOptions->title = str_replace( "\"", "&#34;", $moduleOptions->title );

		$this->pageTitle = "Редактирование опций";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'moduleOption' => $moduleOptions ) );
	}

	/**
	 * Создание опции
	 */
	public function actionCreate() {

		$moduleOption          = new ModuleOption();
		$moduleOption->title   = "Новая опция";
		$moduleOption->is_show = 0;
		$moduleOption->group   = '';
		$moduleOption->price   = 0;
		$moduleOption->save();

		$url = $this->createAbsoluteUrl( 'admin/moduleoptions/edit' ) . '/?id=' . $moduleOption->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение опции
	 */
	public function actionSave() {
		$id     = $_POST['id'];
		$title  = $_POST['title'];
		$price  = $_POST['price'];
		$group  = isset( $_POST['group'] ) ? $_POST['group'] : "";
		$prePay = $_POST['pre_pay'];
		$isShow = isset( $_POST['is_show'] ) ? $_POST['is_show'] : 0;
		$image  = $_FILES["image"]["name"];
		if(isset($_POST['del_img'])){
			$del_img = $_POST['del_img'];
		}else $del_img = "n";
			

		$title = str_replace( "\"", "&#34;", $title );

		$option          = ModuleOption::model()->findByPk( $id );
		$option->title   = $title;
		$option->price   = $price;
		$option->group   = $group;
		$option->pre_pay = $prePay;
		$option->is_show = $isShow;
		if ( $option->update() and $image != null ) {
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/options/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$option->image = $image;
			$option->update();
			
		}
		if(($image == null) and $del_img == "y"){
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/options/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			$option->image = "";
			$option->update();
		}
		$url = $this->createAbsoluteUrl( 'admin/moduleoptions/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление опции
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$moduleOption = ModuleOption::model()->findByPk( $id );
		if ( $moduleOption ) {
			$moduleOption->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/moduleoptions/view' );
		$this->redirect( $url, true );

	}

}