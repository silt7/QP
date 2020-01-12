<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.HowOrder' );

class HoworderController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;

		$HowOrder = HowOrder::model()->findAll( $pageCriteria );


		$this->pageTitle = "Как правильно заказать кухню?";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'HowOrder' => $HowOrder ) );
	}
 	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );
		$HowOrder      = HowOrder::model()->findByPk( $id );
		$this->pageTitle = "Как правильно заказать кухню?";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'HowOrder' => $HowOrder )  );
	}

	public function actionCreate() {

		$HowOrder           = new HowOrder();
		$HowOrder->title    = "New";
		$HowOrder->is_show  = 0;
		$HowOrder->description     = '';
		$Image = array();
		$HowOrder->image = serialize($Image);
		$HowOrder->save();
		$url = $this->createAbsoluteUrl( 'admin/howorder/edit' ) . '/?id=' . $HowOrder->id;
		$this->redirect( $url, true );

	}
	public function actionSave() {
		$news_id = Yii::app()->request->getPost( 'id' );
		$newsTitle = Yii::app()->request->getPost( 'title' );
		$text      = Yii::app()->request->getPost( 'description' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		$image    = $_FILES["image"]["tmp_name"];
		$HowOrder = HowOrder::model()->findByPk( $news_id );
		$HowOrder->title = $newsTitle;
		$HowOrder->description = $text;
		$HowOrder->is_show = $isShow;
		
		if ($image != null ) {			
			$imageName = date("YmdHis").rand(100,999).".png";
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/new/' . $imageName;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $image, $path );		
			$HowOrder->image = $imageName;
		}

		$HowOrder->update();
		$url = $this->createAbsoluteUrl( 'admin/howorder/view' );
		$this->redirect( $url, true );
	}
 	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$HowOrder = HowOrder::model()->findByPk( $id );
		if ( $HowOrder ) {
			$HowOrder->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/howorder/view' );
		$this->redirect( $url, true );

	}  
}
?>