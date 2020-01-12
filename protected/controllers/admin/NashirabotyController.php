<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.NashiRaboty' );

class NashirabotyController extends AdminController {
	public function actionEdit() {
		$nashirabotyCriteria            = new CDbCriteria;
		$nashirabotyCriteria->condition = 'parent_id=""';
		$nashirabotyCriteria->order = 'id desc';
		$nashiraboty     = NashiRaboty::model()->findAll($nashirabotyCriteria);
		$this->pageTitle = "Наши работы";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'nashiraboty' => $nashiraboty )  );
	}
	public function actionAddImage() {
		$images    = $_FILES["image"]["tmp_name"];
		$idParent = Yii::app()->request->getPost( 'id' );
		if ($images != null ) {
			foreach($images as $image){
				if ($image != null ) {
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/nashiraboty/';
					if(file_exists($path)){
						$nashiraboty     = new NashiRaboty();
						if(!empty($idParent)){
							$nashiraboty->parent_id = $idParent;
						}						
						$nashiraboty->save();
						$id = Yii::app()->db-> getLastInsertID();
						move_uploaded_file( $image, $path."$id.jpg" );
					}
				}
			}			
		}
		$url = $this->createAbsoluteUrl( 'admin/nashiraboty/edit' );
		$this->redirect( $url, true );
	}
	public function actionSave() {
		$id = Yii::app()->request->getPost( 'id' );
		$val = Yii::app()->request->getPost( 'val' );
		$nashiraboty     = NashiRaboty::model()->findByPk($id);
		if($val != 'del'){			
			$val == 0 ? $val = 1 : $val = 0;
			$nashiraboty -> is_show = $val;	
			$nashiraboty -> save();
		}
		else{
			$nashiraboty->delete();
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/nashiraboty/'.$id.'.jpg';
			if(file_exists($path)){
				unlink($path);
			}
		}
	}
}
?>