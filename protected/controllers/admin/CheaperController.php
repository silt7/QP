<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Cheaper' );

class CheaperController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;

		$cheaper = Cheaper::model()->findAll( $pageCriteria );


		$this->pageTitle = "Как заказать дешевле";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'cheaper' => $cheaper ) );
	}
	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );
		$cheaper        = Cheaper::model()->findByPk( $id );
		$this->pageTitle = "Как заказать дешевле";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'cheaper' => $cheaper )  );
	}
	public function actionCreate() {

		$cheaper           = new Cheaper();
		$cheaper->title    = "New";
		$cheaper->is_show  = 0;
		$cheaper->description     = '';
		$Image = array();
		$cheaper->img = serialize($Image);
		$cheaper->save();
		$url = $this->createAbsoluteUrl( 'admin/cheaper/edit' ) . '/?id=' . $cheaper->id;
		$this->redirect( $url, true );

	}
	public function actionSave() {
		$cheaper_id = Yii::app()->request->getPost( 'id' );
		$cheaperTitle = Yii::app()->request->getPost( 'title' );
		$text      = Yii::app()->request->getPost( 'cheaper' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		$seo       = Yii::app()->request->getPost( "seo" );
		$images    = $_FILES["image"]["tmp_name"];
		$cheaper = Cheaper::model()->findByPk( $cheaper_id );
		$imagesDB = unserialize($cheaper->img);
		$cheaper->title = $cheaperTitle;
		$cheaper->description = $text;
		$cheaper->is_show = $isShow;
		
		/**удаление отмеченных картинок**/
		foreach($imagesDB as $imageDB){
			if (isset($_POST[str_replace(".","",$imageDB)])){
				if($_POST[str_replace(".","",$imageDB)] == 1){
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/cheaper/' . $imageDB;
					if(file_exists($path)){
						unlink($path);
					}
					/*$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/preview/' . $imageDB;
					if(file_exists($pathPrev)){
						unlink($pathPrev);
					}*/
					$key = array_search($imageDB, $imagesDB);
					if ($key !== false)
					{
						unset($imagesDB[$key]);
					}
				}
			}
		}
		$cheaper->img = serialize($imagesDB); 
		$cheaper->update(); 
		/**END удаление отмеченных картинок**/
		$imagesDB = unserialize($cheaper->img);
		if ($images != null ) {
			foreach($images as $image){
				if ($image != null ) {
					$imageName = date("YmdHis").rand(100,999).".png";
					echo $imageName."<br>";
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/cheaper/' . $imageName;
					//$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/cheaper/preview/' . $imageName;
					if(file_exists($path)){
						unlink($path);
					}
					move_uploaded_file( $image, $path );
					//Yii::app()->ih->load($path)->thumb('75', '75')->save($pathPrev);
					array_push($imagesDB, $imageName);
				}
			}
			$cheaper->img = serialize($imagesDB);
		}
		$cheaper->update();
		$url = $this->createAbsoluteUrl( 'admin/cheaper/view' );
		$this->redirect( $url, true );
	}
 	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$cheaper = Cheaper::model()->findByPk( $id );
		if ( $cheaper ) {
			$cheaper->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/cheaper/view' );
		$this->redirect( $url, true );

	} 
}
?>