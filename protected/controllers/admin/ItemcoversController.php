<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Tabletop' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Folder' );


class ItemcoversController extends AdminController {


	/**
	 * Столешницы
	 */
	public function actionView() {

		$itemTabletops = ItemCover::model()->findAll();

		$this->pageTitle = "Редактирование столешниц";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'items' => $itemTabletops ) );
	}


	/**
	 * Редактирование столешницы
	 */
	public function actionEdit( $id ) {

		$itemTabletop              = ItemCover::model()->findByPk( $id );
		$itemTabletop->title       = str_replace( "\"", "&#34;", $itemTabletop->title );
		$itemTabletop->description = str_replace( "\"", "&#34;", $itemTabletop->description );
		$itemTabletop->description2= str_replace( "\"", "&#34;", $itemTabletop->description2);

		$tabletopsCriteria            = new CDbCriteria;
		$tabletopsCriteria->condition = 'is_show=1 and is_tabletop=\'1\'';
		$tabletopsCriteria->order     = "material";
		$colors                       = Color::model()->findAll( $tabletopsCriteria );


		$optionsColorCriteria            = new CDbCriteria;
		$optionsColorCriteria->condition = 'is_show=:is_show';
		$optionsColorCriteria->params    = array( ':is_show' => "1" );
		$options                         = ModuleOption::model()->findAll( $optionsColorCriteria );

		$this->pageTitle = "Редактирование покрытий";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'item' => $itemTabletop, 'colors' => $colors, 'options' => $options ) );
	}

	/**
	 * Создание столешницы
	 */
	public function actionCreate() {

		$itemTabletop              = new ItemCover();
		$itemTabletop->title       = "Новое покрытие";
		$itemTabletop->description = " ";
		$itemTabletop->description2= " ";
		$itemTabletop->is_show     = 0;
		$itemTabletop->img_alt = "";
		$itemTabletop->save();

		$url = "/admin/item-covers/edit/" . $itemTabletop->id;//$this->createAbsoluteUrl( 'admin/itemtabletops/edit' ) . '/' . $itemTabletop->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение столешницы
	 */
	public function actionSave() {

		$id          = Yii::app()->request->getPost( "id" );
		$title       = Yii::app()->request->getPost( "title" );
		$description = Yii::app()->request->getPost( "description" );
		$description2= Yii::app()->request->getPost( "description2" );
		$isShow      = Yii::app()->request->getPost( "is_show" );
		$prePay      = Yii::app()->request->getPost( "pre_pay" );
		$folder      = Yii::app()->request->getPost( "folder" );
		$extraSize   = Yii::app()->request->getPost( "extra_size" );
		$img_alt   = Yii::app()->request->getPost( "img_alt" );
		if(isset($_POST['del_img'])){
			$del_img = $_POST['del_img'];
		}else $del_img = "n";

		if ( is_null( $isShow ) ) {
			$isShow = 0;
		}
		if ( is_null( $extraSize ) ) {
			$extraSize = 0;
		}
		$image       = $_FILES["image"]["name"];
		$optionsPost = Yii::app()->request->getPost( "options" );
		$colorsPost  = Yii::app()->request->getPost( "colors" );


		$title       = str_replace( "\"", "&#34;", $title );
		//$description = str_replace( "\"", "&#34;", $description );

		$itemTabletop = ItemCover::model()->findByPk( $id );

		$options = $itemTabletop->getOptions();
		$colors  = $itemTabletop->getColors();

		if ( $options != null ) {
			foreach ( $options as $option ) {
				$optionModel = ModuleOption::model()->findByPk( $option['id'] );
				if ( $optionModel ) {
					$options[ $option['id'] ]["is_enabled"] = 0;
				} else {
					unset( $options[ $option['id'] ] );
				}
			}
		}

		if ( $colors != null ) {
			foreach ( $colors as $color ) {
				$colorModel = Color::model()->findByPk( $color['id'] );
				if ( $colorModel ) {
					$colors[ $color['id'] ]["is_enabled"] = 0;
				} else {
					unset( $color[ $color['id'] ] );
				}
			}
		}


		if ( $optionsPost ) {
			foreach ( $optionsPost as $optionPost ) {
				$price       = $_POST["option_$optionPost"];
				$optionModel = ModuleOption::model()->findByPk( $optionPost );
				if ( $optionModel ) {
					$options[ $optionPost ] = array( 'id' => $optionPost, 'group' => $optionModel->group, 'is_enabled' => '1', 'price' => $price );
				}
			}
		}


		if ( $colorsPost ) {
			foreach ( $colorsPost as $colorPost ) {
				$price      = $_POST["color_$colorPost"];
				$colorModel = Color::model()->findByPk( $colorPost );
				if ( $colorModel ) {
					$colors[ $colorPost ] = array( 'id' => $colorPost, 'is_enabled' => '1', 'price' => $price );
				}
			}
		}

        $price_show = Yii::app()->request->getPost( "price_show" );

		$itemTabletop->setColors( $colors );
		$itemTabletop->setOptions( $options );
		$itemTabletop->title       = $title;
		$itemTabletop->description = $description;
		$itemTabletop->description2= $description2;
		$itemTabletop->is_show     = $isShow;
		$itemTabletop->pre_pay     = $prePay;
		$itemTabletop->folder_id   = $folder;
		$itemTabletop->extra_size  = $extraSize;
		$itemTabletop->img_alt     = $img_alt;
        $itemTabletop->price  = Yii::app()->request->getPost( "price" );
        $itemTabletop->price_show  = is_null($price_show)?0:1;

		if ( $itemTabletop->update() and $image != null ) {
			$image = $itemTabletop->id.'.jpg';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/item_tabletops/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$itemTabletop->image = $image;
			$itemTabletop->update();
		}
		if(($image == null) and $del_img == "y"){
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/options/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			$itemTabletop->image = "";
			$itemTabletop->update();
		}
		$url = $this->createAbsoluteUrl( 'admin/itemcovers/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление столешницы
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$itemTabletop = ItemCover::model()->findByPk( $id );
		if ( $itemTabletop ) {
			$itemTabletop->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemcovers/view' );
		$this->redirect( $url, true );

	}

}