<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Color' );
Yii::import( 'application.models.DecorCategories' );


class ColorController extends AdminController {


	/**
	 * Список цветов
	 */
	public function actionView() {

		$pageCriteria = new CDbCriteria;
		//$pageCriteria->condition = 'url=:url';
		//$pageCriteria->params    = array( ':url' => "main" );
		$pageCriteria->order = 'type ASC, material ASC';

		$colors = Color::model()->findAll( $pageCriteria );


		$this->pageTitle = "Редактирование цветов";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'colors' => $colors ) );
	}


	/**
	 * Редактирование цвета
	 */
	public function actionEdit() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );
        $decorCategories = array();

		$color        = Color::model()->findByPk( $id );
		if($color->title == null){
		$color->title = 'Not Found';
		}
		$color->title = str_replace( "\"", "&#34;", $color->title );
	
		$Criteria = new CDbCriteria;
		$Criteria->condition = 'id_color=:id_color';
		$Criteria->params    = array( ':id_color' => $id );

	    $decorCategories = DecorCategories::model()->findAll( $Criteria );


		$this->pageTitle = "Редактирование цвета";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'color' => $color, 'decorCategories' =>  $decorCategories) );
	}

	/**
	 * Создание цвета
	 */
	public function actionCreate() {

		$color           = new Color();
		$color->title    = "Новый цвет";
		$color->is_show  = 0;
		$color->type     = '';
		$color->material = '';
		$color->image    = '';
		$color->save();

		$url = $this->createAbsoluteUrl( 'admin/color/edit' ) . '/?id=' . $color->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение цвета
	 */
	public function actionSave() {

		$id       = Yii::app()->request->getPost( "id" );
		$title    = Yii::app()->request->getPost( "title" );
		$material = Yii::app()->request->getPost( "material" ) ? Yii::app()->request->getPost( "material" ) : "";
		//$type     = isset( $_POST['type'] ) ? $_POST['type'] : "";
		$isShow      = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$isFront     = Yii::app()->request->getPost( "is_front" ) ? Yii::app()->request->getPost( "is_front" ) : 0;
		$isModule    = Yii::app()->request->getPost( "is_module" ) ? Yii::app()->request->getPost( "is_module" ) : 0;
		$isTabletop  = Yii::app()->request->getPost( "is_tabletop" ) ? Yii::app()->request->getPost( "is_tabletop" ) : 0;
		$isWallPanel = Yii::app()->request->getPost( "is_wall_panel" ) ? Yii::app()->request->getPost( "is_wall_panel" ) : 0;
		$isAccessory = Yii::app()->request->getPost( "is_accessory" ) ? Yii::app()->request->getPost( "is_accessory" ) : 0;
		$image       = $_FILES["image"]["name"];
		if(isset($_POST['del_img'])){
			$del_img = $_POST['del_img'];
		}else $del_img = "n";
		
		$title = str_replace( "\"", "&#34;", $title );

		$color                = Color::model()->findByPk( $id );
		$color->title         = $title;
		$color->material      = $material;
		$color->is_front      = $isFront;
		$color->is_module     = $isModule;
		$color->is_tabletop   = $isTabletop;
		$color->is_wall_panel = $isWallPanel;
		$color->is_accessory  = $isAccessory;
		//$color->type     = $type;
		$color->is_show = $isShow;
		if ( $color->update() and $image != null ) {
			$image = $id.'.png';//md5( $color->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/colors/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$color->image = $id;
			$color->update();

		}
		if(($image == null) and $del_img == "y"){
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/colors/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			$color->image = "";
			$color->update();
		}
		$url = $this->createAbsoluteUrl( 'admin/color/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление цвета
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$color = Color::model()->findByPk( $id );
		if ( $color ) {
			$color->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/color/view' );
		$this->redirect( $url, true );

	}
	
	public function actionAddCateg(){
        if((isset($_POST['id_color']))and(isset($_POST['categ']))){
            $Criteria = new CDbCriteria;
    		$Criteria->condition = 'id_color=:id_color and categ=:categ';
    		$Criteria->params    = array( ':id_color' => $_POST['id_color'],':categ'=> $_POST['categ']);
            $DecorCategories = DecorCategories::model()->findAll( $Criteria );
    	    if(empty($DecorCategories)){
        	    $DecorCategories = new DecorCategories();
        	    $DecorCategories -> id_color = $_POST['id_color'];
        	    $DecorCategories -> categ = $_POST['categ'];
        	    $DecorCategories -> save(); 
        	    echo $this->messageJsonOk('Добавлено');
    	    }
    	    else{
    	        echo $this->messageJsonOk('Уже добавлено!');
    	    }

        }
	}

}