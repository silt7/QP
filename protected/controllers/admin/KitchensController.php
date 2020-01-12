<?php

Yii::import( 'application.components.Controller' );
Yii::import( 'application.controllers.admin.AdminController' );

Yii::import( 'application.models.Kitchen' );
Yii::import( 'application.models.KitchenModule' );
Yii::import( 'application.models.KitchenFront' );
Yii::import( 'application.models.KitchenCover' );
Yii::import( 'application.models.KitchenAccess' );
Yii::import( 'application.models.KitchenLikeIt' );
Yii::import( 'application.models.ItemModule' );
Yii::import( 'application.models.PriceFrontFrez' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.PriceModuleColor' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.ColorCategory' );
Yii::import( 'application.models.Color' );

class KitchensController extends AdminController {


	/**
	 * Кухни
	 */
	public function actionView() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$pageCriteria = new CDbCriteria;
		$pageCriteria->order = 'sorts';
		$kitchens = Kitchen::model()->findAll($pageCriteria);

		$this->pageTitle = "Кухонные гарнитуры";
		$this->layout     = 'auth';
		$this->render( 'view', array( 'kitchens' => $kitchens ) );
	}


	/**
	 * Редактирование кухонь
	 */
	public function actionEdit() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );
		$updatePriceModule = new KitchenModule();

		$id = Yii::app()->getRequest()->getQuery( 'id' );


		$kitchenmoduleCriteria = new CDbCriteria;
		$kitchenmoduleCriteria -> condition = 'id_kitchen = :id_kitchen';
		$kitchenmoduleCriteria->params = array(':id_kitchen' => $id);
		$kitchenmodule = KitchenModule::model()->findAll($kitchenmoduleCriteria);


		$kitchenfrontCriteria = new CDbCriteria;
		$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen';
		$kitchenfrontCriteria->params = array(':id_kitchen' => $id);
		$kitchenfront = KitchenFront::model()->findAll($kitchenmoduleCriteria);

		$kitchencoverCriteria = new CDbCriteria;
		$kitchencoverCriteria -> condition = 'id_kitchen = :id_kitchen';
		$kitchencoverCriteria->params = array(':id_kitchen' => $id);
		$kitchencover = KitchenCover::model()->findAll($kitchenmoduleCriteria);

		$kitchencoverCriteria = new CDbCriteria;
		$kitchencoverCriteria -> condition = 'id_kitchen = :id_kitchen';
		$kitchencoverCriteria->params = array(':id_kitchen' => $id);
		$kitchenaccess = KitchenAccess::model()->findAll($kitchenmoduleCriteria);
		
		$kitchencoverCriteria = new CDbCriteria;
		$kitchencoverCriteria -> condition = 'id_kitchen = :id_kitchen';
		$kitchencoverCriteria->params = array(':id_kitchen' => $id);
		$kitchenLikeIt = KitchenLikeIt::model()->findAll($kitchenmoduleCriteria);
		
		$kitchen              = Kitchen::model()->findByPk( $id );
		//print_r($kitchen['title']);
		$kitchen['title']       = str_replace( "\"", "&#34;", $kitchen['title']  );
		//$kitchen->description = str_replace( "\"", "&#34;", $kitchen->description );

		$this->pageTitle = "Редактирование кухонного гарнитура";
		$this->layout     = 'auth';
		$this->render( 'edit', array( 
			'kitchen' 		=> $kitchen,  
			'kitchenmodule' => $kitchenmodule, 
			'kitchenfront'  => $kitchenfront, 
			'kitchencover'  => $kitchencover,
			'kitchenaccess' => $kitchenaccess,
			'kitchenLikeIt' => $kitchenLikeIt) );
	}

	/**
	 * Создание кухни
	 */
	public function actionCreate() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$kitchen        = new Kitchen();
		$kitchen->title = "Новый гарнитур";
		//$kitchen->description = " ";
		//$kitchen->price       = 0;
		$kitchen->img_alt      = "";
		$kitchen->filtr        = "";
		$kitchen->is_show = 0;
		$kitchen->sorts = 0;
		$kitchen->save();

		$url = $this->createAbsoluteUrl( 'admin/kitchens/edit' ) . '/?id=' . $kitchen->id;
		$this->redirect( $url, true );

	}

	/**
	 * Сохранение кухни
	 */
	public function actionSave() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		//print_r( $_REQUEST );

		$id          = $_POST['id'];
		$title       = $_POST['title'];
		$price       = $_POST['price'];
		$description = $_POST['description'];
		$description2= $_POST['description2'];
		$img_alt     = $_POST['img_alt'];
		$url		 = $_POST['urlT'];
		$sort     	 = $_POST['sort'];
		$isShow      = isset( $_POST['is_show'] ) ? $_POST['is_show'] : 0;
		$image       = $_FILES["image"]["name"];
        
        $images    = $_FILES["imageAdd"]["tmp_name"];
		
		$title       = str_replace( "\"", "&#34;", $title );
		//$description = str_replace( "\"", "&#34;", $description );
		$arr = array('0'=>'classic', '1'=>'modern', '2'=>'ugol', '3'=>'direct','4'=>'premium','5'=>'low',
		                '6'=>'little','7'=>'big','8'=>'p-obraz','9'=>'ostrov','10'=>'bar','11' => 'vstraivaemye');
		$filtrArr = array();
		for($i=0; $i<12; $i++){
			if(isset($_POST[$arr[$i]])){
				array_push($filtrArr,$arr[$i]);
			}
		}

		if(isset($_POST['deconstruct'])){
			$deconstruct = 1;
		}
		else{
			$deconstruct = 0;
		}

		$kitchen              = Kitchen::model()->findByPk( $id );
		$kitchen->title       = $title;
		$kitchen->description = $description;
		$kitchen->description2= $description2;
		$kitchen->price       = $price;
		$kitchen->is_show     = $isShow;
		$kitchen->img_alt     = $img_alt;
		$kitchen->urlT        = $url;
		$kitchen->sorts       = $sort;
		$kitchen->filtr       = serialize($filtrArr);
		$kitchen->deconstruct = $deconstruct;
		if ( $kitchen->update() and $image != null ) {
			$image = $kitchen->id . '.jpg';//md5( $kitchen->title + $image );
			$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/kitchens/' . $image;
			$pathPrev  = Yii::getPathOfAlias( 'webroot' ) . '/images/kitchens/prev/' . $image;
			move_uploaded_file( $_FILES["image"]["tmp_name"], $path );
			$kitchen->image = $image;
			$kitchen->update();
			//$image = Yii::getAlias($path);
			//Image::thumbnail($path, 75, 75);
			Yii::app()->ih->load($path)->thumb('358', '250')->save($pathPrev);
		}
	    $imagesDB = unserialize($kitchen->img_add);
	    /**удаление отмеченных картинок**/
	    if(!empty($imagesDB)){
    		foreach($imagesDB as $imageDB){
    			if (isset($_POST[str_replace(".","",$imageDB['img'])])){
    				if($_POST[str_replace(".","",$imageDB['img'])] == 1){
    					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/kitchens/' . $imageDB['img'];
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
	    }
		$kitchen->img_add = serialize($imagesDB); 
		$kitchen->update(); 
		/**END удаление отмеченных картинок**/
	    if(empty($imagesDB)){
	        $imagesDB = array();
	    }
		if ($images != null ) {
			foreach($images as $imageAdd){
				if ($imageAdd != null ) {
					$imageName = date("YmdHis").rand(100,999).".png";
					$imageAlt  = "-";
					$path  = Yii::getPathOfAlias( 'webroot' ) . '/images/kitchens/' . $imageName;
					if(file_exists($path)){
						unlink($path);
					}
					move_uploaded_file( $imageAdd, $path );
					//Yii::app()->ih->load($path)->thumb('75', '75')->save($pathPrev);
					$arr = array('img'=>$imageName,'alt'=>$imageAlt);
					array_push($imagesDB, $arr);
				}
			}
			$kitchen->img_add = serialize($imagesDB);
		}
		$kitchen->update();

		$url = $this->createAbsoluteUrl( 'admin/kitchens/view' );
		$this->redirect( $url, true );
	}

	/**
	 * Удаление кухни
	 */
	public function actionDelete() {
		if ( ! $this->checkRole( "admin" ) ) {
			//$url = $this->createAbsoluteUrl( 'admin/slider/view' );
			$this->redirect( "/", true );
		}
		$id = Yii::app()->getRequest()->getQuery( 'id' );

		$kitchen = Kitchen::model()->findByPk( $id );
		if ( $kitchen ) {
			$kitchen->delete();
		}

		$url = $this->createAbsoluteUrl( 'admin/kitchens/view' );
		$this->redirect( $url, true );

	}

	/**
	 * Функции для работы с модулями, входящих в расчет кухни
	 */
	public function actionSelmodule(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_module = $_POST['id_module']?$_POST['id_module']:"";
		if($id_module != ""){
			$module = ItemModule::model()->findByPk( $id_module );
		}
		if((!empty($module))and($id_kitchen != "")){
			$kitchenmoduleCriteria = new CDbCriteria;
			$kitchenmoduleCriteria -> condition = 'id_kitchen = :id_kitchen and id_module = :id_module';
			$kitchenmoduleCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_module' => $module -> id);
			$kitchens = KitchenModule::model()->findAll($kitchenmoduleCriteria);
			$KitchenModule = new KitchenModule();
			$KitchenModule -> id_kitchen = $id_kitchen;
			$KitchenModule -> id_module = $module -> id;
			$KitchenModule -> save();
			echo $this->messageJsonOk('{"mess":"Модуль добавлен","title":"'.$module -> title.'","id_module":"'.$module -> id.'"}');
			/*if(empty($kitchens)){
				$KitchenModule = new KitchenModule();
				$KitchenModule -> id_kitchen = $id_kitchen;
				$KitchenModule -> id_module = $module -> id;
				$KitchenModule -> save();
				echo $this->messageJsonOk('{"mess":"Модуль добавлен","title":"'.$module -> title.'","id_module":"'.$module -> id.'"}');
			}
			else{
				echo $this->messageJsonOk('{"mess":"Данный модуль уже добавлен!","title":""}');
			}*/
		}
		else{
			echo $this->messageJsonOk('{"mess":"Модуль не добавлен!","title":""}');
		}
	}
	public function actionDelmodule(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_module = $_POST['id_module']?$_POST['id_module']:"";
		$id_kitchenModule = $_POST['id_kitchenModule']?$_POST['id_kitchenModule']:"";
		/*
		if(($id_kitchen=="")or($id_module =="")){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchenmoduleCriteria = new CDbCriteria;
			$kitchenmoduleCriteria -> condition = 'id_kitchen = :id_kitchen and id_module = :id_module';
			$kitchenmoduleCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_module' => $id_module);
			KitchenModule::model()->deleteAll($kitchenmoduleCriteria);
			echo $this->messageJsonOk("Модуль удалён!");
		}
		*/
		if($id_kitchenModule==""){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchenmoduleCriteria = new CDbCriteria;
			$kitchenmoduleCriteria -> condition = 'id = :id';
			$kitchenmoduleCriteria->params = array(':id' => $id_kitchenModule);
			KitchenModule::model()->deleteAll($kitchenmoduleCriteria);
			echo $this->messageJsonOk("Модуль удалён!");
		}
		
	}
	public function actionEditmodule(){
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_module			 = isset($_POST['id_module'])?$_POST['id_module']:"";
		$color_select_module = isset($_POST['color_select_module'])?$_POST['color_select_module']:"";
		$color_select_front  = isset($_POST['color_select_front'])?$_POST['color_select_front']:"";
		$count_select_module = isset($_POST['count_select_module'])?$_POST['count_select_module']:"";
		$id_kitchenModule	 = isset($_POST['id_kitchenModule'])?$_POST['id_kitchenModule']:"";
		$addition_select_module = isset($_POST['addition_select_module'])?$_POST['addition_select_module']:"";
		$options_select_module = Yii::app()->getRequest()->getPost( 'options' );
		$userKitchen = isset($_POST['viewKitchen'])?$_POST['viewKitchen']:"";//параметр для передачи цены без сохранения в базу

		$updatePriceModule = new KitchenModule();
		$result = $updatePriceModule->updatePriceModule($id_kitchen,$id_module,$color_select_module,
			$color_select_front,$count_select_module,$options_select_module,$userKitchen,$addition_select_module,$id_kitchenModule);
		echo $this->messageJsonOk($result);
	}

	public function actionSelmodulebutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_module = $_POST['id_module']?$_POST['id_module']:"";
		$id_kitchenModule = $_POST['id_kitchenModule']?$_POST['id_kitchenModule']:"";
		$kitchenModule = new KitchenModule();
		$result = $kitchenModule->selectDataModule($id_kitchen,$id_module,$id_kitchenModule);
		echo $this->messageJsonOk(json_encode($result));
	}
	/**
	 *  END Функции для работы с модулями, входящих в расчет кухни
	 */

	/**
	 * Функции для работы с фасадами, входящих в расчет кухни
	 */
	public function actionSelfront(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_front = $_POST['id_front']?$_POST['id_front']:"";
		if($id_front != ""){
			$front = ItemFront::model()->findByPk( $id_front );
		}
		if((!empty($front))and($id_kitchen != "")){
			/*
			$kitchenfrontCriteria = new CDbCriteria;
			$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_front = :id_front';
			$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_front' => $front -> id);
			$kitchens = KitchenFront::model()->findAll($kitchenfrontCriteria);
			if(empty($kitchens)){
				$KitchenFront = new KitchenFront();
				$KitchenFront -> id_kitchen = $id_kitchen;
				$KitchenFront -> id_front  = $front -> id;
				$KitchenFront -> selColor  = 0;
				$KitchenFront -> selOption = serialize(array());
				$KitchenFront -> save();
				echo $this->messageJsonOk('{"mess":"Фасад добавлен","title":"'.$front -> title.'","id_module":"'.$front -> id.'"}');
			}
			else{
				echo $this->messageJsonOk('{"mess":"Данный фасад уже добавлен!","title":""}');
			}
			*/
			$KitchenFront = new KitchenFront();
			$KitchenFront -> id_kitchen = $id_kitchen;
			$KitchenFront -> id_front  = $front -> id;
			$KitchenFront -> selColor  = 0;
			$KitchenFront -> selOption = serialize(array());
			$KitchenFront -> save();
			echo $this->messageJsonOk('{"mess":"Фасад добавлен","title":"'.$front -> title.'","id_module":"'.$front -> id.'"}');
		}
		else{
			echo $this->messageJsonOk('{"mess":"Фасад не добавлен!","title":""}');
		}
	}


	public function actionDelfront(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_front = $_POST['id_front']?$_POST['id_front']:"";
		if(($id_kitchen=="")or($id_front =="")){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchenfrontCriteria = new CDbCriteria;
			$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_front = :id_front';
			$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_front' => $id_front);
			KitchenFront::model()->deleteAll($kitchenfrontCriteria);
			echo $this->messageJsonOk("Фасад удалён!");
		}

	}
	public function actionSelfrontbutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_front = $_POST['id_front']?$_POST['id_front']:"";
		$id_kitchenFront = $_POST['id_kitchenFront']?$_POST['id_kitchenFront']:"";
		$kitchenfront = new KitchenFront();
		$result = $kitchenfront->selectDataFront($id_kitchen,$id_front,$id_kitchenFront);
		echo $this->messageJsonOk(json_encode($result));
	}


	public function actionEditfront(){
		$id_kitchenFront 	 = isset($_POST['id_kitchenFront'])?$_POST['id_kitchenFront']:"";
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_front			 = isset($_POST['id_front'])?$_POST['id_front']:"";
		$color_select_front  = isset($_POST['color_select_front'])?$_POST['color_select_front']:"";
		$count_select_front = isset($_POST['count_select_front'])?$_POST['count_select_front']:"";
		$addition_select_front = isset($_POST['addition_select_front'])?$_POST['addition_select_front']:"";
		$options_select_front = Yii::app()->getRequest()->getPost( 'options' );

		$userKitchen = isset($_POST['viewKitchen'])?$_POST['viewKitchen']:"";//параметр для передачи цены без сохранения в базу

		$updatePriceFront = new KitchenFront();
		$result = $updatePriceFront->updatePriceFront($id_kitchen,$id_front,
			$color_select_front,$count_select_front,$options_select_front,$userKitchen,$addition_select_front,$id_kitchenFront);
		echo $this->messageJsonOk($result);
	}

	/**
	 *  END Функции для работы с фасадами, входящих в расчет кухни
	 */

	/**
	 * Функции для работы со столешницами, входящих в расчет кухни
	 */
	public function actionSelcover(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_cover = $_POST['id_cover']?$_POST['id_cover']:"";
		if($id_cover != ""){
			$cover = ItemCover::model()->findByPk( $id_cover );
		}
		if((!empty($cover))and($id_kitchen != "")){
			$kitchencoverCriteria = new CDbCriteria;
			$kitchencoverCriteria -> condition = 'id_kitchen = :id_kitchen and id_cover = :id_cover';
			$kitchencoverCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_cover' => $cover -> id);
			$kitchens = KitchenCover::model()->findAll($kitchencoverCriteria);
			if(empty($kitchens)){
				$KitchenCover = new KitchenCover();
				$KitchenCover -> id_kitchen = $id_kitchen;
				$KitchenCover -> id_cover  = $cover -> id;
				$KitchenCover -> selColor  = 0;
				$KitchenCover -> selOption = serialize(array());
				$KitchenCover -> save();
				echo $this->messageJsonOk('{"mess":"Столешница добавлена","title":"'.$cover -> title.'","id_module":"'.$cover -> id.'"}');
			}
			else{
				echo $this->messageJsonOk('{"mess":"Данная столешница уже добавлена!","title":""}');
			}
		}
		else{
			echo $this->messageJsonOk('{"mess":"Столешница не добавлена!","title":""}');
		}
	}
	public function actionDelcover(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_cover = $_POST['id_cover']?$_POST['id_cover']:"";
		if(($id_kitchen=="")or($id_cover =="")){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchencoverCriteria = new CDbCriteria;
			$kitchencoverCriteria -> condition = 'id_kitchen = :id_kitchen and id_cover = :id_cover';
			$kitchencoverCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_cover' => $id_cover);
			KitchenCover::model()->deleteAll($kitchencoverCriteria);
			echo $this->messageJsonOk("Столешница удалена!");
		}

	}
	public function actionSelcoverbutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_cover = $_POST['id_cover']?$_POST['id_cover']:"";
		$kitchenCover = new KitchenCover();
		$result = $kitchenCover->selectDataCover($id_kitchen,$id_cover);
		echo $this->messageJsonOk(json_encode($result));
	}

	public function actionEditcover(){
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_cover			 = isset($_POST['id_cover'])?$_POST['id_cover']:"";
		$color_select_cover  = isset($_POST['color_select_cover'])?$_POST['color_select_cover']:"";
		$count_select_cover  = isset($_POST['count_select_cover'])?$_POST['count_select_cover']:"";
		$addition_select_cover = isset($_POST['addition_select_cover'])?$_POST['addition_select_cover']:"";
		$options_select_cover= Yii::app()->getRequest()->getPost( 'options' );
		$extra_size_width    = isset($_POST['extra_size_width'])?$_POST['extra_size_width']:"";
		$extra_size_height   = isset($_POST['extra_size_height'])?$_POST['extra_size_height']:"";
		$koffCost   = isset($_POST['koffCost'])?$_POST['koffCost']:"";

		$userKitchen = isset($_POST['viewKitchen'])?$_POST['viewKitchen']:"";//параметр для передачи цены без сохранения в базу

		$KitchenCover = new KitchenCover();
		$result = $KitchenCover->updatePriceCover($id_kitchen,$id_cover,$color_select_cover,$count_select_cover,$options_select_cover,
			$extra_size_width,$extra_size_height,$koffCost,$userKitchen,$addition_select_cover);
		echo $this->messageJsonOk($result);
	}
	public function actionCoverextrasize(){
		$id_cover   = isset($_POST['id_cover'])?$_POST['id_cover']:"";
		$sizeH 		= isset($_POST['sizeH'])?$_POST['sizeH']:"";
		$sizeW 		= isset($_POST['sizeW'])?$_POST['sizeW']:"";
		$kitchenCover = new KitchenCover();
		$result = $kitchenCover ->coverExtraSize($id_cover,$sizeH,$sizeW);

		echo $this->messageJsonOk(json_encode($result));

	}

	/**
	 * Функции для работы с аксессуарами, входящих в расчет кухни
	 */
	public function actionSelaccess(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_access = $_POST['id_access']?$_POST['id_access']:"";
		if($id_access != ""){
			$access = Accessory::model()->findByPk( $id_access );
		}
		if((!empty($access))and($id_kitchen != "")){
			$kitchenfrontCriteria = new CDbCriteria;
			$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_access = :id_access';
			$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_access' => $access -> id);
			$kitchens = KitchenAccess::model()->findAll($kitchenfrontCriteria);
			if(empty($kitchens)){
				$KitchenAccess = new KitchenAccess();
				$KitchenAccess -> id_kitchen = $id_kitchen;
				$KitchenAccess -> id_access  = $access -> id;
				$KitchenAccess -> save();
				echo $this->messageJsonOk('{"mess":"Аксессуар добавлен","title":"'.$access -> title.'","id_module":"'.$access -> id.'"}');
			}
			else{
				echo $this->messageJsonOk('{"mess":"Данный аксессуар уже добавлен!","title":""}');
			}
		}
		else{
			echo $this->messageJsonOk('{"mess":"Аксессуар не добавлен!","title":""}');
		}
	}


	public function actionDelaccess(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_access = $_POST['id_access']?$_POST['id_access']:"";
		if(($id_kitchen=="")or($id_access =="")){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchenfrontCriteria = new CDbCriteria;
			$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_access = :id_access';
			$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_access' => $id_access);
			KitchenAccess::model()->deleteAll($kitchenfrontCriteria);
			echo $this->messageJsonOk("Аксессуар удалён!");
		}

	}
	public function actionSelaccessbutton(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_access = $_POST['id_access']?$_POST['id_access']:"";
		$kitchenfrontCriteria = new CDbCriteria;
		$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_access = :id_access';
		$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_access' => $id_access);
		$kitchen = KitchenAccess::model()->find($kitchenfrontCriteria);
		$count = $kitchen -> count;
		$addition = $kitchen -> addition;
		echo $this->messageJsonOk(json_encode(array("count" => $count, "addition" => $addition)));
	}
	public function actionEditaccess(){
		$id_kitchen 		 = isset($_POST['id_kitchen'])?$_POST['id_kitchen']:"";
		$id_access			 = isset($_POST['id_access'])?$_POST['id_access']:"";
		$count_select_access  = isset($_POST['count_select_access'])?$_POST['count_select_access']:"";
		$addition_select_access  = isset($_POST['addition_select_access'])?$_POST['addition_select_access']:"";
		$kitchenfrontCriteria = new CDbCriteria;
		$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_access = :id_access';
		$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_access' => $id_access);
		$kitchen = KitchenAccess::model()->find($kitchenfrontCriteria);

		$access = Accessory::model()->findByPk( $id_access );
		$kitchen -> count = $count_select_access;
		$kitchen -> price = $access -> price * $count_select_access;
		$kitchen -> addition = $addition_select_access;
		$kitchen -> update();
	}
	
	/**
	 * Функции для работы с кухнями в раздел вам понравится
	 */
	public function actionSelKitchen(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_kitchenLike = $_POST['id_kitchenLike']?$_POST['id_kitchenLike']:"";
		if($id_kitchenLike != ""){
			$kitchen = Kitchen::model()->findByPk( $id_kitchenLike );
		}
		if((!empty($kitchen))and($id_kitchen != "")){
			$kitchenmoduleCriteria = new CDbCriteria;
			$kitchenmoduleCriteria -> condition = 'id_kitchen = :id_kitchen and id_kitchenLike = :id_kitchenLike';
			$kitchenmoduleCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_kitchenLike' => $kitchen->id);
			$KitchenLikeIt = new KitchenLikeIt();
			$KitchenLikeIt -> id_kitchen = $id_kitchen;
			$KitchenLikeIt -> id_kitchenLike = $kitchen -> id;
			$KitchenLikeIt -> save();
			echo $this->messageJsonOk('{"mess":"Кухня добавлена","title":""}');
		}
		else{
			echo $this->messageJsonOk('{"mess":"Кухня не добавлена!","title":""}');
		}
	}
	public function actionDelKitchen(){
		$id_kitchen = $_POST['id_kitchen']?$_POST['id_kitchen']:"";
		$id_kitchenLike = $_POST['id_kitchenLike']?$_POST['id_kitchenLike']:"";
		if(($id_kitchen=="")or($id_kitchenLike =="")){
			echo $this->messageJsonOk("error!");
		}
		else{
			$kitchenfrontCriteria = new CDbCriteria;
			$kitchenfrontCriteria -> condition = 'id_kitchen = :id_kitchen and id_kitchenLike = :id_kitchenLike';
			$kitchenfrontCriteria->params = array(':id_kitchen' => $id_kitchen, ':id_kitchenLike' => $id_kitchenLike);
			KitchenLikeIt::model()->deleteAll($kitchenfrontCriteria);
			echo $this->messageJsonOk("Кухня удалена!");
		}
	}
	
	public function actionUpdatepriceall(){
		$kitchensCriteria = new CDbCriteria;
		$kitchensCriteria->condition = 'deconstruct=1';
		$kitchens = Kitchen::model()->findAll($kitchensCriteria);
		foreach($kitchens as $kitchen){
			$price = 0;
			$kitchenCriteria = new CDbCriteria;
			$kitchenCriteria->condition = 'id_kitchen = :id_kitchen and addition = :addition';
			$kitchenCriteria->params = array(':id_kitchen' => $kitchen->id, ':addition' => '0');

			$KitchenModule = KitchenModule::model()->findAll($kitchenCriteria);
			foreach($KitchenModule as $item){
				$updatePrice = new KitchenModule();
				$price += $updatePrice->updatePriceModule($item->id_kitchen,$item->id_module,$item->selColorModule,
					$item->selColorFront,$item->count,unserialize($item->selOption),"no",$item->addition,$item->id);

			}
			$KitchenFront = KitchenFront::model()->findAll($kitchenCriteria);
			foreach($KitchenFront as $item){
				$updatePrice = new KitchenFront();
				$price += $updatePrice->updatePriceFront($item->id_kitchen,$item->id_front,$item->selColor,$item->count,
					unserialize($item->selOption),"no",$item->addition);

			}
			$KitchenCover = KitchenCover::model()->findAll($kitchenCriteria);
			foreach($KitchenCover as $item){
				$koffCost = 0;
				$extra_size_width = 0;
				$extra_size_height =0;
				if(unserialize($item->selSize)!==False) {
					$selSize = unserialize($item->selSize);
					if(isset($selSize['koffCost'])){
						$koffCost = $selSize['koffCost'];
						$extra_size_width = $selSize['size_width'];
						$extra_size_height = $selSize['size_height'];
					}
				}

				$updatePrice = new KitchenCover();
				$price += $updatePrice->updatePriceCover($item->id_kitchen,$item->id_cover,$item->selColor,$item->count,
					unserialize($item->selOption),$extra_size_width,$extra_size_height,$koffCost,"no", $item->addition);

			}
			$KitchenAccess = KitchenAccess::model()->findAll($kitchenCriteria);
			foreach($KitchenAccess as $item){
				$price += $item -> price;
			}
			$kitchen->price2 = $price;
			$kitchen->update();
		}
		echo $this->messageJsonOk("Обновлено!");
	}
}