<?php
Yii::import( 'application.components.Controller' );
Yii::import( 'application.models.ColorHint' );
Yii::import( 'application.models.ItemModule' );
Yii::import( 'application.models.ItemFront' );
Yii::import( 'application.models.CatalogMenuItem' );
Yii::import( 'application.models.ModuleOption' );
Yii::import( 'application.models.Tabletop' );
Yii::import( 'application.models.WallPanel' );
Yii::import( 'application.models.Accessory' );
Yii::import( 'application.models.Equipment' );
Yii::import( 'application.models.Folder' );
Yii::import( 'application.models.Color' );
Yii::import( 'application.models.Page' );
Yii::import( 'application.models.PriceModuleColor' );
Yii::import( 'application.models.PriceFrontColor' );
Yii::import( 'application.models.PriceFrontFrez' );
Yii::import( 'application.models.ColorCategory' );
Yii::import( 'application.models.Cupboard' );


class CatalogController extends Controller {
	public $ActionPrice_gl = 0.66;
    public $canonical = '';
	public $description = '';
	/**
	 * Каталог - конструктор
	 */
	public function actionIndex() {
       
		$session = new CHttpSession;
		$session->open();
		
		$page = Page::model()->findByPk( 12 );

		$colorHint         = new ColorHint( $session );
		$openCatalogItemId = null;
		$catalogMenu       = $this->getCatalogMenuArray();
		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->pageTitle = "Каталог";
		$this->render( 'catalog', array( 'catalogMenu' => $catalogMenu, "openCatalogItemId" => $openCatalogItemId, "page" => $page) );
	}

	/**
	 * Массив доступных элементов меню каталога
	 * @return mixed
	 */
	protected function getCatalogMenuArray() {
        
		$catalogMenuCriteria            = new CDbCriteria;
		$catalogMenuCriteria->condition = 'is_show=:is_show';
		$catalogMenuCriteria->params    = array( ':is_show' => "1" );
		$catalogMenuCriteria->order     = 'ordr';

		$catalogMenu = CatalogMenuItem::model()->findAll( $catalogMenuCriteria );

		return $catalogMenu;

	}

	/**
	 * Каталог - конструктор - столешницы - цвет
	 */
	public function actionTableTopsColor() {

		$session = new CHttpSession;
		$session->open();
		$colorHint = new ColorHint( $session );

		$tabletopColorCriteria            = new CDbCriteria;
		$tabletopColorCriteria->condition = 'is_show=:is_show and is_tabletop=:is_tabletop';
		$tabletopColorCriteria->params    = array( ':is_show' => "1", ':is_tabletop' => "1" );

		$tabletopColors    = Color::model()->findAll( $tabletopColorCriteria );
		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

		$this->pageTitle = "Столешницы";
		$this->render( 'tabletop-color', array(
			'colorHint'         => $colorHint,
			'tabletopColors'    => $tabletopColors,
			'catalogMenu'       => $catalogMenu,
			"openCatalogItemId" => $openCatalogItemId

		) );
	}

	/**
	 * Каталог - конструктор - кухонные модули
	 */
	public function actionKitchenModules() {
		/*----------------Фильтр модулей-------------------------*/
		$arr =  ItemModule::model()->findAll(array('select'=>'filtr'));
		$filtr = array();
		foreach($arr as $ar){
			if($ar['filtr'] != ""){
				array_push($filtr, $ar['filtr']);
			}
		}
		$filtr = array_unique($filtr);
		$getFiltr = array();
		for($i=0; $i<count($filtr); $i++){
			$p = "filtr_".$i;
			if(!empty($_POST[$p])){
				array_push($getFiltr, $_POST[$p]);

			}
		}
		$moduleFiltrTab = Yii::app()->session['FiltrTabId'];
		$moduleFiltrTabTitle = Yii::app()->session['FiltrTabTitle'];
		if( $moduleFiltrTab != ""){
			$selectModuleFiltrTab['id']    = $moduleFiltrTab;
			$selectModuleFiltrTab['title'] = $moduleFiltrTabTitle;
		}
		else{
			$selectModuleFiltrTab['id']    = "#filtr_menu1";
			$selectModuleFiltrTab['title'] = "Нижние";
		}
		/*----------------END Фильтр модулей-------------------------*/

		/*----------------Присвоение цвета модуля и фасада--------------------------*/
		$moduleColorId = Yii::app()->session['moduleColorId'];
		if( $moduleColorId != ""){
			$dataColorId = Color::model()->findAllByPk($moduleColorId);
			$dataColorId = array_shift($dataColorId);
			$selectModuleColor['id']    = $moduleColorId;
			$selectModuleColor['title'] = $dataColorId['title'];
			$selectModuleColor['image'] = "colors/".$dataColorId['image'].".png";
		}
		else{
			$dataColorId = Color::model()->findAllByPk(29);
			$dataColorId = array_shift($dataColorId);
			$selectModuleColor['id']    = 29;
			$selectModuleColor['title'] = $dataColorId['title'];
			$selectModuleColor['image'] = "colors/".$dataColorId['image'].".png";
			$moduleColorId = 29;
		}
		$frontColorId = "";//= Yii::app()->session['frontColorId'];
		if( $frontColorId != ""){
			$dataColorId = Color::model()->findAllByPk($frontColorId);
			$dataColorId = array_shift($dataColorId);
			$selectFrontColor['id']	   = $frontColorId;
			$selectFrontColor['title'] = $dataColorId['title'];
			$selectFrontColor['image'] = "colors/".$dataColorId['image'].".png";
		}
		else{
			$selectFrontColor['id']	   = 0;
			$selectFrontColor['title'] = "Цвет не выбран";
			$selectFrontColor['image'] = "without.jpg";
		}
		/*----------------END Присвоение цвета--------------------------*/

		/*-----------------------Модули--------------------------------------------*/
		$modulesCriteria            = new CDbCriteria;
		$modulesCriteria->condition = 'is_show=:is_show';
		$modulesCriteria->params    = array( ':is_show' => "1" );

		$modules           = ItemModule::model()->findAll( $modulesCriteria );

		$modulesToView = array();
		foreach ( $modules as $module ) {
			$modulesToView[ $module->id ]                = array();
			$modulesToView[ $module->id ]["options"]     = array();
			$modulesToView[ $module->id ]["title"]       = $module->title;
			$modulesToView[ $module->id ]["price"]       = 0;
			$modulesToView[ $module->id ]["image"]       = $module->getImage();
			$modulesToView[ $module->id ]["description"] = $module->description;
			$modulesToView[ $module->id ]["fronts"]      = $module->getFronts();
			$modulesToView[ $module->id ]["id"]          = $module->id;
			$modulesToView[ $module->id ]["pre_pay"]     = $module["pre_pay"];
			$modulesToView[ $module->id ]["img_alt"]     = $module["img_alt"];
			$modulesToView[ $module->id ]["filtr"]       = str_replace(" ","",$module->filtr);
			$modulesToView[ $module->id ]["price_front"] = -1;						//без фасада
			$modulesToView[ $module->id ]["front_title"] = "Без фасада";
			//$modulesToView[ $module->id ]["front_price_prepay"] = 0;
			//$modulesToView[ $module->id ]["front_options"] = array();

			/*--------------Цена за цвет модуля-------------------------------------------*/
			$priceCriteria            = new CDbCriteria;
			$priceCriteria->select    = 'price_color';
			$priceCriteria->condition = 'id_module=:id_module and id_color=:id_color';
			$priceCriteria->params    = array( ':id_module' => $module->id, ':id_color' => $moduleColorId);
			$price =  PriceModuleColor::model()->findAll($priceCriteria);
			if(!empty ($price[0]['price_color'])){
				$modulesToView[ $module->id ]["price"] = $price[0]['price_color'];
			}
			/*--------------End Цена за цвет модуля-------------------------------------------*/

			/*--------------Опции модуля-------------------------------------------*/
			$options = $module -> getOptions();
			if ( $options ) {
				foreach ( $options as $option ) {
					$optionModel = ModuleOption::model()->findByPk( $option["id"] );
					if (( $optionModel )and($optionModel->is_show == 1)) {
						$option["price"] = $option["price"] * $optionModel["price"];
						$option["title"] = $optionModel->title;
						$option["pre_pay"] = $option["price"] * $module["pre_pay"] / 100;

						if ( ! isset( $modulesToView[ $module->id ]["options"][ $option["group"] ] ) ) {
							$modulesToView[ $module->id ]["options"][ $option["group"] ] = array();
						}
						$modulesToView[ $module->id ]["options"][ $option["group"] ][ $optionModel["id"] ] = $option;
					}
				}
			}
			/*--------------END Опции модуля-------------------------------------------*/
			$modulesToView[ $module->id ]["price"] = $modulesToView[ $module->id ]["price"];

			$modulesToView[ $module->id ]["options"] = json_encode( $modulesToView[ $module->id ]["options"] );
		}

		$criteria            = new CDbCriteria;
		$criteria->condition = 'url=:url';
		$criteria->params    = array( ':url' => "nostd" );

		$nostd = Page::model()->find( $criteria );
		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		/*-------------------END  Модули----------------------------------------------*/
		$this->render( 'kitchen-modules', array(
			'catalogMenu'  			=> $this->getCatalogMenuArray(),
			'openCatalogItemId'     => null,
			'section'				=> Folder::model()->findByPk(6),
			'selectModuleColor'     => $selectModuleColor,
			'selectFrontColor'		=> $selectFrontColor,
			'modules'				=> $modulesToView,
			'filtr_module'			=> $filtr,
			'selectModuleFiltrTab'	=> $selectModuleFiltrTab,
			'contentNostd'			=> $nostd -> content
		));
	}


	/**
	 * Каталог - конструктор - кухонные фасады
	 */
	public function actionFronts() {
	/*----------------Фильтр модулей-------------------------*/
		$arr =  ItemFront::model()->findAll(array('select'=>'filtr'));
		$filtr = array();
		foreach($arr as $ar){
			if($ar['filtr'] != ""){
				array_push($filtr, $ar['filtr']);
			}
		}
		$filtr = array_unique($filtr);
		$getFiltr = array();
		for($i=0; $i<count($filtr); $i++){
			$p = "filtr_".$i;
			if(!empty($_POST[$p])){
				array_push($getFiltr, $_POST[$p]);
			}
		}
		$frontFiltrTab = Yii::app()->session['FiltrTabId_f'];
		$frontFiltrTabTitle = Yii::app()->session['FiltrTabTitle_f'];
		if( $frontFiltrTab != ""){
			$selectFrontFiltrTab['id']    = $frontFiltrTab;
			$selectFrontFiltrTab['title'] = $frontFiltrTabTitle;
		}
		else{
			$selectFrontFiltrTab['id']    = "#filtr_menu1";
			$selectFrontFiltrTab['title'] = "536";
		}
	/*----------------END Фильтр модулей-------------------------*/

	/*----------------Присвоение цвета--------------------------*/
		$frontColorId = Yii::app()->session['frontColorId'];
		if( $frontColorId != ""){
			$dataColorId = Color::model()->findAllByPk($frontColorId);
			$dataColorId = array_shift($dataColorId);
			$selectFrontColor["id"]    = $frontColorId;
			$selectFrontColor['title'] = $dataColorId['title'];
			$selectFrontColor['image'] = "colors/".$dataColorId['image'].".png";
		}
		else{
			$selectFrontColor["id"]    = 0;
			$selectFrontColor['title'] = "Цвет не выбран";
			$selectFrontColor['image'] = "without.jpg";
		}
	/*----------------END Присвоение цвета--------------------------*/
	/*---------------------Фасады--------------------------*/

		$frontsCriteria            = new CDbCriteria;
		$frontsCriteria->condition = 'is_show=:is_show';
		$frontsCriteria->params    = array( ':is_show' => "1" );
		//$frontsCriteria->order = 'title';
		$fronts = ItemFront::model()->findAll( $frontsCriteria );

		$frontsToView = array();
		foreach ( $fronts as $front ) {
			$frontfiltr = (explode(" ",$front->filtr));
			$frontsToView[ $front->id ]            = array();
			$frontsToView[ $front->id ]["options"] = array();
			$frontsToView[ $front->id ]["milling"] = array();
			$frontsToView[ $front->id ]["id"]      = $front->id;
			$frontsToView[ $front->id ]["title"]   = $front->title;
			$frontsToView[ $front->id ]["price"]   = 0;
			$frontsToView[ $front->id ]["image"]   = $front->getImage();
			$frontsToView[ $front->id ]["img_alt"] = $front->img_alt;
			$frontsToView[ $front->id ]["filtr"]   = $frontfiltr[0];
			$frontsToView[ $front->id ]["description"]   = $front->description;
			$frontsToView[ $front->id ]["no_standard"]   = array();
			$standard = 1;

		/*----------------------Фасады:(добавление опций)---------------------------------------*/
			$options = $front -> getOptions();
			if(empty($options)){
				$options = array();
				array_push($options, array('id' => 1, 'group' => 'no', 'is_enabled' => 0, 'price' => 0));
			}
			if ( $options ) {
				foreach($frontsToView[$front->id]["milling"] as $item){
					array_push($options, array('id' => $item['id'], 'group' => 'milling', 'is_enabled' => 1, 'price' => $item['price']));
				}

				foreach ( $options as $option ) {
					$optionModel = ModuleOption::model()->findByPk( $option["id"] );
					if($optionModel["is_show"]==1){
						$option["price"] = $option["price"]*$optionModel["price"];
						$option["title"] = $optionModel["title"];
						$option["image"] = $optionModel["image"];
						if ( ! isset( $frontsToView[ $front->id ]["options"][ $option["group"] ] ) ) {
							$frontsToView[ $front->id ]["options"][ $option["group"] ] = array();
						}

						$frontsToView[ $front->id ]["options"][ $option["group"] ][ $optionModel["id"] ] = $option;

						//--------------Ширина высота нестандартного фасада
						if ( $optionModel["group"] == 'no_standard' ){
							$standard = 0;
							if ( $optionModel["id"] == 126 ){
								$min_w = $option["price"];
							}
							if ( $optionModel["id"] == 127 ){
								$max_w = $option["price"];
							}
							if ( $optionModel["id"] == 128 ){
								$min_h = $option["price"];
							}
							if ( $optionModel["id"] == 129 ){
								$max_h = $option["price"];
							}
						}
						//--------------Ширина высота нестандартного фасада
					}

				}
			}

		/*---------------------END Фасады:(добавление опций)--------------------------*/

			$frontsToView[ $front->id ]["options"] = json_encode( $frontsToView[ $front->id ]["options"] );
			if($standard == 0){
				$frontsToView[ $front->id ]["no_standard"] = json_encode(array('min_w' => $min_w, 'max_w' => $max_w,'min_h' => $min_h, 'max_h' => $max_h));
			}
			else{
				$frontsToView[ $front->id ]["no_standard"] = array();
			}

		}
	/*--------------------END Фасады--------------------------*/
		$this->pageTitle = "Кухонные фасады";
		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$section = Folder::model()->findByPk(7);
		$this->render( 'fronts', array( 'frontColorId'		 => $frontColorId,
										'section'	  		 =>$section,
										'filtr_front'        => $filtr,
										'selectFrontColor' 	 => $selectFrontColor,
										'fronts'       		 => $frontsToView,
										'selectFrontFiltrTab'=>$selectFrontFiltrTab));
	}
	
	/**
	 * Фасады:(цена за цвет и фрезеровки)
	 */
	public function actionFrontColorPrice() {
		$session = new CHttpSession;
		$session->open();
		$idFront  = Yii::app()->request->getPost( 'idFront' );
		$idColor = Yii::app()->request->getPost( 'idColor' );
		
		if(isset($idFront) and isset($idColor)) {
			$front = ItemFront::model()->findByPk( $idFront );		
			$color = Color::model()->findByPk( $idColor );	
		}
		if ( isset($color) and isset($front) ) {
			$priceColorMilling = $front->getPriceColorMilling($color);
			echo json_encode($priceColorMilling);
		}
	}

	/**
	 * Фасады:(Формирование опций)
	 */
	public function frontOptions() {		
	/*---------------------Фасады:(добавление фрезеровок)--------------------------*/
	
	}
	/**
	 * Каталог - конструктор - кухонный модуль
	 */
	public function actionKitchenModule() {

		$session = new CHttpSession;
		$session->open();

		//print_r( $session['color_hint'] );
		$colorHint = new ColorHint( $session );
		//print_r( $colorHint->getFrontColor() );


		$this->pageTitle = "Кухонный модуль";
		$this->render( 'kitchen-module' );
	}
	
	/*
		public function actionModuleItem($id) {
			
				$module = ItemModule::model()->findByPk( $id );
				$this->render('moduleItem', array( "item" => $module));
			
		}
	*/
	/**
	 * Установка цвета модуля
	 */
	public function actionSetKitchenModuleColor() {

		$session = new CHttpSession;
		$session->open();

		$frontColorId  = Yii::app()->request->getPost( 'front_color_id' );
		$moduleColorId = Yii::app()->request->getPost( 'module_color_id' );

		if(isset($moduleColorId)){
			$moduleColorId != null ? $session['moduleColorId'] = $moduleColorId : $session['moduleColorId'] = 0;
		}
		if(isset($frontColorId)){
			$frontColorId != null ? $session['frontColorId'] = $frontColorId : $session['frontColorId'] = 0;
		}


		echo $this->messageJsonOk( 'сохранено ' . $frontColorId . ' ' . $moduleColorId );

	}
	public function actionSetFiltrTab() {
		$session = new CHttpSession;
		$session->open();

		$FiltrTabId  = Yii::app()->request->getPost( 'filtr_tab_id' );
		$FiltrTabTitle = Yii::app()->request->getPost( 'filtr_tab_title' );
		
		if(isset($FiltrTabId)){
			$FiltrTabId != null ? $session['FiltrTabId'] = $FiltrTabId : $session['FiltrTabId'] = "#filtr_menu1";
		}
		if(isset($FiltrTabTitle)){
			$FiltrTabTitle != null ? $session['FiltrTabTitle'] = $FiltrTabTitle : $session['FiltrTabTitle'] = "Нижнее";
		}
	    $FiltrTabId_f  = Yii::app()->request->getPost( 'filtr_tab_id_f' );
		$FiltrTabTitle_f = Yii::app()->request->getPost( 'filtr_tab_title_f' );
		
		if(isset($FiltrTabId_f)){
			$FiltrTabId_f != null ? $session['FiltrTabId_f'] = $FiltrTabId_f : $session['FiltrTabId_f'] = "#filtr_menu1";
		}
		if(isset($FiltrTabTitle_f)){
			$FiltrTabTitle_f != null ? $session['FiltrTabTitle_f'] = $FiltrTabTitle_f : $session['FiltrTabTitle_f'] = "536";
		}
	}


	public function actionTabletops() {
		$tabletopsCriteria            = new CDbCriteria;
		$tabletopsCriteria->condition = 'is_show=1';
		$tabletopsCriteria->order = 'title';
		$tabletops                    = ItemCover::model()->findAll( $tabletopsCriteria );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

		
		$this->pageTitle = "Столешницы";
		$this->description = "Столешницы";
		$this->render( 'tabletops', array( "tabletops" => $tabletops, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );
	}

	public function actionWallpanels() {
		$wallPanelsCriteria            = new CDbCriteria;
		$wallPanelsCriteria->condition = 'is_show=1';
		$wallPanelsCriteria->order = 'title';
		$wallPanels                    = WallPanel::model()->findAll( $wallPanelsCriteria );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;


		$this->pageTitle = "Стеновые панели";
		$this->description = "Стеновые панели";
		$this->render( 'wall-panels', array( "items" => $wallPanels, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );
	}

	public function actionTabletop( $id ) {
		$tabletop = ItemCover::model()->findByPk( $id );
		$standard = 1;
		
		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;
		
		$options = $tabletop->getOptions();
		if($options){
			foreach ( $options as $option){
				
				$optionModel = ModuleOption::model()->findByPk( $option["id"] );
				if ( $optionModel["group"] == 'no_standard' ){
					$standard = 0;
					if ( $optionModel["id"] == 126 ){	
						$min_w = $option["price"];
					}
					if ( $optionModel["id"] == 127 ){							
						$max_w = $option["price"];
					}
					if ( $optionModel["id"] == 128 ){							
						$min_h = $option["price"];
					}
					if ( $optionModel["id"] == 129 ){							
						$max_h = $option["price"];
					}
				}
			}
		}
		if($standard == 0){
			$no_standard = array('min_w' => $min_w, 'max_w' => $max_w,'min_h' => $min_h, 'max_h' => $max_h);
			$no_standard = json_encode($no_standard);
		}
		else{
			$no_standard = array();
		}
		
		$i  = 0;		$id_p = $tabletop -> folder_id;		$patch=array();	
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				array_push($patch, $p -> id);
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}

		$size_std = $tabletop->stdSizeCover();
		
		$this->pageTitle = $tabletop->title;
		$this->description = $tabletop->title;
		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->render( 'tabletop-item', array( "item" => $tabletop, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId,
												"no_standard" => $no_standard, "patch" => array_reverse ($patch),'size_std' => $size_std) );
	}

	public function actionWallPanel( $id ) {
		$item = ItemCover::model()->findByPk( $id );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

		$i  = 0;		$id_p = $item -> folder_id;		$patch=array();	
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				array_push($patch, $p -> id);
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}
		
		$this->pageTitle = $item->title;
		$this->description = $item->title;
		$this->canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->render( 'wall-panel-item', array( "item" => $item, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId, "patch" => array_reverse ($patch)  ) );
	}

	public function actionAccessories() {
		$accessoriesCriteria            = new CDbCriteria;
		$accessoriesCriteria->condition = 'is_show=1';
		$accessoriesCriteria->order = 'title';
		
		$accessories                    = Accessory::model()->findAll( $accessoriesCriteria );
       
		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = 5;


		$this->pageTitle = "Кухонные аксессуары";
		$this->description = "Кухонные аксессуары";
		$this->render( 'accessories', array( "items" => $accessories, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );

	}

	public function actionAccessory( $id ) {
		$accessory = Accessory::model()->findByPk( $id );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = 5;
		
		$i  = 0;		$id_p = $accessory -> folder_id;		$patch=array();	
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				array_push($patch, $p -> id);
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}
		
		$this->pageTitle = $accessory->title;
		$this->canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->description = $accessory->title;
		$this->render( 'accessory-item', array( "item" => $accessory, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId, "patch" => array_reverse ($patch) ) );
	}

	public function actionEquipment() {
		$equipmentCriteria            = new CDbCriteria;
		$equipmentCriteria->condition = 'is_show=1';
		$equipmentCriteria->order = 'title';
		$equipment                    = Equipment::model()->findAll( $equipmentCriteria );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

        
		$this->pageTitle = "Кухонная техника";
		$this->description = "Кухонная техника";
		$this->render( 'equipment-list', array( "equipment" => $equipment, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );

	}

	public function actionEquipmentItem( $id ) {
		$equipment = Equipment::model()->findByPk( $id );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

		$i  = 0;		$id_p = $equipment -> folder_id;		$patch=array();	
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				array_push($patch, $p -> id);
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}
		
		$this->pageTitle = $equipment->title;
		$this->description = $equipment->title;
		$this->canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->render( 'equipment-item', array( "item" => $equipment, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId, "patch" => array_reverse ($patch) ) );
	}

	public function actionBars() {
		$equipmentCriteria            = new CDbCriteria;
		$equipmentCriteria->condition = 'is_show=1';
		$equipment                    = ItemCover::model()->findAll( $equipmentCriteria );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;


		$this->pageTitle = "Кухонная техника";
		$this->description = "Кухонная техника";
		$this->render( 'bars', array( "items" => $equipment, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );

	}

	public function actionBarItem( $id ) {
		$equipment = ItemCover::model()->findByPk( $id );

		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;

		$this->pageTitle = $equipment->title;
		$this->render( 'bar-item', array( "item" => $equipment, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId ) );
	}
	public function actionShkafy($id) {
		$catalogMenu       = $this->getCatalogMenuArray();
		$openCatalogItemId = null;
		$folder = Folder::model()->findByPk($id);
		$this->pageTitle = $folder->title;
		$this->render( 'shkafy', array('folderItem'=>$folder,'catalogMenu'=>$catalogMenu,'openCatalogItemId'=>$openCatalogItemId) );

	}
	
	public function Folder( $id ) {

		$folder  = Folder::model()->findByPk( $id );
		if (empty($folder)){
           	throw new CHttpException(404);
            exit();
        }
		$folders = $folder->getChildModels();

		$parentFolder = $folder->getAbsParentModel();


		$catalogCriteria            = new CDbCriteria();
		$catalogCriteria->condition = "folder_id='$parentFolder->id'";

		$openCatalogItem   = CatalogMenuItem::model()->find( $catalogCriteria );
		$openCatalogItemId = null;

		//print_r( $openCatalogItem );

		if ( $openCatalogItem ) {
			$openCatalogItemId = $openCatalogItem->id;
		}

		$model = $folder->getModel();

		$modelClass = $model["model"];

		$criteria            = new CDbCriteria();
		$criteria->condition = "folder_id='$id'";
		//print_r($criteria);
		$criteria->order = 'title';

		$items       = $modelClass::model()->findAll( $criteria );
		$section = Folder::model()->findByPk( $id );

		$i  = 0;		$id_p = $id;		$patch=array();	
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				array_push($patch, $p -> id);
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}
		
		if(!isset($model["viewList"])){
		    throw new CHttpException(404);
            exit();
		}
		
		$catalogMenu = $this->getCatalogMenuArray();
		
		$this->pageTitle = $model["label"];
		$this->description = $model["label"];
		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->render( $model["viewList"], array( "items" => $items, "folders" => $folders, "catalogMenu" => $catalogMenu, "openCatalogItemId" => $openCatalogItemId, "section" => $section, "patch" => $patch ) );
	}
	
	
	public function actionKuhonnyeaksessuary($id) {
	    $this->Folder($id);
	}
	public function actionStenovyepaneli($id) {
	    $this->Folder($id);
	}
	public function actionStoleshnicy($id) {
	    $this->Folder($id);
	}
	public function actionKuhonnayatehnika($id) {
	    $this->Folder($id);
	}
}