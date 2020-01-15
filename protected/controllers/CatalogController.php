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
		$page = Page::model()->findByPk( 12 );
        $obj['title'] = $page->menu;
		$obj['template'] = "main";
        $obj['page'] = $page;

		$this -> canonical = Yii::app()->request->getHostInfo() . '/' . Yii::app()->request->getPathInfo();
		$this->pageTitle = "Каталог";
		$this->render( 'catalog', array('obj' => $obj) );
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
        $section = Folder::model()->findByPk(6);
        $obj['title'] = 'Кухонные модули';
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 1;
        $obj['pathImg'] = '/images/item_modules/';
        $obj['pathItem'] = 'moduleItem/';

        $listCriteria            = new CDbCriteria;
		$listCriteria->condition = 'is_show=:is_show';
		$listCriteria->params    = array( ':is_show' => "1" );
        $listCriteria->order = 'id';
        $listCriteria->limit = '20';
		$list = ItemModule::model()->findAll( $listCriteria );
        $obj['list'] = $list;
		$this->render( 'catalog', array('obj' => $obj));
	}
    public function actionModuleItem($id) {
        $item = ItemModule::model()->findByPk($id);

        $obj['template'] = "item";
        $obj['title'] = $item->title;
        $obj['item'] = $item;

        $this->render( 'catalog', array('obj' => $obj));
    }
	/**
	 * Каталог - конструктор - кухонные фасады
	 */
	public function actionFronts() {
        $section = Folder::model()->findByPk(7);
        $obj['title'] = 'Фасады';
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 4;
        $obj['pathImg'] = '/images/item_fronts/';
        $obj['pathItem'] = 'front/';

        $listCriteria            = new CDbCriteria;
		$listCriteria->condition = 'is_show=:is_show';
		$listCriteria->params    = array( ':is_show' => "1" );
        $listCriteria->order = 'id';
        $listCriteria->limit = '20';
		$list = ItemFront::model()->findAll( $listCriteria );
        $obj['list'] = $list;
		$this->render( 'catalog', array('obj' => $obj));
	}
    public function actionFront($id) {
        $item = ItemFront::model()->findByPk($id);

        $obj['template'] = "item";
        $obj['title'] = $item->title;
        $obj['item'] = $item;

        $this->render( 'catalog', array('obj' => $obj));
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


	public function actionTabletops($id) {
        $section = Folder::model()->findByPk($id);
        $obj['title'] = 'Кухонные столешницы';
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 2;
        $obj['pathImg'] = '/images/item_tabletops/';
        $obj['pathItem'] = 'tabletop/';

		$tabletopsCriteria            = new CDbCriteria;
		$tabletopsCriteria->condition = 'is_show=1';
		$tabletopsCriteria->order = 'title';
		$tabletops  = ItemCover::model()->findAll( $tabletopsCriteria );
        $obj['list'] = $tabletops;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionWallpanels() {
        $section = Folder::model()->findByPk(9);

        $obj['title'] = 'Стеновые панели';
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 3;
        $obj['pathImg'] = '/images/item_tabletops/';
        $obj['pathItem'] = 'wallpanel/';

		$wallPanelsCriteria = new CDbCriteria;
		$wallPanelsCriteria->condition = 'is_show=1';
		$wallPanelsCriteria->order = 'title';
		$wallPanels = ItemCover::model()->findAll( $wallPanelsCriteria );
        $obj['list'] = $wallPanels;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionTabletop( $id ) {
        $item = ItemCover::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionWallPanel( $id ) {
		$item = ItemCover::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionAccessories() {
        $section = Folder::model()->findByPk(11);
        $obj['title'] = "Аксессуары";
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 5;
        $obj['pathImg'] = '/images/item_accessories/';
        $obj['pathItem'] = 'accessory/';

		$accessoriesCriteria            = new CDbCriteria;
		$accessoriesCriteria->condition = 'is_show=1';
		$accessoriesCriteria->order = 'title';
		$accessories                    = Accessory::model()->findAll( $accessoriesCriteria );
        $obj['list'] = $accessories;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionAccessory( $id ) {
		$item = Accessory::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionEquipment() {
        $section = Folder::model()->findByPk(12);
        $obj['title'] = "Кухонная техника";
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 6;
        $obj['pathImg'] = '/images/item_equipment/';
        $obj['pathItem'] = 'equipment/';

        $equipmentCriteria  = new CDbCriteria;
		$equipmentCriteria->condition = 'is_show=1';
		$equipmentCriteria->order = 'title';
		$equipment  = Equipment::model()->findAll( $equipmentCriteria );
        $obj['list'] = $equipment;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionEquipmentItem( $id ) {
		$item = Equipment::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;


		$this->render( 'catalog', array( 'obj' => $obj ));

	}

	public function actionShkafy($id) {
        $section = Folder::model()->findByPk(12);
        $obj['title'] = "Шкафы";
        $obj['template'] = "list";
        $obj['page'] = $section;
        $obj['idMenu'] = 7;

        $folder = Folder::model()->findByPk(62);
        $obj['list'] = $folder;

		$this->render( 'catalog', array( 'obj' => $obj ));
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
	    $this->actionAccessories();
	}
	public function actionStenovyepaneli($id) {
	    $this->actionWallpanels();
	}
	public function actionStoleshnicy($id) {
	    $this->actionTabletops($id);
	}
	public function actionKuhonnayatehnika($id) {
	    $this->actionEquipment();
	}
}