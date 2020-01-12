<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Cupboard' );
class CupboardController extends AdminController {
	/**
	 * Кухни
	 */
	public function actionView() {
		$cupboards = Cupboard::model()->findAll();
		$this->pageTitle = "Шкафы";
		$this->layout     = 'auth';
		$this->render( 'view', array('cupboards' => $cupboards) );
	}
	
	public function actionCreate() {
		$cupboard        = new Cupboard();
		$cupboard->title = "Новый шкаф";
		$cupboard->img_alt      = "";
		$cupboard->is_show = 0;
		$cupboard->save();

		$url = $this->createAbsoluteUrl( 'admin/cupboard/edit' ) . '/?id=' . $cupboard->id;
		$this->redirect( $url, true );

	}
	public function actionEdit() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$cupboard        = Cupboard::model()->findByPk( $id );
		$this->pageTitle = "Редактирование Шкафов";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'cupboard' => $cupboard));
	}
	public function actionSave() {
	    
		$id           = Yii::app()->request->getPost( "id" );
		$folderId     = Yii::app()->request->getPost( "folder_id" );
		$title        = Yii::app()->request->getPost( "title" );
		$description  = Yii::app()->request->getPost( "description" );
		$description2 = Yii::app()->request->getPost( "description2" );
		$isShow       = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$image        = $_FILES["image"]["name"];
		$itemPrice    = Yii::app()->request->getPost( "price" );
		$img_alt = Yii::app()->request->getPost( "img_alt" );
		$title       = str_replace( "\"", "&#34;", $title );

		$cupboard = Cupboard::model()->findByPk( $id );

		$cupboard->price        = $itemPrice;
		$cupboard->folder_id    = $folderId;
		$cupboard->title        = $title;
		$cupboard->description  = $description;
		$cupboard->description2 = $description2;
		$cupboard->img_alt = $img_alt;
		$cupboard->is_show = $isShow;
		if ( $cupboard->update() and $image != null ) {
			$image = $id . '.png';//md5( $color->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/cupboard/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$cupboard->image = $image;
			$cupboard->update();
		}

		$url = $this->createAbsoluteUrl( 'admin/cupboard/view' );
		$this->redirect( $url, true );
	}
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$itemCupboard = Cupboard::model()->findByPk( $id );
		if ( $itemCupboard ) {
		    $path = Yii::getPathOfAlias( 'webroot' ) . '/images/cupboard/' . $itemCupboard->image;
		    if((file_exists($path))and($itemCupboard->image != "")){
		        unlink($path);
		    }
			$itemCupboard->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/cupboard/view' );
		$this->redirect( $url, true );

	}
}

?>