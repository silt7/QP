<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.News' );

class NewsController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;

		$news = News::model()->findAll( $pageCriteria );


		$this->pageTitle = "Редактирование новостей";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'news' => $news ) );
	}
	public function actionEdit() {
		$id = Yii::app()->getRequest()->getQuery( 'id' );
		$news        = News::model()->findByPk( $id );
		$this->pageTitle = "Редактирование новостей";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'news' => $news )  );
	}
	public function actionCreate() {

		$News           = new News();
		$News->title    = "New";
		$News->is_show  = 0;
		$News->description     = '';
		$Image = array();
		$News->img = serialize($Image);
		$News->save();
		$url = $this->createAbsoluteUrl( 'admin/news/edit' ) . '/?id=' . $News->id;
		$this->redirect( $url, true );

	}
	public function actionSave() {
		$news_id = Yii::app()->request->getPost( 'id' );
		$newsTitle = Yii::app()->request->getPost( 'title' );
		$text      = Yii::app()->request->getPost( 'news' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		$seo       = Yii::app()->request->getPost( "seo" );
		$images    = $_FILES["image"]["tmp_name"];
		$news = News::model()->findByPk( $news_id );
		$imagesDB = unserialize($news->img);
		$news->title = $newsTitle;
		$news->description = $text;
		$news->is_show = $isShow;
		
		/**удаление отмеченных картинок**/
		foreach($imagesDB as $imageDB){
			if (isset($_POST[str_replace(".","",$imageDB)])){
				if($_POST[str_replace(".","",$imageDB)] == 1){
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/news/' . $imageDB;
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
		$news->img = serialize($imagesDB); 
		$news->update(); 
		/**END удаление отмеченных картинок**/
		$imagesDB = unserialize($news->img);
		if ($images != null ) {
			foreach($images as $image){
				if ($image != null ) {
					$imageName = date("YmdHis").rand(100,999).".png";
					echo $imageName."<br>";
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/news/' . $imageName;
					//$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/news/preview/' . $imageName;
					if(file_exists($path)){
						unlink($path);
					}
					move_uploaded_file( $image, $path );
					//Yii::app()->ih->load($path)->thumb('75', '75')->save($pathPrev);
					array_push($imagesDB, $imageName);
				}
			}
			$news->img = serialize($imagesDB);
		}
		$news->update();
		$url = $this->createAbsoluteUrl( 'admin/news/view' );
		$this->redirect( $url, true );
	}
 	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$news = News::model()->findByPk( $id );
		if ( $news ) {
			$news->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/news/view' );
		$this->redirect( $url, true );

	} 
}
?>