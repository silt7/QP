<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.components.CImageHandler' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.OurColors' );
Yii::import( 'application.models.Color' );

class OurcolorsController extends AdminController {
	public function actionView() {		
		$pageCriteria = new CDbCriteria;

		$OurColors = OurColors::model()->findAll( $pageCriteria );


		$this->pageTitle = "Редактирование раздела: Наши цвета";
		$this->layout    = 'auth';
		$this->render( 'view', array('OurColors' => $OurColors) );
	}
	public function actionEdit($id) {
		$OurColors        = OurColors::model()->findByPk( $id );
		$this->pageTitle = "Наши цвета";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'OurColors' => $OurColors )  );
	}
	public function actionCreate() {
		$OurColors = new OurColors();
		$OurColors->name_categ    = "New";
		$OurColors->is_show  = 0;
		$OurColors->content     = '';
		$OurColors->content2    = '';
		$Colors = array();
		$OurColors->colors = serialize($Colors);
		$OurColors->save();
		$this->render( 'view', array() );
	}
	public function actionSave() {
		$id = Yii::app()->request->getPost( 'id' );
		$Title = Yii::app()->request->getPost( 'title' );
		$text      = Yii::app()->request->getPost( 'content' );
		$text2      = Yii::app()->request->getPost( 'content2' );
		$isShow    = Yii::app()->request->getPost( "is_show" );
		//$images    = $_FILES["image"]["tmp_name"];
		$OurColors = OurColors::model()->findByPk( $id );
		$OurColors->name_categ = $Title;
		$OurColors->content = $text;
		$OurColors->content2 = $text2;
		$OurColors->is_show = $isShow;
		
		$arr = unserialize($OurColors -> colors);
		
		for($i = 0; $i<count($arr); $i++){
			$arr[$i]['name'] = Yii::app()->request->getPost( 'nameColor_'.$i );
		}
		for($i = 0; $i<count($arr); $i++){
			$image   = $_FILES["imageColor_".$i]["tmp_name"];
			if ($image != null ) {
				$imageName = date("YmdHis").rand(100,999).".png";
				$path = Yii::getPathOfAlias( 'webroot' ) . "/images/ourcolors/" . $imageName;
				move_uploaded_file( $image, $path );
				$oldPath = Yii::getPathOfAlias( 'webroot' ) . "/images/ourcolors/" . $arr[$i]['pathImg'];
				$arr[$i]['pathImg'] = $imageName;
				if(file_exists($oldPath)){
					unlink($oldPath);		
				}
			}
		}
		for($i = 0; $i<count($arr); $i++){
			if(Yii::app()->request->getPost( 'delColor_'.$i ) != null){
				$imageName = $arr[$i]['pathImg'];
				$PathImg = Yii::getPathOfAlias( 'webroot' ) . "/images/ourcolors/" . $imageName;
				if(file_exists($PathImg)){
					unlink($PathImg);		
				}
				unset($arr[$i]);
				
			}
		}
		$arr2 = array();
		foreach($arr as $item){
			array_push($arr2, $item);
		}
		$OurColors->colors = serialize($arr2);
		/**удаление отмеченных картинок*
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
					}
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
		/**END удаление отмеченных картинок*
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
		*/
		$OurColors->update();
		$this->render( 'view', array() );
	}
 	public function actionDelete($id) {
		$OurColors = OurColors::model()->findByPk( $id );
		if ( $OurColors ) {
			$OurColors->delete();
		}
		$this->render( 'view', array() );
	} 
	public function actionAddcolor(){
		$idColor = Yii::app()->getRequest()->getPost( 'idColor' );
		$idCateg = Yii::app()->getRequest()->getPost( 'idCateg' );
		$OurColors = OurColors::model()->findByPk( $idCateg );
		$Color = Color::model()->findByPk( $idColor );
		$arr = unserialize($OurColors->colors);
		$pathImg = Yii::getPathOfAlias( 'webroot' ) . "/images/colors/" . $Color -> image . ".png";
		$imageName = date("YmdHis").rand(100,999).".png";
		$newPathImg = Yii::getPathOfAlias( 'webroot' ) . "/images/ourcolors/" . $imageName;
		copy($pathImg, $newPathImg);
		$arr2 =  array('name' => $Color -> title, 'pathImg' => $imageName);
		array_push($arr, $arr2);
		$OurColors -> colors = serialize($arr);
		$OurColors -> update();
		$i = 0;
		$p = "";
	    foreach($arr as $item){
			$p = $p."<div class='color_item' style='width:125px;'>
					<img src='/images/ourcolors/".$item['pathImg']."'>
					<input type='text' name='nameColor_".$i."' class='form-control' value='".$item['name']."'> 
					<input type='file' name='imageColor_".$i."'>  
					Пометить на удаление <input type='checkbox' name='delColor_".$i."'>
					</div>";
			$i++;				
		}
		echo $p;
	}
}
?>