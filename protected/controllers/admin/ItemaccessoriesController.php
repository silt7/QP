<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Accessory' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Color' );
Yii::import( 'application.models.Folder' );

class ItemaccessoriesController extends AdminController {


	/**
	 * Список аксессуаров
	 */
	public function actionView() {

		$accessoriesCriteria        = new CDbCriteria;
		$accessoriesCriteria->order = 'title ASC';

		$accessories = 	Yii::app()->db->createCommand()
			->select("a.*, f.title as title2")
			->from('accessories a')
			->join('folders f', 'a.folder_id = f.id')
			->order('title2')
			->queryAll();

		$this->pageTitle = "Редактирование аксессуаров";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'accessories' => $accessories ) );
	}


	/**
	 * Редактирование аксессуара
	 */
	public function actionEdit() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$colorsCriteria            = new CDbCriteria;
		$colorsCriteria->condition = 'is_show=1 and is_accessory=\'1\'';
		//$colorsCriteria->params    = array( ':is_show' => "1" );
		$colorsCriteria->order = "material";
		$colors                = Color::model()->findAll( $colorsCriteria );


		$optionsColorCriteria            = new CDbCriteria;
		$optionsColorCriteria->condition = 'is_show=:is_show';
		$optionsColorCriteria->params    = array( ':is_show' => "1" );
		$options                         = ModuleOption::model()->findAll( $optionsColorCriteria );


		$accessory        = Accessory::model()->findByPk( $id );
		$accessory->title = str_replace( "\"", "&#34;", $accessory->title );

		$this->pageTitle = "Редактирование аксессуаров";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'accessory' => $accessory, 'colors' => $colors, 'options' => $options ) );
	}

	/**
	 * Создание аксессуара
	 */
	public function actionCreate() {

		$accessory          = new Accessory();
		$accessory->title   = "Новый аксессуар";
		$accessory->is_show = 0;
		$accessory->show_cover = 0;
		$accessory->show_wall = 0;
		$accessory->image   = '';
		$accessory->img_alt   = '';
		$accessory->save();

		$url = '/admin/item-accessories/edit/' . $accessory->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение аксессуара
	 */
	public function actionSave() {

		$id          = Yii::app()->request->getPost( "id" );
		$folderId    = Yii::app()->request->getPost( "folder_id" );
		$title       = Yii::app()->request->getPost( "title" );
		$description = Yii::app()->request->getPost( "description" );
		$isShow      = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$ShowCover   = Yii::app()->request->getPost( "show_cover" ) ? Yii::app()->request->getPost( "show_cover" ) : 0;
		$ShowWall    = Yii::app()->request->getPost( "show_wall" ) ? Yii::app()->request->getPost( "show_wall" ) : 0;
		$image       = $_FILES["image"]["name"];
		$itemPrice   = Yii::app()->request->getPost( "price" );
		$prePay      = Yii::app()->request->getPost( "pre_pay" );
		$img_alt     = Yii::app()->request->getPost( "img_alt" );
		$colorsPost  = Yii::app()->request->getPost( "colors" );
		$optionsPost = Yii::app()->request->getPost( "options" );
		$title       = str_replace( "\"", "&#34;", $title );


		$accessory = Accessory::model()->findByPk( $id );

		$colors  = $accessory->getColors();
		$options = $accessory->getOptions();


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

		$accessory->setOptions( $options );
		$accessory->setColors( $colors );


		$accessory->folder_id   = $folderId;
		$accessory->price       = $itemPrice;
		$accessory->pre_pay     = $prePay;
		$accessory->title       = $title;
		$accessory->description = $description;
		$accessory->img_alt     = $img_alt;
		//$color->type     = $type;
		$accessory->is_show = $isShow;
		$accessory->show_cover = $ShowCover;
		$accessory->show_wall = $ShowWall;
		if ( $accessory->update() and $image != null ) {
			$image = $id . '.png';//md5( $color->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/item_accessories/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$accessory->image = $image;
			$accessory->update();

		}

		$url = $this->createAbsoluteUrl( 'admin/itemaccessories/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление аксессуара
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$accessory = Accessory::model()->findByPk( $id );
		if ( $accessory ) {
			$accessory->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemaccessories/view' );
		$this->redirect( $url, true );

	}

}