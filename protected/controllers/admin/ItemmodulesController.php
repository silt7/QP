<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.ItemModule' );
Yii::import( 'application.models.ItemFront' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Folder' );


class ItemmodulesController extends AdminController {


	/**
	 * Кухонные модули
	 */
	public function actionView() {

		$itemModules = ItemModule::model()->findAll();

		$this->pageTitle = "Редактирование модулей";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'itemModules' => $itemModules ) );
	}


	/**
	 * Редактирование модуля
	 */
	public function actionEdit( $id ) {

		$itemModule              = ItemModule::model()->findByPk( $id );
		$itemModule->title       = str_replace( "\"", "&#34;", $itemModule->title );
		$itemModule->description = str_replace( "\"", "&#34;", $itemModule->description );

		$colorsCriteria            = new CDbCriteria;
		$colorsCriteria->condition = 'is_show=1 and is_module=\'1\'';
		//$colorsCriteria->params    = array( ':is_show' => "1" );
		$colorsCriteria->order = "material";
		$colors                = Color::model()->findAll( $colorsCriteria );


		$optionsColorCriteria            = new CDbCriteria;
		$optionsColorCriteria->condition = 'is_show=:is_show';
		$optionsColorCriteria->params    = array( ':is_show' => "1" );
		$options                         = ModuleOption::model()->findAll( $optionsColorCriteria );

		$frontsColorCriteria            = new CDbCriteria;
		$frontsColorCriteria->condition = 'is_show=:is_show';
		$frontsColorCriteria->params    = array( ':is_show' => "1" );
		$fronts                         = ItemFront::model()->findAll( $frontsColorCriteria );

		$this->pageTitle = "Редактирование модуля";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'itemModule' => $itemModule, 'colors' => $colors, 'options' => $options, 'fronts' => $fronts ) );
	}

	/**
	 * Создание модуля
	 */
	public function actionCreate() {

		$itemModule              = new ItemModule();
		$itemModule->title       = "Новый модуль";
		$itemModule->description = " ";
		$itemModule->img_alt = "";
		$itemModule->is_show     = 0;
		$itemModule->save();

		$url = $this->createAbsoluteUrl( 'admin/itemmodules/edit' ) . '/?id=' . $itemModule->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение модуля
	 */
	public function actionSave() {

		$id          = Yii::app()->request->getPost( "id" );
		$title       = Yii::app()->request->getPost( "title" );
		$description = Yii::app()->request->getPost( "description" );
		$isShow      = Yii::app()->request->getPost( "is_show" );
		$prePay      = Yii::app()->request->getPost( "pre_pay" );
		$folder      = Yii::app()->request->getPost( "folder" );
		$filtr       = Yii::app()->request->getPost( "filtr" );
		$img_alt     = Yii::app()->request->getPost( "img_alt" );

		if ( is_null( $isShow ) ) {
			$isShow = 0;
		}
		$image       = $_FILES["image"]["name"];
		$optionsPost = Yii::app()->request->getPost( "options" );
		$colorsPost  = Yii::app()->request->getPost( "colors" );
		$frontsPost  = Yii::app()->request->getPost( "fronts" );


		$title = str_replace( "\"", "&#34;", $title );
		//$description = str_replace( "\"", "&#34;", $description );

		$itemModule = ItemModule::model()->findByPk( $id );

		$options = $itemModule->getOptions();
		$colors  = $itemModule->getColors();
		$fronts  = $itemModule->getFronts();

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
		if ( $fronts != null ) {
			foreach ( $fronts as $front ) {
				$frontModel = Color::model()->findByPk( $front['id'] );
				if ( $frontModel ) {
					$fronts[ $front['id'] ]["is_enabled"] = 0;
				} else {
					unset( $fronts[ $front['id'] ] );
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

		if ( $frontsPost ) {
			foreach ( $frontsPost as $frontPost ) {
				$count      = $_POST["front_$frontPost"];
				$frontModel = ItemFront::model()->findByPk( $frontPost );
				if ( $frontModel ) {
					$fronts[ $frontPost ] = array( 'id' => $frontPost, 'is_enabled' => '1', 'count' => $count );
				}
			}
		}
        $price_show = Yii::app()->request->getPost( "price_show" );

		$itemModule->setColors( $colors );
		$itemModule->setOptions( $options );
		$itemModule->setFronts( $fronts );
		$itemModule->title       = $title;
		$itemModule->description = $description;
		$itemModule->is_show     = $isShow;
		$itemModule->pre_pay     = $prePay;
		$itemModule->folder_id   = 0;
		$itemModule->filtr       = $filtr;
		$itemModule->img_alt     = $img_alt;
        $itemModule->price  = Yii::app()->request->getPost( "price" );
        $itemModule->price_show  = is_null($price_show)?0:1;
		if(isset($_POST['del_img'])){
			$del_img = $_POST['del_img'];
		}else $del_img = "n";

		if ( $itemModule->update() and $image != null ) {
			$image = $itemModule->id .'.jpg';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/item_modules/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$itemModule->image = $image;
			$itemModule->update();
		}
		if(($image == null) and $del_img == "y"){
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/options/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			$itemModule->image = "";
			$itemModule->update();
		}
		$url = $this->createAbsoluteUrl( 'admin/itemmodules/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление модуля
	 */
	public function actionDelete( $id ) {

		$itemModule = ItemModule::model()->findByPk( $id );
		if ( $itemModule ) {
			$itemModule->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemmodules/view' );
		$this->redirect( $url, true );

	}

}