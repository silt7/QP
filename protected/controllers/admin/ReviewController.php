<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Review' );

class ReviewController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;
		$pageCriteria->order = 'id desc';

		$reviews = Review::model()->findAll( $pageCriteria );


		$this->pageTitle = "Редактирование отзывов";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'reviews' => $reviews ) );
	}
	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );
		$review        = Review::model()->findByPk( $id );
		$this->pageTitle = "Редактирование отзывов";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'review' => $review )  );
	}
	public function actionSave() {
		$review_id = Yii::app()->request->getPost( 'id' );
		$fio = Yii::app()->request->getPost( 'fio' );
		$text      = Yii::app()->request->getPost( 'review' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		$seo       = Yii::app()->request->getPost( "seo" );
		$img_alt       = Yii::app()->request->getPost( "img_alt" );
		$agreement       = Yii::app()->request->getPost( "agreement" );
		$images    = $_FILES["image"]["tmp_name"];
		$review = Review::model()->findByPk( $review_id );
		$imagesDB = unserialize($review->img);
		$review->fio = $fio;
		$review->text = $text;
		$review->is_show = $isShow;
		$review->img_alt = $img_alt;
		$review->Agreement = $agreement;
		
		/**удаление отмеченных картинок**/
		foreach($imagesDB as $imageDB){
			if (isset($_POST[str_replace(".","",$imageDB)])){
				if($_POST[str_replace(".","",$imageDB)] == 1){
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/' . $imageDB;
					if(file_exists($path)){
						unlink($path);
					}
					$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/preview/' . $imageDB;
					if(file_exists($pathPrev)){
						unlink($pathPrev);
					}
					$key = array_search($imageDB, $imagesDB);
					if ($key !== false)
					{
						unset($imagesDB[$key]);
					}
				}
			}
		}
		$review->img = serialize($imagesDB); 
		$review->update(); 
		/**END удаление отмеченных картинок**/
		$imagesDB = unserialize($review->img);
		if ($images != null ) {
			foreach($images as $image){
				if ($image != null ) {
					$imageName = date("YmdHis").rand(100,999).".png";
					echo $imageName."<br>";
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/' . $imageName;
					//$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/review/preview/' . $imageName;
					if(file_exists($path)){
						unlink($path);
					}
					move_uploaded_file( $image, $path );
					//Yii::app()->ih->load($path)->thumb('75', '75')->save($pathPrev);
					array_push($imagesDB, $imageName);
				}
			}
			$review->img = serialize($imagesDB);
		}
		$review->update();
		$url = $this->createAbsoluteUrl( 'admin/review/view' );
		$this->redirect( $url, true );
	}
 	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$review = Review::model()->findByPk( $id );
		if ( $review ) {
			$review->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/review/view' );
		$this->redirect( $url, true );

	} 
}
?>