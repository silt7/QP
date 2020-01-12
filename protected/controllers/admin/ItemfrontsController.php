<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.ItemFront' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.PriceFrontFrez' );
Yii::import( 'application.models.ColorCategory' );


class ItemFrontsController extends AdminController {


	/**
	 * фасады
	 */
	public function actionView() {

		$itemFronts = ItemFront::model()->findAll();

		$this->pageTitle = "Редактирование фасадов";
		$this->layout    = 'auth';
		$this->render( 'view', array( 'itemFronts' => $itemFronts ) );
	}


	/**
	 * Редактирование фасада
	 */
	public function actionEdit( $id ) {

		$itemFront        = ItemFront::model()->findByPk( $id );
		$itemFront->title = str_replace( "\"", "&#34;", $itemFront->title );

		$colorsCriteria            = new CDbCriteria;
		$colorsCriteria->condition = 'is_show=1 and is_front=\'1\'';
		//$colorsCriteria->params    = array( ':is_show' => "1" );
		$colorsCriteria->order = "material";
		$colors                = Color::model()->findAll( $colorsCriteria );


		$optionsColorCriteria            = new CDbCriteria;
		$optionsColorCriteria->condition = 'is_show=:is_show';
		$optionsColorCriteria->params    = array( ':is_show' => "1" );
		$options                         = ModuleOption::model()->findAll( $optionsColorCriteria );

		$options_all                     = ModuleOption::model()->findAll();
		$count_milling = array();
		foreach ( $options_all as $option ){
			if($option['group'] == "milling"){
				array_push($count_milling, $option["title"]);
			}
		} 
		
/* 		$priceCriteria            = new CDbCriteria;
		$topRage=new CDbCriteria();
		$topRage->select="*";
		$topRage->alias="p";
		$topRage->join="INNER JOIN `colorCategory` c ON p.id_category = c.id";
  		$priceCriteria->condition = 'p.id_front=:id_front';
		$priceCriteria->params    = array( ':id_front' => $id ); 
		$price  				  = PriceFrontColor::model()->findAll( $priceCriteria ); */
		
		$price = Yii::app()->db->createCommand()
			->select("*")
			->from('PriceFrontColor p')
			->join('colorCategory c', 'p.id_category = c.id')
			->where('p.id_front=:id_front', array(':id_front'=>$id))
			->queryAll();
		$priceFrez = Yii::app()->db->createCommand()
			->select("*")
			->from('PriceFrontFrez p')
			->join('colorCategory c', 'p.id_category = c.id')
			->where('p.id_front=:id_front', array(':id_front'=>$id))
			->queryAll();
		//print_r($colors);
		$this->pageTitle = "Редактирование фасада";
		$this->layout    = 'auth';
		$this->render( 'edit', array( 'itemFront' => $itemFront, 'colors' => $colors, 'options' => $options, 'count_milling' => $count_milling, 'price' => $price, 'priceFrez' =>$priceFrez ) );
	}

	/**
	 * Создание фасада
	 */
	public function actionCreate() {

		$itemFront          = new ItemFront();
		$itemFront->title   = "Новый фасад";
		$itemFront->is_show = 0;
		$itemFront->img_alt   = "";
		$itemFront->save();

		$url = $this->createAbsoluteUrl( 'admin/itemfronts/edit' ) . '/?id=' . $itemFront->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение фасада
	 */
	public function actionSave() {

		$id = Yii::app()->request->getPost( "id" );;
		$title = Yii::app()->request->getPost( "title" );;
		$isShow      = Yii::app()->request->getPost( "is_show" ) ? Yii::app()->request->getPost( "is_show" ) : 0;
		$image       = $_FILES["image"]["name"];
		$optionsPost = Yii::app()->request->getPost( "options" );;
		$prePay_ldsp      = Yii::app()->request->getPost( "pre_pay_ldsp" );
		$prePay_mdf      = Yii::app()->request->getPost( "pre_pay_mdf" );
		$prePay_plast      = Yii::app()->request->getPost( "pre_pay_plast" );
		$filtr      = Yii::app()->request->getPost( "filtr" );
		$img_alt     = Yii::app()->request->getPost( "img_alt" );
		$descr      = Yii::app()->request->getPost( "description" );
		if(isset($_POST['del_img'])){
			$del_img = $_POST['del_img'];
		}else $del_img = "n";
		
		$prePay = array(0 => $prePay_ldsp, 1 => $prePay_mdf, 2 => $prePay_plast);
		$prePay = serialize($prePay);
		$title = str_replace( "\"", "&#34;", $title );

		$itemFront = ItemFront::model()->findByPk( $id );

		$options = $itemFront->getOptions();
		$options_all = ModuleOption::model()->findAll();
		$count_milling = 0;
		foreach ( $options_all as $option ){
			if($option['group'] == "milling"){
				$count_milling++;
			}
		}

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
		
		$itemFront->setOptions( $options );
		$itemFront->title   = $title;
		$itemFront->pre_pay = $prePay;
		$itemFront->is_show = $isShow;
		$itemFront->filtr   = $filtr;
		$itemFront->description   = $descr;
		$itemFront->img_alt     = $img_alt;
		if ( $itemFront->update() and $image != null ) {
			$image = $itemFront->id.'.jpg';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/item_fronts/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$itemFront->image = $image;
			$itemFront->update();

		}
		if(($image == null) and $del_img == "y"){
			$image = $id . '.png';
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/options/' . $image;
			if(file_exists($path)){
				unlink($path);
			}
			$itemFront->image = "";
			$itemFront->update();
		}
		$url = $this->createAbsoluteUrl( 'admin/itemfronts/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление фасада
	 */
	public function actionDelete( $id ) {

		$itemFront = ItemFront::model()->findByPk( $id );
		if ( $itemFront ) {
			$itemFront->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/itemfronts/view' );
		$this->redirect( $url, true );

	}
	public function updateColorFront(){
		$Fronts = ItemFront::model()->findAll();
		$colorsCriteria = new CDbCriteria();
		$colorsCriteria->condition = "is_front = 1";
		$colors = Color::model()->findAll($colorsCriteria);
		$arr = array();
		$arrWithout = array();
		foreach($colors as $item){			
			$arr2 = array('id' => $item['id'], 'is_enabled' => '1');
			array_push($arr, $arr2);			
		}
		foreach($colors as $item){			
			if ($item['id'] != 29){
				$arr3 = array('id' => $item['id'], 'is_enabled' => '1');
				array_push($arrWithout, $arr3);
			}			
		}	
		foreach($Fronts as $itemFront){
			if(($itemFront['id'] == 109 ) or ($itemFront['id'] == 110 )){
				$itemFront->colors = serialize($arr);
			}
			else{
				$itemFront->colors = serialize($arrWithout);
			}
			$itemFront->save();
		}
	}
}