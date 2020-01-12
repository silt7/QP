<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.WhyOrder' );

class WhyorderController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;

		$WhyOrder = WhyOrder::model()->findAll( $pageCriteria );


		$this->pageTitle = "Как правильно заказать кухню?";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'WhyOrder' => $WhyOrder ) );
	}
 	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );
		$WhyOrder      = WhyOrder::model()->findByPk( $id );
		$this->pageTitle = "Как правильно заказать кухню?";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'WhyOrder' => $WhyOrder )  );
	}

	public function actionCreate() {

		$WhyOrder           = new WhyOrder();
		$WhyOrder->title    = "New";
		$WhyOrder->is_show  = 0;
		$WhyOrder->description     = '';
		$WhyOrder->image = '';
		$WhyOrder->save();
		$url = $this->createAbsoluteUrl( 'admin/whyorder/edit' ) . '/?id=' . $WhyOrder->id;
		$this->redirect( $url, true );

	}
	public function actionSave() {
		$news_id = Yii::app()->request->getPost( 'id' );
		$newsTitle = Yii::app()->request->getPost( 'title' );
		$text      = Yii::app()->request->getPost( 'description' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		$image    = $_FILES["image"]["tmp_name"];
		$WhyOrder = WhyOrder::model()->findByPk( $news_id );
		$WhyOrder->title = $newsTitle;
		$WhyOrder->description = $text;
		$WhyOrder->is_show = $isShow;
		
		if ($image != null ) {			
			$imageName = date("YmdHis").rand(100,999).".png";
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/new/' . $imageName;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $image, $path );		
			$WhyOrder->image = $imageName;
		}

		$WhyOrder->update();
		$url = $this->createAbsoluteUrl( 'admin/whyorder/view' );
		$this->redirect( $url, true );
	}
 	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$WhyOrder = WhyOrder::model()->findByPk( $id );
		if ( $WhyOrder ) {
			$WhyOrder->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/whyorder/view' );
		$this->redirect( $url, true );

	}  
}
?>