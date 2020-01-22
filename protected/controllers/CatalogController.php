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

	public function actionIndex() {
		$page = Page::model()->findByPk( 12 );
        $obj['title'] = $page->menu;
		$obj['template'] = "main";
        $obj['page'] = $page;
		$obj['breadcrumb'] = $this->getBreadcrumb(0,'');

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
	 * Каталог - конструктор - кухонные модули
	 */
	public function actionKitchenModules() {
        $obj['title'] = 'Кухонные модули';
        $obj['template'] = "list";
        $obj['page'] = $this->getFolder(6);
        $obj['idMenu'] = 1;
        $obj['pathImg'] = '/images/item_modules/';
        $obj['pathItem'] = 'moduleItem/';
        $obj['folder'] = [];
		$obj['breadcrumb'] = $this->getBreadcrumb(6,'kitchenmodules/');


        $listCriteria            = new CDbCriteria;
		$listCriteria->condition = 'is_show=:is_show';
		$listCriteria->params    = array( ':is_show' => "1" );
        $listCriteria->order = 'id';
        //$listCriteria->limit = '20';
		$list = ItemModule::model()->findAll( $listCriteria );
        $obj['list'] = $list;
		$this->render( 'catalog', array('obj' => $obj));
	}
    public function actionModuleItem($id) {
        $item = ItemModule::model()->findByPk($id);

        $obj['template'] = "item";
        $obj['title'] = $item->title;
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb(6,'kitchenmodules/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

        $this->render( 'catalog', array('obj' => $obj));
    }
	/**
	 * Каталог - конструктор - кухонные фасады
	 */
	public function actionFronts() {
        $obj['title'] = 'Фасады';
        $obj['template'] = "list";
        $obj['page'] = $this->getFolder(7);
        $obj['idMenu'] = 4;
        $obj['pathImg'] = '/images/item_fronts/';
        $obj['pathItem'] = 'front/';
        $obj['folder'] = [];
		$obj['breadcrumb'] = $this->getBreadcrumb(7,'fronts/');

        $listCriteria            = new CDbCriteria;
		$listCriteria->condition = 'is_show=:is_show';
		$listCriteria->params    = array( ':is_show' => "1" );
        $listCriteria->order = 'id';
        //$listCriteria->limit = '20';
		$list = ItemFront::model()->findAll( $listCriteria );
        $obj['list'] = $list;
		$this->render( 'catalog', array('obj' => $obj));
	}
    public function actionFront($id) {
        $item = ItemFront::model()->findByPk($id);

        $obj['template'] = "item";
        $obj['title'] = $item->title;
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb(7,'fronts/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

        $this->render( 'catalog', array('obj' => $obj));
    }

	public function actionTabletops($id) {
        $obj['title'] = 'Кухонные столешницы';
        $obj['template'] = "list";
        $obj['idMenu'] = 2;
        $obj['pathImg'] = '/images/item_tabletops/';
        $obj['pathItem'] = 'tabletop/';
        $obj['pathfolder'] = 'stoleshnicy/';
        $obj['page'] = $this->getFolder($id);
        $obj['folder'] = $this->getFolderChild($id);
		$obj['breadcrumb'] = $this->getBreadcrumb($id,$obj['pathfolder']);

		$tabletops  = ItemCover::model()->findAll( $this->getCriteria($id) );
        $obj['list'] = $tabletops;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionWallpanels($id) {
        $obj['title'] = 'Стеновые панели';
        $obj['template'] = "list";
        $obj['idMenu'] = 3;
        $obj['pathImg'] = '/images/item_tabletops/';
        $obj['pathItem'] = 'wall-panel/';
        $obj['pathfolder'] = 'stenovye-paneli/';
        $obj['page'] = $this->getFolder($id);
        $obj['folder'] = $this->getFolderChild($id);
		$obj['breadcrumb'] = $this->getBreadcrumb($id,$obj['pathfolder']);

		$wallPanels = ItemCover::model()->findAll( $this->getCriteria($id) );
        $obj['list'] = $wallPanels;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionTabletop( $id ) {
        $item = ItemCover::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb($item->folder_id,'stoleshnicy/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionWallPanel( $id ) {
		$item = ItemCover::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb($item->folder_id,'stenovye-paneli/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionAccessories($id) {
        $obj['title'] = "Аксессуары";
        $obj['template'] = "list";
        $obj['idMenu'] = 5;
        $obj['pathImg'] = '/images/item_accessories/';
        $obj['pathItem'] = 'accessory/';
        $obj['pathfolder'] = 'kuhonnye-aksessuary/';
        $obj['page'] = $this->getFolder($id);
        $obj['folder'] = $this->getFolderChild($id);
		$obj['breadcrumb'] = $this->getBreadcrumb($id,$obj['pathfolder']);
		
		$accessories = Accessory::model()->findAll( $this->getCriteria($id) );
        $obj['list'] = $accessories;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionAccessory( $id ) {
		$item = Accessory::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb($item->folder_id,'kuhonnye-aksessuary/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionEquipment($id) {
        $obj['title'] = "Кухонная техника";
        $obj['template'] = "list";
        $obj['idMenu'] = 6;
        $obj['pathImg'] = '/images/item_equipment/';
        $obj['pathItem'] = 'equipment/';
        $obj['pathfolder'] = 'kuhonnaya-tehnika/';
        $obj['page'] = $this->getFolder($id);
        $obj['folder'] = $this->getFolderChild($id);
		$obj['breadcrumb'] = $this->getBreadcrumb($id,$obj['pathfolder']);

		$equipment  = Equipment::model()->findAll( $this->getCriteria($id) );
        $obj['list'] = $equipment;

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionEquipmentItem( $id ) {
		$item = Equipment::model()->findByPk( $id );

        $obj['title'] = $item->title;
        $obj['template'] = "item";
        $obj['item'] = $item;
		$obj['breadcrumb'] = $this->getBreadcrumb($item->folder_id,'kuhonnaya-tehnika/');
		array_push($obj['breadcrumb'], array('path' => '','title' => $item->title));

		$this->render( 'catalog', array( 'obj' => $obj ));
	}

	public function actionShkafy($id) {
        $obj['title'] = "Шкафы";
        $obj['template'] = "list";
        $obj['idMenu'] = 7;
        $obj['pathImg'] = '/images/';
        $obj['pathItem'] = '';
        $obj['pathfolder'] = 'shkafy/';
        $obj['page'] = $this->getFolder($id);
        $obj['folder'] = $this->getFolderChild($id);
		$obj['breadcrumb'] = $this->getBreadcrumb($id,$obj['pathfolder']);

        $obj['list'] = [];

		$this->render( 'catalog', array( 'obj' => $obj ));
	}
	
	public function getBreadcrumb($id_p,$pathFolder){
		$path = [];
		$arr = [];
		$i = 0;
		while($i != 1){
			$p = Folder::model()->findByPk( $id_p );
			if (isset($p -> parent_id)){
				$arr['path'] = '/catalog/'.$pathFolder.$p->id;
				if(($p->id == 6)||($p->id == 7)){$arr['path'] = '/catalog/'.$pathFolder;}
				$arr['title'] = $p->title;
				array_push($path, $arr );
				$id_p = $p -> parent_id;
			}
			else{
				$i=1;
			}
			if($id_p == 0){
				$i=1;
			}
		}
		$arr['path'] = '/catalog';
		$arr['title'] = 'Каталог';
		array_push($path, $arr );
		return array_reverse($path);
	}

    public function getFolder($id){
        $folder = Folder::model()->findByPk($id);
        if(empty($folder)){
            throw new CHttpException(404);
            exit();
        }
        else{
            return $folder;
        }
    }

    public function getFolderChild($id){
        $folderCriteria = new CDbCriteria;
		$folderCriteria->condition = "is_show=1 and parent_id=:parent_id";
        $folderCriteria->params    = array( ':parent_id' => $id );
		$folderCriteria->order = 'title';
        return Folder::model()->findAll( $folderCriteria );
    }

    public function getCriteria($id){
        $Criteria            = new CDbCriteria;
		$Criteria->condition = "is_show=1 and folder_id = :folder_id";
        $Criteria->params    = array( ':folder_id' => $id );
		$Criteria->order = 'title';
        return $Criteria;
    }


	public function actionKuhonnyeaksessuary($id) {
	    $this->actionAccessories($id);
	}
	public function actionStenovyepaneli($id) {
	    $this->actionWallpanels($id);
	}
	public function actionStoleshnicy($id) {
	    $this->actionTabletops($id);
	}
	public function actionKuhonnayatehnika($id) {
	    $this->actionEquipment($id);
	}
}