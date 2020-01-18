<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );
Yii::import( 'application.models.Equipment' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Folder' );

class ItemequipmentController extends AdminController {


	/**
	 * Список техники
	 */
	public function actionView() {

		$equipmentCriteria        = new CDbCriteria;
		$equipmentCriteria->order = 'title ASC';

		$equipment  = 	Yii::app()->db->createCommand()
			->select("a.*, f.title as title2")
			->from('equipment a')
			->join('folders f', 'a.folder_id = f.id')
			->order('title2')
			->queryAll();

//****
//****Перенос артикула из title в articulus
//		$equipment        = Equipment::model()->findAll( );
//		foreach($equipment as $item){
//			$title = $item -> title;
//			$item -> articulus = substr($title, -8);
//			$item -> update();
//		}

		$this->pageTitle = "Редактирование техники";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'equipment' => $equipment ) );
	}


	/**
	 * Редактирование техники
	 */
	public function actionEdit( $id ) {


		$optionsEquipmentCriteria            = new CDbCriteria;
		$optionsEquipmentCriteria->condition = 'is_show=:is_show';
		$optionsEquipmentCriteria->params    = array( ':is_show' => "1" );
		$options                             = ModuleOption::model()->findAll( $optionsEquipmentCriteria );


		$equipment        = Equipment::model()->findByPk( $id );
		$equipment->title = str_replace( "\"", "&#34;", $equipment->title );

		$this->pageTitle = "Редактирование техники";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'equipment' => $equipment, 'options' => $options ) );
	}

	/**
	 * Создание устройства
	 */
	public function actionCreate() {

		$equipment          = new Equipment();
		$equipment->title   = "Новая техника";
		$equipment->is_show = 0;
		$equipment->articulus = 0;
		$equipment->image   = '';
		$equipment->img_alt = '';
		$equipment->save();

		$url = '/admin/item-equipment/edit/' . $equipment->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение устройства
	 */
	public function actionSave() {

		$id          = Yii::app()->request->getPost( "id" );
		$folderId    = Yii::app()->request->getPost( "folder_id" );
		$title       = Yii::app()->request->getPost( "title" );
		$articulus   = Yii::app()->request->getPost( "articulus" );
		$description = Yii::app()->request->getPost( "description" );
		$isShow      = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$image       = $_FILES["image"]["name"];
		$itemPrice   = Yii::app()->request->getPost( "price" );
		$prePay      = Yii::app()->request->getPost( "pre_pay" );
		$optionsPost = Yii::app()->request->getPost( "options" );
		$img_alt = Yii::app()->request->getPost( "img_alt" );
		$title       = str_replace( "\"", "&#34;", $title );

		$equipment = Equipment::model()->findByPk( $id );

		$options = $equipment->getOptions();


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


		if ( $optionsPost ) {
			foreach ( $optionsPost as $optionPost ) {
				$price       = $_POST["option_$optionPost"];
				$optionModel = ModuleOption::model()->findByPk( $optionPost );
				if ( $optionModel ) {
					$options[ $optionPost ] = array( 'id' => $optionPost, 'group' => $optionModel->group, 'is_enabled' => '1', 'price' => $price );
				}
			}
		}

        $price_show = Yii::app()->request->getPost( "price_show" );

		$equipment->setOptions( $options );

		$equipment->price       = $itemPrice;
		$equipment->folder_id   = $folderId;
		$equipment->pre_pay     = $prePay;
		$equipment->title       = $title;
		$equipment->articulus   = $articulus;
		$equipment->description = $description;
		$equipment->img_alt = $img_alt;
		//$color->type     = $type;
		$equipment->is_show = $isShow;
        $equipment->price_show  = is_null($price_show)?0:1;
		if ( $equipment->update() and $image != null ) {
			$image = $id . '.png';//md5( $color->title . $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/item_equipment/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$equipment->image = $image;
			$equipment->update();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemequipment/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление устройства
	 */
	public function actionDelete() {

		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$equipment = Equipment::model()->findByPk( $id );
		if ( $equipment ) {
			$equipment->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemequipment/view' );
		$this->redirect( $url, true );

	}

}