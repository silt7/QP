<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Action' );


class ActionController extends AdminController {


	/**
	 * Акции
	 */
	public function actionView() {
		$actions = Action::model()->findAll();

		$this->pageTitle = "Редактирование акция";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'actions' => $actions ) );
	}


	/**
	 * Редактирование акции
	 */
	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );


		$action             = Action::model()->findByPk( $id );
		$action->title      = str_replace( "\"", "&#34;", $action->title );
		$action->text       = str_replace( "\"", "&#34;", $action->text );
		$action->short_text = str_replace( "\"", "&#34;", $action->short_text );

		$this->pageTitle = "Редактирование акции";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'action' => $action ) );
	}

	/**
	 * Создание акции
	 */
	public function actionCreate() {


		$action             = new Action();
		$action->title      = "Новая акция";
		$action->short_text = "";
		$action->text       = "";
		$action->is_show    = 0;
		$action->save();

		$url = $this->createAbsoluteUrl( 'admin/action/edit' ) . '/?id=' . $action->id;
		$this->redirect( $url, true );
	}

	/**
	 * Сохранение акции
	 */
	public function actionSave() {

		$id        = $_POST['id'];
		$title     = $_POST['title'];
		$shortTest = $_POST['short_text'];
		$text      = $_POST['text'];
		$isShow    = isset( $_POST['is_show'] ) ? $_POST['is_show'] : 0;

		$title     = str_replace( "\"", "&#34;", $title );
		$text      = str_replace( "\"", "&#34;", $text );
		$shortTest = str_replace( "\"", "&#34;", $shortTest );

		$page             = Action::model()->findByPk( $id );
		$page->title      = $title;
		$page->short_text = $shortTest;
		$page->text       = $text;
		$page->is_show    = $isShow;
		$page->update();

		$url = $this->createAbsoluteUrl( 'admin/action/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление акции
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$action = Action::model()->findByPk( $id );
		if ( $action ) {
			$action->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/action/view' );
		$this->redirect( $url, true );

	}

}